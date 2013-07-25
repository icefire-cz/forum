<?php if (!defined('APPLICATION')) exit();

echo $this->Form->Open();
echo $this->Form->Errors();
   echo '<h3>Ice & Fire nastavení</h3>';
   echo '<ul><li>';
      echo '<strong>Vyber knihy, které jsi četl(a).</strong>';
      echo $this->Form->CheckBox('Book1','Hra o trůny');
      echo $this->Form->CheckBox('Book2','Střet králů');
      echo $this->Form->CheckBox('Book3','Bouře mečů');
      echo $this->Form->CheckBox('Book4','Hostina pro vrány');
      echo $this->Form->CheckBox('Book5','Tanec s draky');
   echo '</li></ul>';
echo $this->Form->Close('Save', '', array('class' => 'Button Primary'));
?>
