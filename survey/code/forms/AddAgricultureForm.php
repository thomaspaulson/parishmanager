<?php
class AddAgricultureForm extends BaseForm{
	
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
        
		$fields->push(CheckboxField::create('Cocunut','Cocunut'));
		$fields->push(CheckboxField::create('Produce','Vegetables'));
		$fields->push(CheckboxField::create('Paddy','Rice'));
		$fields->push(CheckboxField::create('Fruit','Fruit'));
		$fields->push(CheckboxField::create('Fish','Fish'));
		$fields->push(CheckboxField::create('Cow','Cow'));
		$fields->push(CheckboxField::create('Goat','Goat'));
		$fields->push(CheckboxField::create('Chicken','Chicken'));
		$fields->push(CheckboxField::create('Duck','Duck'));
		$fields->push(CheckboxField::create('Others','Others'));					
		$fields->push(TextField::create('Specify','Other(specify)')); 
				        
        //$types = singleton('Agriculture')->dbObject('Type')->enumValues();
        //$fields->push(ListboxField::create('Type','Type',$types));
        //$fields->push(TextField::create('Specify','Other(specify)')); 

        $fields->push(HiddenField::create('FamilyID','FamilyID'));
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
        return RequiredFields::create(array('Status','Type'));
    }

    /**
     * @param $data array Data from request vars
     * @param $form ContactForm The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
		//Debug::show($data); exit();
		//$email = $data['Email'];
        $agriculture = Agriculture::create();
		$form->saveInto($agriculture);		
		$agriculture->write();

		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$redirectUrl
		);
		
    }	
}
