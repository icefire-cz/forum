<?php if (!defined('APPLICATION')) exit();

// Define the plugin:
$PluginInfo['WhosOnline'] = array(
   'Name' => 'WhosOnline',
   'Description' => "Lists the users currently browsing the forum.",
   'Version' => '1.3',
   'Author' => "Gary Mardell",
   'AuthorEmail' => 'gary@vanillaplugins.com',
   'AuthorUrl' => 'http://vanillaplugins.com',
   'RegisterPermissions' => array('Plugins.WhosOnline.ViewHidden', 'Plugins.WhosOnline.Manage'),
   'SettingsPermission' => array('Plugins.WhosOnline.Manage')
);

/**
 * TODO:
 * Admin option to allow users it hide the module
 * User Meta table to store if they are hidden or not
 */

class WhosOnlinePlugin extends Gdn_Plugin {

   public function PluginController_WhosOnline_Create($Sender) {
      $Sender->Permission('Plugins.WhosOnline.Manage');
      $Sender->AddSideMenu('plugin/whosonline');
      $Sender->Form = new Gdn_Form();
      $Validation = new Gdn_Validation();
      $ConfigurationModel = new Gdn_ConfigurationModel($Validation);
      $ConfigurationModel->SetField(array('WhosOnline.Location.Show', 'WhosOnline.Frequency', 'WhosOnline.Hide'));
      $Sender->Form->SetModel($ConfigurationModel);

      if ($Sender->Form->AuthenticatedPostBack() === FALSE) {
         $Sender->Form->SetData($ConfigurationModel->Data);
      } else {
         $Data = $Sender->Form->FormValues();
         $ConfigurationModel->Validation->ApplyRule('WhosOnline.Frequency', array('Required', 'Integer'));
         $ConfigurationModel->Validation->ApplyRule('WhosOnline.Location.Show', 'Required');
         if ($Sender->Form->Save() !== FALSE)
            $Sender->StatusMessage = T("Your settings have been saved.");
      }

      // creates the page for the plugin options such as display options
      $Sender->Render($this->GetView('whosonline.php'));
   }

   public function PluginController_ImOnline_Create($Sender) {

      $Session = Gdn::Session();
      $UserMetaData = $this->GetUserMeta($Session->UserID, '%');

      // render new block and replace whole thing opposed to just the data
      $WhosOnlineModule = new WhosOnlineModule($Sender);
      $WhosOnlineModule->GetData(ArrayValue('Plugin.WhosOnline.Invisible', $UserMetaData));
      echo $WhosOnlineModule->ToString();

   }

   public function Base_Render_Before($Sender) {
      $ConfigItem = C('WhosOnline.Location.Show', 'every');
      $Controller = $Sender->ControllerName;
      $Application = $Sender->ApplicationFolder;
      $Session = Gdn::Session();
	  $SQL = Gdn::SQL();
	  $UserMetaData = $this->GetUserMeta($Session->UserID, '%');
	  $Invisible = ArrayValue('Plugin.WhosOnline.Invisible', $UserMetaData);
	  $Invisible = ($Invisible ? 1 : 0);
		// insert or update entry into table on every load
		if ($Session->UserID) {
			$SQL->Replace('Whosonline', array(
				'UserID' => $Session->UserID,
				'Timestamp' => Gdn_Format::ToDateTime(),
				'Invisible' => $Invisible),
				array('UserID' => $Session->UserID)
			);
		}

		// Check if its visible to users
		if (C('WhosOnline.Hide', TRUE) && !$Session->IsValid()) {
			return;
		}

		$ShowOnController = array();
		switch($ConfigItem) {
			case 'every':
				$ShowOnController = array(
					'discussioncontroller',
					'discussionscontroller',
					'profilecontroller',
					'activitycontroller'
				);
				break;
			case 'discussion':
			default:
				$ShowOnController = array(
					'discussioncontroller',
					'discussionscontroller'
				);
		}

      if (!InArrayI($Controller, $ShowOnController)) return;

	   $WhosOnlineModule = new WhosOnlineModule($Sender);
	   $WhosOnlineModule->GetData();
	   $Sender->AddModule($WhosOnlineModule);

	   $Sender->AddJsFile('/plugins/WhosOnline/js/whosonline.js');
	   $Frequency = C('WhosOnline.Frequency', 4);
	   if (!is_numeric($Frequency))
	      $Frequency = 4;

	   $Sender->AddDefinition('WhosOnlineFrequency', $Frequency);

   }

   public function Base_GetAppSettingsMenuItems_Handler($Sender) {
      $Menu = $Sender->EventArguments['SideMenu'];
      $Menu->AddLink('Add-ons', 'Whos Online', 'plugin/whosonline', 'Garden.Themes.Manage');
   }

   // User Settings
   public function ProfileController_AfterAddSideMenu_Handler($Sender) {
      if (!Gdn::Session()->CheckPermission('Garden.SignIn.Allow'))
         return;

      $SideMenu = $Sender->EventArguments['SideMenu'];
      $ViewingUserID = Gdn::Session()->UserID;

      if ($Sender->User->UserID == $ViewingUserID) {
         $SideMenu->AddLink('Options', T('Who\'s Online Settings'), '/profile/whosonline',
                            FALSE, array('class' => 'Popup'));
      } else {
         $SideMenu->AddLink('Options', T('Who\'s Online Settings'), UserUrl($Sender->User, '', 'whosonline'),
                            'Garden.Users.Edit', array('class' => 'Popup'));
      }
   }

   public function ProfileController_Whosonline_Create($Sender) {
      $Sender->Permission('Garden.SignIn.Allow');
      $Session = Gdn::Session();
      $UserID = $Session->IsValid() ? $Session->UserID : 0;

      $Args = $Sender->RequestArgs;

      if (sizeof($Args) < 2)
         $Args = array_merge($Args, array(0,0));
      elseif (sizeof($Args) > 2)
         $Args = array_slice($Args, 0, 2);

      list($UserReference, $Username) = $Args;
      $Sender->GetUserInfo($UserReference, $Username);

      // Get the data
      $UserMetaData = $this->GetUserMeta($UserID, '%');
      $ConfigArray = array(
            'Plugin.WhosOnline.Invisible' => NULL
         );

      if ($Sender->Form->AuthenticatedPostBack() === FALSE) {
         // Convert to using arrays if more options are added.
         $ConfigArray = array_merge($ConfigArray, $UserMetaData);
         $Sender->Form->SetData($ConfigArray);
      }
      else {
         $Values = $Sender->Form->FormValues();
         $FrmValues = array_intersect_key($Values, $ConfigArray);

         foreach($FrmValues as $MetaKey => $MetaValue) {
            $this->SetUserMeta($UserID, $this->TrimMetaKey($MetaKey), $MetaValue);
         }

         $Sender->StatusMessage = T("Your changes have been saved.");
      }

      $Sender->Render($this->GetView('settings.php'));
   }


   public function Setup() {
      $Structure = Gdn::Structure();
      $Structure->Table('Whosonline')
		->Column('UserID', 'int(11)', FALSE, 'primary')
		->Column('Timestamp', 'datetime')
		->Column('Invisible', 'int(1)', 0)
		->Set(FALSE, FALSE);
   }
}
