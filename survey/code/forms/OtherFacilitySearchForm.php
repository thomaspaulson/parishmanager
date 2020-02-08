<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/13/2016
 * Time: 5:42 PM
 */
class OtherFacilitySearchForm extends BaseForm
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
		
        $fields->push(OptionsetField::create('WaterWell', 'Water Well',array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
		//$fields->push(CheckboxField::create('WaterWell', 'Water Well'));
		$fields->push(OptionsetField::create('DrillWell', 'DrillWell', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('DrillWell', 'Drill Well'));
		$fields->push(OptionsetField::create('WaterConnection', 'WaterConnection', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('WaterConnection', 'Water Connection'));
		$fields->push(OptionsetField::create('RainwaterStorage', 'RainwaterStorage', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('RainwaterStorage', 'Rainwater Storage'));
		$fields->push(OptionsetField::create('Biogas', 'Biogas', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('Biogas', 'Biogas'));
		$fields->push(OptionsetField::create('Electricity', 'Electricity', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('Electricity', 'Electricity'));
		$fields->push(OptionsetField::create('SolarEnergy', 'SolarEnergy', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('SolarEnergy', 'SolarEnergy'));
		$fields->push(OptionsetField::create('VegetableGarden', 'VegetableGarden', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
		//$fields->push(CheckboxField::create('VegetableGarden', 'Vegetable Garden'));

		     
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
