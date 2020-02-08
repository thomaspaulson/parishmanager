<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/13/2016
 * Time: 5:42 PM
 */
class VehicleSearchForm extends BaseForm
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

        //$fields->push(CheckboxField::create('Cycle', 'Cycle'));
		$fields->push(OptionsetField::create('Cycle', 'Cycle', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('Bike', 'Bike'));
		$fields->push(OptionsetField::create('Bike', 'Bike', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('Autoriskaw', 'Autoriskaw'));
		$fields->push(OptionsetField::create('Autoriskaw', 'Autoriskaw', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('LightVehicle', 'LightVehicle'));
		$fields->push(OptionsetField::create('LightVehicle', 'LightVehicle', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('HeavyCommercial', 'Heavy Commercial'));
		$fields->push(OptionsetField::create('HeavyCommercial', 'HeavyCommercial', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('CountryBoat', 'CountryBoat'));
		$fields->push(OptionsetField::create('CountryBoat', 'CountryBoat', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('Vallam', 'Vallam'));
		$fields->push(OptionsetField::create('Vallam', 'Vallam', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('FishingBoat', 'Fishing Boat'));
		$fields->push(OptionsetField::create('FishingBoat', 'FishingBoat', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
        //$fields->push(CheckboxField::create('TouristBoat', 'Tourist Boat'));
		$fields->push(OptionsetField::create('TouristBoat', 'TouristBoat', array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));

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
