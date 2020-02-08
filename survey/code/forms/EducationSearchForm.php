<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/13/2016
 * Time: 5:42 PM
 */
class EducationSearchForm extends BaseForm
{

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

		$fields->push(TextField::create('AgeForm', 'Age Form'));
		$fields->push(TextField::create('AgeUpto', 'Age Upto'));

		$genders = Config::inst()->get('FamilyMember', 'Gender');
		$genders['all'] = 'All';
		$gender = new OptionsetField("Gender", 'Gender', $genders, 'all' );
		$fields->push($gender);

        //$fields->push(CheckboxField::create('HoldsLand', 'Yes'));
        $codes = Config::inst()->get('Education', 'Course');
        $codeField = new DropdownField("Code", 'Course', $codes );
		$codeField->setEmptyString('All');
		$fields->push($codeField);

        $status = array('p'=>'Passed','f'=>'Failed','s'=>'Studying');
        $statusField = new DropdownField("Status", 'Status', $status );
		$statusField->setEmptyString('All');
		$fields->push($statusField);
		
		/*
        $parishes = Parish::get()->map('ID', 'NameWithLocation')->toArray();
        $parishField = DropdownField::create('ParishID', 'Parish')
            ->setSource($parishes);
        $parishField->setEmptyString('All Parish');
        $parishField->setValue(parent::getDefaultParishID());
        $fields->push($parishField);
        */

        return $fields;
    }

    public function getFormActions() {
        $actions = parent::getFormActions();
        $actions->first()->setTitle('Search');
        return $actions;
    }

    public function getFormValidator() {
        return RequiredFields::create();
    }

    /**
     * @param $data array Data from request vars
     * @param $form ContactForm The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
        /*
        $email = new Email(
            $this->config()->email_from,
            $this->config()->email_to,
            $this->config()->email_subject
        );
        $email->setTemplate('ContactEmail');
        $email->populateTemplate($this->getData());
        $email->send();
        $this->getController()->redirect(
            $this->getController()->Link('success')
        );
        */
    }
}
