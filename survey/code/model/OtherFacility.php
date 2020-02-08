<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/9/2016
 * Time: 10:34 AM
 */
class OtherFacility extends DataObject
{
    private static $db = array(
        'WaterWell' => 'Boolean',
        'DrillWell' => 'Boolean',
        'WaterConnection' => 'Boolean',
        'RainwaterStorage' => 'Boolean',
        'Biogas' => 'Boolean',
        'Electricity' => 'Boolean',
        'SolarEnergy' => 'Boolean',
        //'VegetableGarden' => 'Boolean'
    );

    private static $has_one = array(
        'Family' => 'Family'
    );


    private static $field_labels = array(
        'HasWaterWell' => 'Has WaterWell',
        'HasDrillWell' => 'Has DrillWell',
        'HasWaterConnection' => 'Has WaterConnection',
    );

    private static $summary_fields = array(
        'HasWaterWell',
        'HasDrillWell',
        'HasWaterConnection'
    );


    public function HasWaterWell(){
        if($this->WaterWell)
            return 'Yes';
        else
            return 'No';
    }

    public function HasDrillWell(){
        if($this->DrillWell)
            return 'Yes';
        else
            return 'No';
    }

    public function HasWaterConnection(){
        if($this->WaterConnection)
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
	
	public function Facilities(){
		
		$facilitiesArray = array('WaterWell','DrillWell','WaterConnection','RainwaterStorage',
							'Biogas','Electricity',	'SolarEnergy', 'VegetableGarden'						
						);
		$facilities = null;
		foreach($facilitiesArray as $facility){
			if($this->$facility){
				$facilities .= $facility.', ';
			}			
		}		
		return rtrim($facilities, ', ');
		
	}	

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Other Facility'),'WaterWell');

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
