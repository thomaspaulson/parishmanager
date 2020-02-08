<?php
class EditEducationForm extends BaseForm{
	
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
		
        $codes = Config::inst()->get('Education', 'Course');		
        $fields->push(DropdownField::create('Code','Qualification',$codes ));
        $status = array('p'=>'Passed','f'=>'Failed','s'=>'Studying');        
        $fields->push(DropdownField::create("Status", 'Status', $status )); 
        
        $fields->push(TextField::create('Subject','Subject'));          
                
		$fields->push(HiddenField::create('FamilyMemberID','FamilyMemberID'));
		$fields->push(HiddenField::create('RedirectURL','RedirectURL'));
		
		$fields->push(HiddenField::create('ID','ID'));		
		
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
        return RequiredFields::create(array('Code'));
    }

    /**
     * @param $data array Data from request vars
     * @param $form The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
    	$id = (int)$data['ID'];
    	$education = DataObject::get_by_id('Education',$id);    	
    	$form->saveInto($education);
    	$education->write();
    	 
    	 
		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$redirectUrl
		);
		
    }	
}
