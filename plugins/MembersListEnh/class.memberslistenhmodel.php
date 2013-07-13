<?php if(!defined('APPLICATION')) exit();

class MembersListEnhModel extends VanillaModel{
 
public function GetMembersListEnh($Limit=5, $Offset=0, $SortOrder, $UserField){
  //   ->Select('Name,UserID,Email,CountVisits, DateFirstVisit,DateLastActive, LastIPAddress, CountDiscussions, CountComments,Photo')
    // ->Where('Deleted',false)
    //  ->Where (array('Deleted'=>'false', 'User.Name <>' => 'System' )) 
    // ->Where (array('Deleted'=>'false', 'User.Name <>' => 'System' )) 
 
 
if (C('EnabledPlugins.KarmaBank') == TRUE) {
 
   
    if($UserField != "Balance") {
    
     $MembersListEnhModel = new Gdn_Model('User');
        $Sender->UserData = $MembersListEnhModel->SQL
        ->Select('*')
        ->From('User u')
        ->LeftJoin('KarmaBankBalance kb', 'u.UserID = kb.UserID')
        ->OrderBy("u.$UserField",$SortOrder)
        ->Where('Deleted',false)
        ->Limit($Limit, $Offset)
        ->Get();
       RoleModel::SetUserRoles($Sender->UserData->Result());
       return $Sender->UserData;
    }  else {
     $MembersListEnhModel = new Gdn_Model('User');
        $Sender->UserData = $MembersListEnhModel->SQL
        ->Select('*')
        ->From('User u')
        ->LeftJoin('KarmaBankBalance kb', 'u.UserID = kb.UserID')
        ->OrderBy("kb.Balance",$SortOrder)
        ->Where('Deleted',false)
        ->Limit($Limit, $Offset)
        ->Get();
       RoleModel::SetUserRoles($Sender->UserData->Result());
       return $Sender->UserData;
    
  }  
}   else {

$MembersListEnhModel = new Gdn_Model('User');
        $Sender->UserData = $MembersListEnhModel->SQL
        ->Select('*')
        ->From('User u')
        ->OrderBy("u.$UserField",$SortOrder)
        ->Where('Deleted',false)
        ->Limit($Limit, $Offset)
        ->Get();
       RoleModel::SetUserRoles($Sender->UserData->Result());
       return $Sender->UserData;
}

}    
     
    public function GetMembersCount(){
     $MembersListEnhModel = new Gdn_Model('User');
    return $MembersListEnhModel->SQL
        ->GetCount('User');
     
    }

}



  
