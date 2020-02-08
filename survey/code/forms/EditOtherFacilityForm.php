<?php
class EditOtherFacilityForm extends BaseForm{
	
    public function __construct(
        $controller,
        $name,
        FieldList $fields = null,
        FieldList $actions = null,
        $validator = null
    ) {
        parent::__construct($controller, $name, $fields, $actions, $validator);
        $this->addExtraClass('js-places-search-form');	       
    }

    public function getFormFields() {       
		
        $fields = parent::getFormFields();		
        
		$fields->push(CheckboxField::create('WaterWell','WaterWell'));
		$fields->push(CheckboxField::create('DrillWell','DrillWell'));
		$fields->push(CheckboxField::create('WaterConnection','WaterConnection'));
		$fields->push(CheckboxField::create('RainwaterStorage','RainwaterStorage'));
		$fields->push(CheckboxField::create('Biogas','Biogas'));
		$fields->push(CheckboxField::create('Electricity','Electricity'));					
		$fields->push(CheckboxField::create('SolarEnergy','SolarEnergy'));
        
		$fields->push(HiddenField::create('FamilyID','FamilyID'));
		$fields->push(HiddenField::create('RedirectURL','RedirectURL'));
		
		$fields->push(HiddenField::create('ID','ID'));		
		
		//$fields->push( PhoneNumberField::create('Phone','HouseNo'));
		//$fields->push(HiddenField::create('ParishID','ParishID'));
	    return $fields;
    }

    public function getFormActions() {
        $actions = parent::getFormActions();
        $actions->first()->setTitle('Edit');
        $cancel = FormAction::create('doCancel', 'Cancel')->setUseButtonTag(true);
        $cancel->addExtraClass('secondary');
        $actions->push($cancel);
        return $actions;
    }

    public function getFormValidator() {
        return RequiredFields::create(array());
    }

    /**
     * @param $data array Data from request vars
     * @param $form ContactForm The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
    	$id = (int)$data['ID'];
    	$otherFacility = DataObject::get_by_id('OtherFacility',$id);    	
    	$form->saveInto($otherFacility);
    	$otherFacility->write();
    	 
    	 
		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$redirectUrl
		);
		
    }	
}
