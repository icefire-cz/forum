<?php if (!defined('APPLICATION')) exit(); ?>
<h2><?php echo T("Who's Online Settings"); ?></h2>
<?php
echo $this->Form->Open();
echo $this->Form->Errors();
?>
<ul>
   <li>
      <?php
         echo $this->Form->Label('Hide My Name');
         echo $this->Form->CheckBox('Plugin.WhosOnline.Invisible','This will remove your name from the list. (You will still be counted)');
      ?>
   </li>

</ul>
<?php echo $this->Form->Close('Save');