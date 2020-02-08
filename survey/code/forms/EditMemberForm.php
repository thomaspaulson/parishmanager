<?php
class EditMemberForm extends BaseForm{
	
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
		$fields->push(HiddenField::create('ID','ID'));
	    return $fields;
    }

    public function getFormActions() {
        $actions = parent::getFormActions();
        $actions->first()->setTitle('Update');
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
		$email =Convert::raw2sql($data['Email']);		
		$member = DataObject::get_one('Member', "\"Email\" = '$email'");
		
		$controller = $this->getController();		
		$postedMemberID = (int)$controller->request->postVar('ID');//echo '$postedMemberID:'.$postedMemberID;
		$memberID = $member->ID;//echo '$memberID:'.$memberID;exit();
		if($postedMemberID != $memberID ){
                $form->addErrorMessage('Email',
                    _t(
                        'MyAccount.EMAILEXISTS',
                        'Sorry, that email address already exists. Please choose another.'
                    ),
                    'bad'
                );
                Session::set("FormInfo.".$form->FormName().".data", $data);
                return $controller->redirectBack();			
		}		
        
		$form->saveInto($member);		
		$member->write();
		
		$this->getController()->redirect(
            $this->getController()->Link('list-member/?message=updated')
        );
        
    }	
}