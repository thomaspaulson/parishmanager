<?php
class EditBusinessForm extends BaseForm{
	
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
		
		$fields->push(CheckboxField::create('Streetvendor','Streetvendor'));
		$fields->push(CheckboxField::create('Unduvandi','Unduvandi'));
		$fields->push(CheckboxField::create('Pettikada','Pettikada'));
		$fields->push(CheckboxField::create('Shop','Shop'));
		$fields->push(CheckboxField::create('Trade','Trade'));
		$fields->push(CheckboxField::create('Industry','Industry'));
		$fields->push(CheckboxField::create('Selfemployed','Selfemployed'));
		$fields->push(CheckboxField::create('Others','Others'));					
		$fields->push(TextField::create('Specify','Other(specify)'));         
		
        //$types = singleton('Business')->dbObject('Type')->enumValues();
        //$fields->push(ListboxField::create('Type','Type',$types));
        //$fields->push(TextField::create('Other','Other(specify)')); 
        
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
        return RequiredFields::create(array('Status','Type'));
    }

    /**
     * @param $data array Data from request vars
     * @param $form ContactForm The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
    	$id = (int)$data['ID'];
    	$business = DataObject::get_by_id('Business',$id);    	
    	$form->saveInto($business);
    	$business->write();
    	 
    	 
		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$redirectUrl
		);
		
    }	
}
