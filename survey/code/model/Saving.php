<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/9/2016
 * Time: 10:34 AM
 */
class Saving extends DataObject
{
    private static $db = array(
        'EducationFund' => 'Boolean',
        'LifeInsurance' => 'Boolean',
        'HealthInsurance' => 'Boolean',
        'DeathFund' => 'Boolean',
        'MarriageFund' => 'Boolean',
        'KLM' => 'Boolean',
        'Chitty' => 'Boolean',
        'WIDs' => 'Boolean',
        'Others' => 'Boolean',
        'Specify' => 'Varchar(100)'
    );

    private static $has_one = array(
        'Family' => 'Family'
    );

    private static $field_labels = array(
        'HasEducationFund' => 'Has EducationFund',
        'HasLifeInsurance' => 'Has LifeInsurance',
        'HasHealthInsurance' => 'Has HealthInsurance',
    );


    private static $summary_fields = array(
        'HasEducationFund',
        'HasLifeInsurance',
        'HasHealthInsurance'
    );


    public function HasEducationFund(){
        if($this->EducationFund)
            return 'Yes';
        else
            return 'No';
    }

    public function HasLifeInsurance(){
        if($this->LifeInsurance)
            return 'Yes';
        else
            return 'No';
    }

    public function HasHealthInsurance(){
        if($this->HealthInsurance)
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

	
	public function PrintSavings(){
		$savingsArray = array('EducationFund','LifeInsurance','HealthInsurance',
								'DeathFund', 'MarriageFund','Mythri', 'Chitty',	'Others',							
							);
		$savings = null;
		foreach($savingsArray as $saving){
			if($this->$saving){
				if($this->$saving && $saving =='Others')
					$savings .= $saving.'('.$this->Specify.'), ';
				else
					$savings .= $saving.', ';
			}			
		}		
		return rtrim($savings, ', ');		
	}
	

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Savings'),'EducationFund');

        $fields->replaceField('Specify', new TextField('Specify','If others checked, please mention'));

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
