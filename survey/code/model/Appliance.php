<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/9/2016
 * Time: 10:34 AM
 */
class Appliance extends DataObject
{
    private static $db = array(
        //'Computer' => 'Boolean',
        'WashingMachine' => 'Boolean',
        'AirConditioner' => 'Boolean',
        'MicrowaveOven' => 'Boolean',
        'CookingGas' => 'Boolean',
        'Fridge' => 'Boolean',
        'Others' => 'Boolean',
        'Specify' => 'Varchar(100)'
    );

    private static $has_one = array(
        'Family' => 'Family'
    );

    private static $field_labels = array(
        'HasComputer' => 'Has Computer',
        'HasWashingMachine' => 'Has WashingMachine',
        'HasAirConditioner' => 'Has AirConditioner',
    );

    private static $summary_fields = array(
        'HasComputer',
        'HasWashingMachine',
        'HasAirConditioner'
    );


    public function HasComputer(){
        if($this->Computer)
            return 'Yes';
        else
            return 'No';
    }

    public function HasWashingMachine(){
        if($this->WashingMachine)
            return 'Yes';
        else
            return 'No';
    }

    public function HasAirConditioner(){
        if($this->AirConditioner)
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

	public function AppliancesOwned(){
		$appliancesArray = array('Computer','WashingMachine','AirConditioner',
								'MicrowaveOven', 'CookingGas','Fridge',	'Others',							
							);
		$appliances = null;
		foreach($appliancesArray as $appliance){
			if($this->$appliance){
				if($this->$appliance && $appliance =='Others')
					$appliances .= $appliance.'('.$this->Specify.'), ';
				else
					$appliances .= $appliance.', ';
			}			
		}		
		return rtrim($appliances, ', ');		
	}
	
    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Appliance'),'Computer');

        $fields->replaceField('Specify', new TextField('Specify','If others checked,please mention'));

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
