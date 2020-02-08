<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/13/2016
 * Time: 5:42 PM
 */
class FamilyMemberSearchByDateForm extends BaseForm
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

        //$fields->push(CheckboxField::create('HoldsLand', 'Yes'));
		$days = $this->getDays();
		$months = $this->getMonths();
		$years = $this->getYears();
		$fields->push($day = DropdownField::create('Day', 'Day', $days));
		$day->setEmptyString('Day');
		$fields->push($month = DropdownField::create('Month', 'Month', $months));
		$month->setEmptyString('Month');
		$fields->push($year = DropdownField::create('Year', 'Year' , $years));
		$year->setEmptyString('Year');
		
        return $fields;
    }
	
	public function getDays(){
		$days = range(1, 31);
		//$default[0] = 'Day';
		//$new = $default + $days;
		return $days;
	}
	
	public function getMonths(){
		$months = array(					
					'1' => 'Jan',
					'2' => 'Feb',
					'3' => 'Mar',
					'4' => 'Apr',
					'5' => 'May',
					'6' => 'Jun',
					'7' => 'July',
					'8' => 'Aug',
					'9' => 'Sept',
					'10' => 'Oct',
					'11' => 'Nov',
					'12' => 'Dec',					
				);
		return $months;
	}
	
	public function getYears(){
		$years = range(date('Y'), 1905 ,-1);		
		return $years;
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