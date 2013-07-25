<?php if (!defined('APPLICATION')) exit();
$ShowAllCategoriesPref = Gdn::Session()->GetPreference('ShowAllCategories');
$Url = Gdn::Request()->Path();
?>

<div class="Box">
   <h4><?php echo T('Category Filter'); ?></h4>
   <ul class="PanelInfo">
      <?php
      if ($ShowAllCategoriesPref):
         echo Wrap(Anchor(T('all categories'), $Url), 'li', array('class' => 'active'));
         echo Wrap(Anchor(T('followed categories'), $Url.'?ShowAllCategories=false'), 'li');
      else:
         echo Wrap(Anchor(T('all categories'), $Url.'?ShowAllCategories=true'), 'li');
         echo Wrap(Anchor(T('followed categories'), $Url), 'li', array('class' => 'active'));
      endif;
      ?>
   </ul>
</div>
