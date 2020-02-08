<?php
class EditSavingForm extends BaseForm{
	
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
		
		$fields->push(CheckboxField::create('EducationFund','Education Fund'));
		$fields->push(CheckboxField::create('LifeInsurance','Life Insurance'));
		$fields->push(CheckboxField::create('HealthInsurance','Health Insurance'));
		$fields->push(CheckboxField::create('DeathFund','Death Fund'));
		$fields->push(CheckboxField::create('MarriageFund','Marriage Fund'));
		$fields->push(CheckboxField::create('KLM','KLM'));
		$fields->push(CheckboxField::create('Chitty','Chitty'));
		$fields->push(CheckboxField::create('WIDs','WIDs'));		
		$fields->push(CheckboxField::create('Others','Others'));					
		$fields->push(TextField::create('Specify','Other(specify)')); 
		        
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
    	$saving = DataObject::get_by_id('Saving',$id);    	
    	$form->saveInto($saving);
    	$saving->write();
    	 
    	 
		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$redirectUrl
		);
		
    }	
}
