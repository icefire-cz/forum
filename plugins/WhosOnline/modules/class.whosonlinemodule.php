<?php if (!defined('APPLICATION')) exit();
/**
* Renders a list of users who are taking part in a particular discussion.
*/
class WhosOnlineModule extends Gdn_Module {

	protected $_OnlineUsers;

	public function __construct($Sender = '') {
		parent::__construct($Sender);
	}

	public function GetData() {
		$SQL = Gdn::SQL();
		$Session = Gdn::Session();

		$Frequency = C('WhosOnline.Frequency', 4);
		$History = time() - $Frequency;

		$SQL
			->Select('u.UserID, u.Name, w.Timestamp, w.Invisible')
			->From('Whosonline w')
			->Join('User u', 'w.UserID = u.UserID')
			->Where('w.Timestamp >=', date('Y-m-d H:i:s', $History))
			->OrderBy('u.Name');

		if (!$Session->CheckPermission('Plugins.WhosOnline.ViewHidden'))
			$SQL->Where('w.Invisible', 0);

		$this->_OnlineUsers = $SQL->Get();
	}

	public function AssetTarget() {
		return 'Panel';
	}

	public function ToString() {
		$String = '';
		if ($this->_OnlineUsers->NumRows() > 0) {
			foreach($this->_OnlineUsers->Result() as $User) {
				if($User->Invisible != 1) {
					$String .= Wrap(UserAnchor($User), 'li');
				}
			}

			$String = Wrap(T("Who's Online").' ('.$this->_OnlineUsers->NumRows().')', 'h4').Wrap($String, 'ul', array('class' => 'PanelInfo'));
			$String = Wrap($String, 'div', array('id' => 'WhosOnline', 'class' => 'Box'));
		}
		return $String;
	}
}
