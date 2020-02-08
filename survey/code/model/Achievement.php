<?php
class Achievement extends DataObject{
	private static $db = array(
		'Title' => 'Varchar(255)',
		'Category' => 'Varchar(100)',
		'FromWhere' => 'Varchar(100)',
		'Year' => 'Int'
	);
	

    private static $has_one = array(
        'FamilyMember' => 'FamilyMember'
    );
    
    
	public function Link($action = null, $BackURL = null ){		
		$controller = new AchievementController();
		$url = $controller->Link();
		if($BackURL){
			return Controller::join_links(
				$url,
				$action.'/'.$this->ID,
				'?RedirectURL=' . urlencode($BackURL)			
				);
		}
		else{
			return Controller::join_links(
				$url,
				$action.'/'.$this->ID
				);			
		}		
		
		/*
		if($BackURL){
			return Controller::join_links(
				$url,
				'show/'.$this->ID,
				'?RedirectURL=' . urlencode($BackURL)			
				);
		}
		else{
			return Controller::join_links(
				$url,
				'show/'.$this->ID
				);			
		}
		*/
	}
    
	
}
