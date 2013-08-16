<?php if (!defined('APPLICATION')) exit();

class IceFireBootstrapThemeHooks implements Gdn_IPlugin {

	public function Setup() {
		return TRUE;
	}

	public function OnDisable() {
		return TRUE;
	}

	public function Base_Render_Before($Sender) {

		// Remove unnecessary files
		$Sender->RemoveJsFile('jquery.autogrow.js');

	}

	// Add excerpts to discussion listings
	public function DiscussionsController_AfterDiscussionTitle_Handler($Sender) {

		$Excerpt = $Sender->EventArguments['Discussion']->Body;
		echo Wrap(SliceString(strip_tags($Excerpt), 100), 'div', array(
			'class'  => "Excerpt"
		));

	}

	public function CategoriesController_AfterDiscussionTitle_Handler($Sender) {
		$this->DiscussionsController_AfterDiscussionTitle_Handler($Sender);
	}
}
