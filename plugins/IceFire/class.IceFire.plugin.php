<?php if (!defined('APPLICATION')) exit();

$PluginInfo['IceFire'] = array(
    'Name' => 'IceFire',
    'Description' => "Implements extra settings for a czech fan site <a href=\"www.icefire.cz\">www.icefire.cz</a>. Based on RoleBadges plugin by Thomas Martin.",
    'Version' => '0.1',
    'RequiredApplications' => array('Vanilla' => '2.0.17'),
    'RequiredTheme' => FALSE,
    'RequiredPlugins' => FALSE,
    'HasLocale' => FALSE,
    'RegisterPermissions' => FALSE,
    'Author' => 'Thomas Martin, PavelDedik',
    'AuthorEmail' => 'dedikx@gmail.com'
);

class IceFirePlugin extends Gdn_Plugin {

    public function Base_Render_Before($Sender) {
        $Sender->AddCssFile($this->GetResource( 'design/Books.css', FALSE, FALSE ));
    }

    public function DiscussionController_CommentOptions_Handler($Sender) {
        $this->AddInfo($Sender);
    }

    protected function AddInfo($Sender) {
        $User = $Sender->EventArguments['Author'];
        $UserPrefs = Gdn_Format::Unserialize($User->Preferences);
        if (!is_array($UserPrefs))
            $UserPrefs = array();

        $Books = GetValue('IceFire.Books', $UserPrefs, NULL);
        $Words = GetValue('IceFire.Words', $UserPrefs, NULL);

        if ($Words !== NULL && $Words != '') {
            echo '<i class="separator"></i>';
            echo '<span class="UserWords">';
                echo $Words;
            echo '</span>';
        }

        if (!empty($Books)) {
            echo '<i class="separator"></i>';
            echo '<span class="UserBooks">';

            for ($i = 1; $i <= 5; $i++) {
                if ($Books[$i] == '1') {
                    if ($i == 1) {
                        echo '<a href="/knihy/pisen-ledu-a-ohne/hra-o-truny/" rel="tooltip" title="Hra o trůny">';
                    } elseif ($i == 2) {
                        echo '<a href="/knihy/pisen-ledu-a-ohne/stret-kralu/" rel="tooltip" title="Střet králů">';
                    } elseif ($i == 3) {
                        echo '<a href="/knihy/pisen-ledu-a-ohne/boure-mecu/" rel="tooltip" title="Bouře mečů">';
                    } elseif ($i == 4) {
                        echo '<a href="/knihy/pisen-ledu-a-ohne/hostina-pro-vrany/" rel="tooltip" title="Hostina pro vrány">';
                    } elseif ($i == 5) {
                        echo '<a href="/knihy/pisen-ledu-a-ohne/tanec-s-draky/" rel="tooltip" title="Tanec s draky">';
                    }
                    echo '<span class="Books Book'.$i.'"></span></a>';
                }
            }
            echo '</span>';
        }
    }

    public function ProfileController_AfterAddSideMenu_Handler($Sender) {
      if (!Gdn::Session()->CheckPermission('Garden.SignIn.Allow'))
         return;

      $SideMenu = $Sender->EventArguments['SideMenu'];
      $ViewingUserID = Gdn::Session()->UserID;

      if ($Sender->User->UserID == $ViewingUserID) {
         $SideMenu->AddLink('Options', 'Ice & Fire nastavení', '/profile/icefire',
                            FALSE, array('class' => 'Popup'));
      } else {
         $SideMenu->AddLink('Options', 'Ice & Fire nastavení', UserUrl($Sender->User, '', 'icefire'),
                            'Garden.Users.Edit', array('class' => 'Popup'));
      }
    }

    public function ProfileController_IceFire_Create($Sender) {
        $Sender->Permission('Garden.SignIn.Allow');

        $Args = $Sender->RequestArgs;

        if (sizeof($Args) < 2)
            $Args = array_merge($Args, array(0,0));
        elseif (sizeof($Args) > 2)
            $Args = array_slice($Args, 0, 2);

        list($UserReference, $Username) = $Args;

        $Sender->GetUserInfo($UserReference, $Username);
        $UserPrefs = Gdn_Format::Unserialize($Sender->User->Preferences);
        if (!is_array($UserPrefs))
            $UserPrefs = array();

        $UserID = $ViewingUserID = Gdn::Session()->UserID;
        if ($Sender->User->UserID != $ViewingUserID) {
            $Sender->Permission('Garden.Users.Edit');
            $UserID = $Sender->User->UserID;
        }

        $CheckBoxes = GetValue('IceFire.Books', $UserPrefs, array());
        for ($i = 1; $i <= 5; $i++) {
            $Sender->Form->SetValue('Book'.$i, $CheckBoxes[$i]);
        }

        $TextBox = GetValue('IceFire.Words', $UserPrefs, '');
        $Sender->Form->SetValue('Words', $TextBox);

        if ($Sender->Form->IsPostBack()) {
            $Words = $Sender->Form->GetValue('Words', NULL);
            if (strlen($Words) > 30) {
                $Sender->Form->AddError('Délka textu nesmí přesahovat 30 znaků.');
            } else {
                $Books = array();
                for ($i = 1; $i <= 5; $i++) {
                    $Books[$i] = $Sender->Form->GetValue('Book'.$i, NULL);
                }

                $Model = Gdn::UserModel();
                $Model->SavePreference($UserID, 'IceFire.Books', $Books);
                $Model->SavePreference($UserID, 'IceFire.Words', $Words);

                $Sender->InformMessage(T("Your changes have been saved."));
            }
        }

        $Sender->Render('icefire','','plugins/IceFire');
    }

    public function Structure() {
        // nothing to do here
    }

    public function Setup() {
        // nothing to do here
    }
}
