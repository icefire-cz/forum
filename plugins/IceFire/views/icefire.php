<?php if (!defined('APPLICATION')) exit();

echo '<h2>Ice & Fire nastavení</h2>';
echo $this->Form->Open();
echo $this->Form->Errors();
   echo '<ul>';
      echo '<li>';
         echo '<strong>Vyber knihy, které jsi četl(a).</strong>';
         echo $this->Form->CheckBox('Book1','Hra o trůny');
         echo $this->Form->CheckBox('Book2','Střet králů');
         echo $this->Form->CheckBox('Book3','Bouře mečů');
         echo $this->Form->CheckBox('Book4','Hostina pro vrány');
         echo $this->Form->CheckBox('Book5','Tanec s draky');
      echo '</li>';
      echo '<li>';
         echo $this->Form->Label('Vepiš text, který se zobrazí vedle nicku (max 32 znaků).', 'Words');
         echo $this->Form->TextBox('Words');
      echo '</li>';
   echo '</ul>';
echo $this->Form->Close('Save', '', array('class' => 'Button Primary'));
?>
