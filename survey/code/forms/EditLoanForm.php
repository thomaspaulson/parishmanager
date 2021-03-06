<?php
class EditLoanForm extends BaseForm{
	
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
		
		$fields->push(CheckboxField::create('HasLoan','HasLoan'));
		
		/*		
        $fromArr = singleton('Loan')->dbObject('FromWhere')->enumValues();
        $fields->push(DropdownField::create('FromWhere','FromWhere',$fromArr)->setEmptyString('select...'));        
        */
        
		$fields->push(CheckboxField::create('FromBank','Bank'));
		$fields->push(CheckboxField::create('FromPrivateBank','Private-bank'));
		$fields->push(CheckboxField::create('FromPerson','Person'));
		$fields->push(TextField::create('Reason','Reason'));
		
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
    	$loan = DataObject::get_by_id('Loan',$id);
    	//$family = Family::create();
    	$form->saveInto($loan);
    	$loan->write();
    	 
    	 
		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$redirectUrl
		);
		
    }	
}
