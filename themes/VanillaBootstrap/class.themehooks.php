<?php if (!defined('APPLICATION')) exit();

class VanillaBootstrapThemeHooks implements Gdn_IPlugin {

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

	// Add input notifiers to comment form
	public function DiscussionController_BeforeFormButtons_Handler($Sender) {
		if (C('Garden.InputFormatter') == 'Markdown')
			echo '<span class="MarkupHelp hidden-phone hidden-tablet">You can use <b><a href="http://en.wikipedia.org/wiki/Markdown">Markdown</a></b> in your post</span>';
		if (C('Garden.InputFormatter') == 'BBCode')
			echo '<span class="MarkupHelp hidden-phone hidden-tablet">You can use <b><a href="http://en.wikipedia.org/wiki/BBCode">BBCode</a></b> in your post</span>';
		if (C('Garden.InputFormatter') == 'Html')
			echo '<span class="MarkupHelp hidden-phone hidden-tablet">You can use <b><a href="http://htmlguide.drgrog.com/cheatsheet.php">Simple Html</a></b> in your post</span>';
	}

}
