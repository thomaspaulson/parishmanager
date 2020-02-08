<?php
class EditFamilyForm extends BaseForm{
	
    public function __construct(
        $controller,
        $name,
        FieldList $fields = null,
        FieldList $actions = null,
        $validator = null
    ) {
        //print __CLASS__.'<br>';
        parent::__construct($controller, $name, $fields, $actions, $validator);
        $this->addExtraClass('js-places-search-form');
        //echo __CLASS__;
    }

    public function getFormFields() {

        $fields = parent::getFormFields();
		
		$fields->push(TextField::create('Name','Name'));
		$fields->push(TextField::create('Address','Place/Location'));
		$fields->push(TextField::create('Pincode','Pincode'));
		$fields->push(TextField::create('HouseNo','House No(govt)'));
		$fields->push(NumericField::create('BlockNo','Block No'));
		$fields->push(NumericField::create('UnitNo','Unit No'));
		$fields->push(TextField::create('UnitName','Unit Name'));
		$fields->push(NumericField::create('FamilyNo','Family No'));
		
		$fields->push(CheckboxField::create('IsPanchayat','Is Panchayat'));
		$fields->push(CheckboxField::create('IsMunicipality','Is Municipality'));
		$fields->push(CheckboxField::create('IsCorporation','Is Corporation'));
		$fields->push(HiddenField::create('ID','ID'));
		
		$fields->push(TextField::create('ContactNo','Phone No'));
		$fields->push(TextField::create('Email','Email'));		
		$fields->push(TextField::create('Aadhaar','Aadhaar'));	
		
		$member = Member::currentUser();		
		$parishes = $member->Parishes(); 
		
		if($parishes->exists()){
			$parishArray = $parishes->map('ID', 'NameWithLocation')->toArray();
		}
		else{
			$parishArray = Parish::get()->map('ID', 'NameWithLocation')->toArray();
		}
		
		/*
		$parishField = DropdownField::create('ParishID', 'Parish')
			->setSource($parishArray);
		$parishField->setEmptyString('select...');
		$parishField->setValue(parent::getDefaultParishID());
		$fields->push($parishField);
		*/
		
		$fields->push(HiddenField::create('ParishID','ParishID'));
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
        return RequiredFields::create(array('Name','Address','ParishID'));
    }

    /**
     * @param $data array Data from request vars
     * @param $form ContactForm The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
		//Debug::show($data); exit();
		$id = (int)$data['ID'];
		$family = DataObject::get_by_id('Family',$id);
        //$family = Family::create();
		$form->saveInto($family);		
		$family->write();
		
		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$this->getController()->Link('view/'.$family->ID.'?BackURL='.$redirectUrl)
				);
		/*
		return $this->getController()->redirect(
            $this->getController()->Link('view/'.$family->ID)
        );
        */        
    }	
}
