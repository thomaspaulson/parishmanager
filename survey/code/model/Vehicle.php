<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/9/2016
 * Time: 10:34 AM
 */
class Vehicle extends DataObject
{
    private static $db = array(
        'Cycle' => 'Boolean',
        'Bike' => 'Boolean',
        'Autoriskaw' => 'Boolean',
        'LightVehicle' => 'Boolean',
        'HeavyCommercial' => 'Boolean',
        'CountryBoat' => 'Boolean',
        'Vallam' => 'Boolean',
        'FishingBoat' => 'Boolean',
        'TouristBoat' => 'Boolean',
		'Others' => 'Boolean',  		      																
        'Specify' => 'Varchar(100)'
        
    );

    private static $has_one = array(
        'Family' => 'Family'
    );

    private static $field_labels = array(
        'HasCycle' => 'Has Cycle',
        'HasBike' => 'Has Bike',
        'HasAutoriskaw' => 'Has Autoriskaw',
    );


    private static $summary_fields = array(
        'HasCycle',
        'HasBike',
        'HasAutoriskaw'
    );

    public function HasCycle(){
        if($this->Cycle)
            return 'Yes';
        else
            return 'No';
    }

    public function HasBike(){
        if($this->Bike)
            return 'Yes';
        else
            return 'No';
    }

    public function HasAutoriskaw(){
        if($this->Autoriskaw)
            return 'Yes';
        else
            return 'No';
    }

    public function HasLightVehicle(){
        if($this->LightVehicle)
            return 'Yes';
        else
            return 'No';
    }
	
    public function HasHeavyCommercial(){
        if($this->HeavyCommercial)
            return 'Yes';
        else
            return 'No';
    }
	
    public function HasCountryBoat(){
        if($this->CountryBoat)
            return 'Yes';
        else
            return 'No';
    }
	
    public function HasVallam(){
        if($this->Vallam)
            return 'Yes';
        else
            return 'No';
    }

    public function HasFishingBoat(){
        if($this->FishingBoat)
            return 'Yes';
        else
            return 'No';
    }
    public function HasTouristBoat(){
        if($this->TouristBoat)
            return 'Yes';
        else
            return 'No';
    }

	public function VehiclesOwned(){
		$vehiclesArray = array('Cycle','Bike','Autoriskaw','LightVehicle',
						'HeavyCommercial','CountryBoat',	'Vallam',
						'FishingBoat','TouristBoat'
					);
		$vehicles = null;
		foreach($vehiclesArray as $vehicle){
			if($this->$vehicle){
				$vehicles .= $vehicle.', ';
			}			
		}		
		return rtrim($vehicles, ', ');
	}
	
    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Vehicles Details'),'Cycle');

		
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
