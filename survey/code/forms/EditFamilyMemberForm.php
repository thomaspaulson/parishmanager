<?php
class EditFamilyMemberForm extends BaseForm{
	
	protected  $family; 
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

		$fields->push(TextField::create('Name','Name'));		
		$fields->push(TextField::create('Age','Age'));
		$dob = TextField::create('DateOfBirth','Date Of Birth (\'dd-mm-yyyy\')');
		//$dob->setDescription('dd-mm-yyyy');
		$fields->push($dob);
		$dob = TextField::create('DateOfMarriage','Date Of Marriage (\'dd-mm-yyyy\')');
		//$dob->setDescription('dd-mm-yyyy');
		$fields->push($dob);		
		
		
		$genders = Config::inst()->get('FamilyMember', 'Gender');
		$gender = new OptionsetField("Gender", 'Gender', $genders );
		$fields->push($gender);

		//$fields->push(TextField::create('MartialStatus','Status'));
		$status = Config::inst()->get('FamilyMember', 'MartialStatus');
		$martialStatus = new OptionsetField("MartialStatus", 'Martial Status', $status );
		$fields->push($martialStatus);
		
		//BloodGroup,Relation
		$bloodGroups = singleton('FamilyMember')->dbObject('BloodGroup')->enumValues();
		$fields->push(ListboxField::create('BloodGroup','Blood Group',$bloodGroups));

		$relations = singleton('FamilyMember')->dbObject('Relation')->enumValues();
		$fields->push(ListboxField::create('Relation','Relation',$relations));
		
		$fields->push(CheckboxField::create('HoldsPassport','Holds Passport'));
		$fields->push(CheckboxField::create('HoldsBankAccount','Holds Bank Account'));
		$fields->push(CheckboxField::create('HoldsDrivingLicence','Holds Driving Licence'));	
		
		//
		$fields->push(HiddenField::create('FamilyID','FamilyID'));
		$fields->push(HiddenField::create('ParishID','ParishID'));
		
		$fields->push(HiddenField::create('ID','ID'));

		$fields->push(HiddenField::create('RedirectURL','RedirectURL'));
		/*
		$controller = Controller::curr();
		$backURL = urldecode($controller->getRequest()->getVar('BackURL'));
		$redirectField = HiddenField::create('RedirectURL','RedirectURL');
		$redirectField->setValue($backURL);
		$fields->push($redirectField);
		*/
		
		
		//$fields->push( PhoneNumberField::create('Phone','HouseNo'));
		//$fields->push(HiddenField::create('ParishID','ParishID'));
	    return $fields;
    }

    public function getFormActions() {
    	$actions = parent::getFormActions();
    	$actions->first()->setTitle('Edit');
    	$actions->push(FormAction::create('doCancel', 'Cancel')->setUseButtonTag(true)->addExtraClass('secondary'));
    	return $actions;
    }
    
    public function getFormValidator() {
    	return RequiredFields::create(array('Name'));
    }   

    /**
     * @param $data array Data from request vars
     * @param $form ContactForm The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
		//Debug::show($data); exit();
		//$email = $data['Email'];
    	$id = (int)$data['ID'];
    	$familyMember = DataObject::get_by_id('FamilyMember',$id);
    	//$family = Family::create();
    	$form->saveInto($familyMember);
    	$familyMember->write();
    	
    	 
		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$redirectUrl
				);
    }	
}
