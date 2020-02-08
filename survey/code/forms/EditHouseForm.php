<?php
class EditHouseForm extends BaseForm{
	
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
		
        $status = singleton('House')->dbObject('Status')->enumValues();
        $fields->push(ListboxField::create('Status','House',$status));
        $fields->push(CheckboxField::create('HoldsRationCard','Holds RationCard'));
        
        $cardTypes = Config::inst()->get('House', 'CardType');
        $cardTypeField = new DropdownField("CardType", 'Card Type', $cardTypes );
        $cardTypeField->setEmptyString('select...');
        $fields->push($cardTypeField);

        $types = singleton('House')->dbObject('Type')->enumValues();
        $fields->push(ListboxField::create('Type','Type',$types));
        
		$fields->push(TextField::create('BuildYear','BuildYear'));		
		
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
    	$house = DataObject::get_by_id('House',$id);
    	//$family = Family::create();
    	$form->saveInto($house);
    	$house->write();
    	 
    	 
		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$redirectUrl
		);
		
    }	
}