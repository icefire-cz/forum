<?php if (!defined('APPLICATION')) exit();

// 2.0.4 - mosullivan:
// Removed deprecated function call.
// Corrected css reference.
// Fixed a bug that caused emoticons to not open the dropdown when editing.
// Cleaned up plugin to reference itself properly, allowing for multiple emotify's on a single page to work together.
$PluginInfo['Emotify'] = array(
	'Name' => 'Emotify :)',
	'Description' => 'Replaces <a href="http://en.wikipedia.org/wiki/Emoticon">emoticons</a> (smilies) with friendly pictures.',
	'Version' 	=>	 '2.0.5',
	'MobileFriendly' => TRUE,
	'Author' 	=>	 "Mark O'Sullivan",
	'AuthorEmail' => 'mark@vanillaforums.com',
	'AuthorUrl' =>	 'http://vanillaforums.org',
	'License' => 'GPL v2',
	'RequiredApplications' => array('Vanilla' => '>=2.0.18'),
);

/**
 * Note: Added jquery events required for proper display/hiding of emoticons
 * as write & preview buttons are clicked on forms in Vanilla 2.0.14. These
 * are necessary in order for this plugin to work properly.
 */

class EmotifyPlugin implements Gdn_IPlugin {

   public function AssetModel_StyleCss_Handler($Sender) {
      $Sender->AddCssFile('emotify.css', 'plugins/Emotify');
   }

	/**
	 * Replace emoticons in comments.
	 */
	public function Base_AfterCommentFormat_Handler($Sender) {
		if (!C('Plugins.Emotify.FormatEmoticons', TRUE))
			return;

		$Object = $Sender->EventArguments['Object'];
		$Object->FormatBody = $this->DoEmoticons($Object->FormatBody);
		$Sender->EventArguments['Object'] = $Object;
	}

	public function DiscussionController_Render_Before($Sender) {
		$this->_EmotifySetup($Sender);
	}

	/**
	 * Return an array of emoticons.
	 */
	public static function GetEmoticons() {
		return array(
				':-)'	=> '1',
				':)'	=> '1',
				':-D'	=> '2',
				':D'	=> '2',
				':-('	=> '3',
				':('	=> '3',
				'8-O'	=> '5',
				':-o'	=> '4',
				'8O'	=> '5',
				':-?'	=> '6',
				'8-)'	=> '7',
				':-x'	=> '8',
				':-P'	=> '9',
				':P'	=> '9',
				':-|'	=> '10',
				';-)'	=> '11',
				';)'	=> '11',
				':evil:'	=> '14',
				':twisted:'	=> '15',
				':-s'	=> '27',
				'=D'	=> '12',
				':\'-('	=> '13',
				':\'('	=> '13',
				':roll:'	=> '16',
				':-#'	=> '24',
				':-$'	=> '28',
				':-@'	=> '18',
				':oops:'	=> '21',
				':idea:'	=> '19',
				':arrow:'	=> '20',
				':wall:'	=> '22',
				':-k'	=> '23',
				':dance:'	=> '25',
				':anxious:'	=> '26',
				':hand:'	=> '29',
				':applause:'	=> '30',
				':weirwood:'	=> '31',
				':3eyed:'	=> '32',
				':other:'	=> '33',
				':spike:'	=> '34',
				':king:'	=> '35',
				':onfire:'	=> '36',
		);
	}

	/**
	 * Replace emoticons in comment preview.
	 */
	public function PostController_AfterCommentPreviewFormat_Handler($Sender) {
		if (!C('Plugins.Emotify.FormatEmoticons', TRUE))
			return;

		$Sender->Comment->Body = $this->DoEmoticons($Sender->Comment->Body);
	}

	public function PostController_Render_Before($Sender) {
		$this->_EmotifySetup($Sender);
	}

   public function NBBCPlugin_AfterNBBCSetup_Handler($Sender, $Args) {
//      $BBCode = new BBCode();
      $BBCode = $Args['BBCode'];
      $BBCode->smiley_url = SmartAsset('/plugins/Emotify/design/images');

      $Smileys = array();
      foreach (self::GetEmoticons() as $Text => $Filename) {
         $Smileys[$Text]= $Filename.'.gif';
      }

      $BBCode->smileys = $Smileys;
   }

	/**
	 * Thanks to punbb 1.3.5 (GPL License) for this function - ported from their do_smilies function.
	 */
	public static function DoEmoticons($Text) {
		$Text = ' '.$Text.' ';
		$Emoticons = EmotifyPlugin::GetEmoticons();
		foreach ($Emoticons as $Key => $Replacement) {
			if (strpos($Text, $Key) !== FALSE)
				$Text = preg_replace(
					"#(?<=[>\s])".preg_quote($Key, '#')."(?=\W)#m",
					'<span class="Emoticon Emoticon' . $Replacement . '"><span>' . $Key . '</span></span>',
					$Text
				);
		}

		return substr($Text, 1, -1);
	}

	/**
	 * Prepare a page to be emotified.
	 */
	private function _EmotifySetup($Sender) {
		$Sender->AddJsFile('emotify.js', 'plugins/Emotify');
		// Deliver the emoticons to the page.
      $Emoticons = array();
      foreach ($this->GetEmoticons() as $i => $gif) {
         if (!isset($Emoticons[$gif]))
            $Emoticons[$gif] = $i;
      }
      $Emoticons = array_flip($Emoticons);

		$Sender->AddDefinition('Emoticons', base64_encode(json_encode($Emoticons)));
	}

	public function Setup() {
		//SaveToConfig('Plugins.Emotify.FormatEmoticons', TRUE);
		SaveToConfig('Garden.Format.Hashtags', FALSE); // Autohashing to search is incompatible with emotify
	}

}
