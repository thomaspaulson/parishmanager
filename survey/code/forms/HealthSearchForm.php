<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/13/2016
 * Time: 5:42 PM
 */
class HealthSearchForm extends BaseForm
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
				
        //$fields->push(OptionsetField::create('Blind', '	Blind',array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
		$fields->push(CheckboxField::create('Blind', 'Blind'));
		//$fields->push(OptionsetField::create('Deaf', 'Deaf',array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        $fields->push(CheckboxField::create('Deaf', 'Deaf'));
		//$fields->push(OptionsetField::create('Dumb', 'Dumb',array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        $fields->push(CheckboxField::create('Dumb', 'Dumb'));
		//$fields->push(OptionsetField::create('OtherPhsicalDisability', 'Other Phsical-Disability',array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        $fields->push(CheckboxField::create('OtherPhsicalDisability', 'Other Phsical Disability'));
		//$fields->push(OptionsetField::create('LearningDisability', 'Learning Disability',array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('Shalom', 'Shalom'));
		//$fields->push(OptionsetField::create('MentalDisability', 'Mental Disability',array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));        
		$fields->push(CheckboxField::create('MentalDisability', 'MentalDisability'));
		$fields->push(CheckboxField::create('Diabetes', 'Diabetes'));
		$fields->push(CheckboxField::create('HearthDisease', 'Heart Disease'));
		$fields->push(CheckboxField::create('Cancer', 'Cancer'));
		$fields->push(CheckboxField::create('BloodPressure', 'Blood Pressure'));
		$fields->push(CheckboxField::create('Alcoholic', 'Alcoholic'));
		$fields->push(CheckboxField::create('OtherDisease', 'Other disease'));
		
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