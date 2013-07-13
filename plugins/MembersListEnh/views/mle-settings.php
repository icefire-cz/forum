<?php if (!defined('APPLICATION'))exit();
echo $this->Form->Open();
echo $this->Form->Errors();
?>


<h1><?php echo Gdn::Translate('Members List Enhanced'); ?></h1>

<div class="Info"><?php echo Gdn::Translate('Members List Enhanced Option.'); ?></div>

<table class="AltRows">
    <thead>
        <tr>
            <th><?php echo Gdn::Translate('Option'); ?></th>
            <th class="Alt"><?php echo Gdn::Translate('Description'); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>

                <?php
                $Options = array('10' => '10', '15' => '15', '20' => '20', '25' => '25', '30' => '30', '50' => '50', '100' => '100', '200' => '200');
                $Fields = array('TextField' => 'Code', 'ValueField' => 'Code');
                echo $this->Form->Label('Users per Page', 'Plugins.MembersListEnh.DCount');
                echo $this->Form->DropDown('Plugins.MembersListEnh.DCount', $Options, $Fields);
                ?>

            </td>
            <td class="Alt">
<?php echo Gdn::Translate('Enter the number of Users to list per page'); ?>
            </td>
        </tr>
    
        <tr> <td>  Column Selections</td></tr>
      
        <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                        'Plugins.MembersListEnh.ShowPhoto', 'ShowPhoto', array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
<?php echo Gdn::Translate('Display Photo Column in Members List'); ?>
            </td>
        </tr>

     
       <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                        'Plugins.MembersListEnh.ShowLike', 'Show Liked', array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Display Liked Column in Members List (LikeThis Plugin must be Enabled)'); ?>
            </td>
        </tr>
       
         <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                        'Plugins.MembersListEnh.ShowThank', 'Show Thanked', array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Display Thank Count Column in Members List (Thankful People Plugin must Be Enabled)'); ?>
            </td>
        </tr>
       
         <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                        'Plugins.MembersListEnh.ShowKarma', 'Show Karma', array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Display Karma Balance Column in Members List (KarmaBalance Plugin must be enabled)'); ?>
            </td>
        </tr>
       
       
       
       
       
       
        <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                        'Plugins.MembersListEnh.ShowID', 'Show ID', array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Display UserID Column in Members List'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                        'Plugins.MembersListEnh.ShowRoles', 'Show Roles', array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Display User Role Column in Members List'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                        'Plugins.MembersListEnh.ShowFVisit', 'Show FVisit', array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
<?php echo Gdn::Translate('Display First Visit Column in Members List'); ?>
            </td>
        </tr>

        <tr>
            <td>
<?php
echo $this->Form->CheckBox(
        'Plugins.MembersListEnh.ShowLVisit', 'ShowLVisit', array('value' => '1', 'selected' => 'selected')
);
?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Display Last Visit Column in Members List'); ?>
            </td>
        </tr>
        <tr>
            <td>
<?php
echo $this->Form->CheckBox(
        'Plugins.MembersListEnh.ShowEmail', 'Show Email', array('value' => '1', 'selected' => 'selected')
);
?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Display Email Column in Members List (only users with permission will be able to view column'); ?>
            </td>
        </tr>

        <tr>

        <tr>
            <td>
<?php
echo $this->Form->CheckBox(
        'Plugins.MembersListEnh.ShowIP', 'Show IP', array('value' => '1', 'selected' => 'selected')
);
?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Display IP Address Column in Members List (only users with permission will be able to view column'); ?>
            </td>
        </tr>

        <tr>


        <tr>
            <td>
<?php
echo $this->Form->CheckBox(
        'Plugins.MembersListEnh.ShowVisits', 'Show Visits', array('value' => '1', 'selected' => 'selected')
);
?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Display Number of Visits Column in Members List'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                        'Plugins.MembersListEnh.ShowDiCount', 'ShowDiCount', array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Display Number of Discussions Column in Members List'); ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                        'Plugins.MembersListEnh.ShowCoCount', 'ShowCoCount', array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Display Number of Comments Column in Members List'); ?>
            </td>
        </tr>



</table>

<br />
<br />    

<?php
echo $this->Form->Close('Save'); ?>


<table>
<tr><td>
<h1>Please consider making a small contribution by clicking on the donate button </h1>
</td><td>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="R78ZA8B7MTFYW">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</td></tr>

</table>
<table>
<tr><td>
     <h1>Important:  After Completion of Checking Columns </h1> 
              <p> The GenView - is generally for Logged in users who do not have Administrative Roles.
              <p> Please Select GenView in the Roles and Permission (see side panel) for any Roles that you want to permit viewing of the table.  The Genview checkbox option in Roles and Permissions will display every column you check here EXCEPT email and ipaddress (even if you check the ip address and email boxes).
               <p> The IPEmailView - is generally for Administration roles.
               <p>After Completion  - Please Select The IPEmailView in the Roles and Permission (see side panel) for any Roles that you want to permit viewing of the table. The IPEmailView will display EVERY column you checked above INCLUDING email and ipaddress if the the ip address and email boxes are checked.
                <p> Summary Example:  If you want the administrator to view all columns including email and ip address check all boxes above and give the Administrator IPEmailView in the Roles and Permission of the sidepanel.  Give any other roles (members,etc) the  GenView permission in the Roles and Permission (see side panel) and they will view all columns checked above (But Not ip address and email columns).
                <p>

</td></tr>
</table>
