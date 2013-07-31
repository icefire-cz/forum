<?php if (!defined('APPLICATION')) exit();
/** Displays the "Edit My Profile" or "Back to Profile" buttons on the top of the profile page. */
echo '<div class="ProfileOptions">';
   $Controller = Gdn::Controller();
   $Controller->FireEvent('BeforeProfileOptions');
   $Links = $Controller->EventArguments['ProfileOptions'];
   if (count($Links) == 0) {
      echo ButtonGroup($Controller->EventArguments['MemberOptions'], 'btn');

   } elseif (count($Links) == 1) {
      $Link = array_pop($Links);
      echo Anchor($Link['Text'], $Link['Url'], 'btn');

   } else {
      echo '<div class="btn-group">';
      echo ButtonGroup($Controller->EventArguments['MemberOptions'], 'btn');
      echo '<button class="btn dropdown-toggle" data-toggle="dropdown">';
         echo '<span class="caret"></span>';
      echo '</button>';
      echo '<ul class="dropdown-menu">';
         foreach ($Links as $Link) {
            echo Wrap(Anchor($Link['Text'], $Link['Url'], GetValue('CssClass', $Link, '')), 'li');
         }
      echo '</ul></div>';
   }
echo'</div>';
