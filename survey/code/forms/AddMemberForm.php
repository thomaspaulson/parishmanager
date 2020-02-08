<?php
class AddMemberForm extends BaseForm{
	
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
		
		$fields->push(TextField::create('FirstName','First Name'));
		$fields->push(TextField::create('Surname','Second Name'));
		$fields->push(TextField::create('Email','Email'));
		$fields->push(TextField::create('Password','Password'));
		$fields->push(HiddenField::create('ParishID','ParishID'));
	    return $fields;
    }

    public function getFormActions() {
        $actions = parent::getFormActions();
        $actions->first()->setTitle('Create');
        return $actions;
    }

    public function getFormValidator() {
        return RequiredFields::create(array('FirstName','Email','Password'));
    }

    /**
     * @param $data array Data from request vars
     * @param $form ContactForm The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
		//Debug::show($data); exit();
		//$email = $data['Email'];
		$email =Convert::raw2sql($data['Email']);
		$members = Member::get()->filter(array('Email'=>$email));
		if($members->count()>0){
			$form->addErrorMessage('Email','Email already exists','Error');
			Session::set("FormInfo.".$form->FormName().".data", $data);
			$this->getController()->redirectBack();
		}
        $member = Member::create();
		$form->saveInto($member);		
		$member->write();
		$member->addToGroupByCode('assistants');	
		
		$parishID = (int)$data['ParishID'];
		$parish = Parish::get()->byID($parishID);		
		if($parish->exists()){
			$member->Parishes()->add($parish);
		}
        $this->getController()->redirect(
            $this->getController()->Link('list-member?message=added')
        );
        
    }	
}