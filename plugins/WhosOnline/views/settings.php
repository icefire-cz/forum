<?php if (!defined('APPLICATION')) exit(); ?>
<h2><?php echo T("Who's Online Settings"); ?></h2>
<?php
echo $this->Form->Open();
echo $this->Form->Errors();
?>
<ul>
   <li>
      <?php
         echo $this->Form->CheckBox('Plugin.WhosOnline.Invisible','Skrýt mé jméno');
      ?>
   </li>

</ul>
<?php echo $this->Form->Close('Save', '', array('class' => 'Button Primary'));
