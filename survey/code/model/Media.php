<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/9/2016
 * Time: 10:34 AM
 */
class Media extends DataObject
{
    private static $db = array(
        'Newspaper' => 'Boolean',
        //'NewspaperCount' => 'Int',
        //'NewspaperNames' => 'Varchar(100)',
        'Television' => 'Boolean',
        'Magazine' => 'Boolean',
        'KidsMagazine' => 'Boolean',        
        'Internet' => 'Boolean',
        'CatholicMagazine' => 'Boolean',
        'Computer' => 'Boolean',
        'Others' => 'Boolean',
        'Specify' => 'Varchar(100)'
    );

    private static $has_one = array(
        'Family' => 'Family'
    );

	
    private static $field_labels = array(
        'HasNewspaper' => 'Has Newspaper',
        'HasMagazine' => 'Has Magazine',
        'HasKidsMagazine' => 'Has KidsMagazine',
    );
    private static $summary_fields = array(
        'HasNewspaper',
        'HasMagazine',
        'HasKidsMagazine'
    );


    public function HasNewspaper(){
        if($this->Newspaper)
            return 'Yes';
        else
            return 'No';
    }

    public function HasMagazine(){
        if($this->Magazine)
            return 'Yes';
        else
            return 'No';
    }

    public function HasKidsMagazine(){
        if($this->KidsMagazine)
            return 'Yes';
        else
            return 'No';
    }
	
    public function HasOrNot($Title = null){		
        if($this->$Title && $Title)
            return 'Yes';
        else
            return 'No';
    }
	
	public function PrintMedia(){
		$mediaArray = array('Newspaper','Magazine','KidsMagazine',
								'Television', 'Internet','Mobile'							
							);
		$media = null;
		foreach($mediaArray as $medium){			
			if($this->$medium){
				$media .= $medium;
				switch($medium){
					case 'Newspaper':
						$media .= 	'('.$this->NewspaperCount.'-'.$this->NewspaperNames.'), ';
						break;
					case 'Mobile':
						$media .= 	'('.$this->MobileCount.'), ';
						break;
					default:
						$media .= 	', ';
						break;
				}
			}			
		}		
		return rtrim($media, ', ');		
	}


    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Media'),'Newspaper');

        return $fields;
    }

    function canView($member = null) {
        return true;
    }

    function canEdit($member = null) {
        return true;
    }

    function canDelete($member = null) {
        return true;
    }

    function canCreate($member = null) {
        return true;
    }

}
