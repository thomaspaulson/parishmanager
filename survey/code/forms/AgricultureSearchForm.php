<?php
//
class AgricultureSearchForm extends BaseForm {
	#code
	
	public function __construct(
			$controller,
			$name,
	        FieldList $fields = null,
			FieldList $actions = null,
			$validator = null
	){
        parent::__construct($controller, $name, $fields, $actions, $validator);
        //$this->addExtraClass('js-places-search-form');
	}
	
    public function getFormFields() {

        $fields = parent::getFormFields();
		/*
        $typeArray = singleton('Agriculture')->dbObject('Type')->enumValues();
        $typeField = DropdownField::create('Type', 'Type',$typeArray);
        $typeField->setEmptyString('select any');
        $fields->push($typeField);*/

		$fields->push(CheckboxField::create('Cocunut','Cocunut'));
		$fields->push(CheckboxField::create('Produce','Vegetable'));
		$fields->push(CheckboxField::create('Paddy','Rice'));
		$fields->push(CheckboxField::create('Fruit','Fruit'));
		$fields->push(CheckboxField::create('Fish','Fish'));
		$fields->push(CheckboxField::create('Cow','Cow'));
		$fields->push(CheckboxField::create('Goat','Goat'));
		$fields->push(CheckboxField::create('Chicken','Chicken'));
		$fields->push(CheckboxField::create('Duck','Duck'));
		$fields->push(CheckboxField::create('Others','Others'));					
		/*
        $parishes = Parish::get()->map('ID', 'NameWithLocation')->toArray();
        $parishField = DropdownField::create('ParishID', 'Parish')
            ->setSource($parishes);
        $parishField->setEmptyString('All Parish');
        $parishField->setValue(parent::getDefaultParishID());
        $fields->push($parishField);
        */ 

        return $fields;
    }

    public function getFormActions() {
        $actions = parent::getFormActions();
        $actions->first()->setTitle('Search');
        return $actions;
    }

    public function getFormValidator() {
        return RequiredFields::create();
    }

    /**
     * @param $data array Data from request vars
     * @param $form ContactForm The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
        
    }
	
}
