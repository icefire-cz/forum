<?php if (!defined('APPLICATION')) exit();

class LatestCommentModule extends Gdn_Module {
	protected $_LatestComments;
    protected $_NewCommentsCount;

	public function __construct($Sender = '') {
		parent::__construct($Sender);
	}

    public function GetAllDiscussion(){
		$SQL = Gdn::SQL();
		return $SQL->Select('p.DiscussionID, p.CategoryID, p.Name, p.Body, p.DateLastComment, p.LastCommentUserID, p.CountComments')
                   ->From('Discussion p')
                   ->OrderBy('p.DateLastComment', 'desc')
                   ->Get()
                   ->ResultArray();         
	}

	public function GetData() {
		$SQL = Gdn::SQL();		
		$Limit = Gdn::Config('LatestComment.Limit');
		$LatestOrMost = Gdn::Config('LatestComment.LatestOrMost');
		$Limit = (!$Limit || $Limit ==0)?10:$Limit;
		$Session = Gdn::Session();
        $UserID = $Session->UserID;
		$this->_LatestComments = $SQL->Query(
                'SELECT DiscussionID, CategoryID, Name, Body, DateLastComment, LastCommentUserID, CountComments From '
                .$SQL->Database->DatabasePrefix.'Discussion order by DateLastComment desc LIMIT '.$Limit);
        foreach($this->_LatestComments->Result() as $Discussion) {
            $NewCount = Gdn::SQL()
                    ->Select('CountComments')
                    ->From('UserDiscussion')
                    ->Where('UserID =', $UserID)
                    ->Where('DiscussionID =', $Discussion->DiscussionID)
                    ->Get()
                    ->Value('CountComments');
            $this->_NewCommentsCount[$Discussion->DiscussionID] = $Discussion->CountComments - $NewCount;
        }
	}
	
	public function getLatestComments(){
		return $this->_LatestComments;
	}

	public function AssetTarget() {
		return 'Panel';
	}

	public function ToString() {
		$String = '';
		$Session = Gdn::Session();
		ob_start();
		$LatestOrMost = Gdn::Config('LatestComment.Show.LatestComment');
		//Hide the top poster box id there's no post greater than 0
		if($this->_LatestComments->NumRows() > 0) {
		?>		
			<div id="LatestComment" class="Box BoxLatestComment">
				<h4><?php if($LatestOrMost == "YES") echo T("Latest Commented"); else echo T("Most Commented"); ?></h4>
				<ul class="PanelInfo PanelLatestComment">
				<?php
					$i =1;
					foreach($this->_LatestComments->Result() as $Discussion) {
                        $UnreadComments = $this->_NewCommentsCount[$Discussion->DiscussionID];
						if ($UnreadComments > 0) {
							$Count = ' <span class="Aside"><span class="Count">'.$UnreadComments.'</span></span>';
						} else {
							$Count = '';
						}					
				?>
					<li><span><strong>
		    			<a href="/forum/discussion/<?php echo $Discussion->DiscussionID; ?>#latest"><?php echo $Discussion->Name; ?></a>
					</span></strong><?php echo $Count; ?></li>
				<?php
					$i++;
					}
				?>
			</ul>
		</div>
		<?php
		}
		$String = ob_get_contents();
		@ob_end_clean();
		return $String;
	}
}
