<?php
class AddHealthForm extends BaseForm{
	
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
		$fields->push(CheckboxField::create('Blind','Blind'));
		$fields->push(CheckboxField::create('Deaf','Deaf'));
		$fields->push(CheckboxField::create('Dumb','Dumb'));
		$fields->push(CheckboxField::create('OtherPhysicalDisability','Other Physical Disability'));
		//$fields->push(CheckboxField::create('LearningDisability','LearningDisability'));
		$fields->push(CheckboxField::create('MentalDisability','Mental Disability'));
		$fields->push(CheckboxField::create('HearthDisease','Heart Disease'));
		$fields->push(CheckboxField::create('Diabetes','Diabetes'));
		$fields->push(CheckboxField::create('Cancer','Cancer'));					
		$fields->push(CheckboxField::create('BloodPressure','Blood Pressure'));
		$fields->push(CheckboxField::create('Alcoholic','Alcoholic'));
		$fields->push(CheckboxField::create('OtherDisease','Any other disease'));					
		$fields->push(TextField::create('OtherHealthInfo','Other health info'));         
        

        $fields->push(HiddenField::create('FamilyMemberID','FamilyMemberID'));
		$fields->push(HiddenField::create('RedirectURL','RedirectURL'));		

	    return $fields;
    }

    public function getFormActions() {
        $actions = parent::getFormActions();
        $actions->first()->setTitle('Create');
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
		//Debug::show($data); exit();
        $health = Health::create();
		$form->saveInto($health);		
		$health->write();

		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$redirectUrl
		);
		
    }	
}
