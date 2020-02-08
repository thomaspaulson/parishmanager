<?php
class AddMediaForm extends BaseForm{
	
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
		$fields->push(CheckboxField::create('Newspaper','Newspaper'));
		$fields->push(CheckboxField::create('Television','Television'));
		$fields->push(CheckboxField::create('Magazine','Magazine'));
		$fields->push(CheckboxField::create('KidsMagazine','KidsMagazine'));
		$fields->push(CheckboxField::create('Internet','Internet'));
		$fields->push(CheckboxField::create('CatholicMagazine','CatholicMagazine'));					
		$fields->push(CheckboxField::create('Computer','Computer'));							              
		$fields->push(CheckboxField::create('Others','Others'));			
		$fields->push(TextField::create('Specify','Other(specify)'));                 

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
        return RequiredFields::create(array());
    }

    /**
     * @param $data array Data from request vars
     * @param $form ContactForm The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
        $media = Media::create();
		$form->saveInto($media);		
		$media->write();

		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$redirectUrl
		);
		
    }	
}
