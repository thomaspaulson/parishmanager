<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/13/2016
 * Time: 5:42 PM
 */
class FamilyMemberSearchForm extends BaseForm
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

		$fields->push(TextField::create('Name', 'Name'));
		$fields->push(TextField::create('AgeForm', 'Age Form'));
		$fields->push(TextField::create('AgeUpto', 'Age Upto'));
		
		$genders = Config::inst()->get('FamilyMember', 'Gender');
		$genders['all'] = 'All';
		$gender = new OptionsetField("Gender", 'Gender', $genders, 'all' );
		$fields->push($gender);
		
		$status = Config::inst()->get('FamilyMember', 'MartialStatus');
		$martialStatus = new DropdownField("MartialStatus", 'Martial Status', $status );
		$martialStatus->setEmptyString('All');
		$fields->push($martialStatus);
		
		$bloodGroups = singleton('FamilyMember')->dbObject('BloodGroup')->enumValues();
		$bloodGroup = DropdownField::create('BloodGroup','Blood Group', $bloodGroups);
		$bloodGroup->setEmptyString('All');
		$fields->push($bloodGroup);
		
		$fields->push(OptionsetField::create('HoldsPassport', 'Holds Passport',array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
		$fields->push(OptionsetField::create('HoldsBankAccount', 'Holds Bank Account',array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
		$fields->push(OptionsetField::create('HoldsDrivingLicence', 'Holds Driving Licence',array('1'=>'Yes','0'=>'No','all'=>'All'),'all'));
		
		$days = $this->getDays();
		$months = $this->getMonths();
		$years = $this->getYears();
		$fields->push($day = DropdownField::create('Day', 'Day', $days));
		$day->setEmptyString('Day');
		$fields->push($month = DropdownField::create('Month', 'Month', $months));
		$month->setEmptyString('Month');
		$fields->push($year = DropdownField::create('Year', 'Year' , $years));
		$year->setEmptyString('Year');		
		
		$fields->push(TextField::create('MYearsForm', 'Years from'));
		$fields->push(TextField::create('MYearsUpto', 'Years upto'));

		$fields->push($mday = DropdownField::create('MDay', 'Day', $days));
		$mday->setEmptyString('Day');
		$fields->push($mmonth = DropdownField::create('MMonth', 'Month', $months));
		$mmonth->setEmptyString('Month');
		$fields->push($myear = DropdownField::create('MYear', 'Year' , $years));
		$myear->setEmptyString('Year');		
		
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

	public function getDays(){
		//$days = range(1, 31);
		//$default[0] = 'Day';
		//$new = $default + $days;
		foreach (range(1, 31) as $number) {
			$days[$number] = $number;
		}		
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
		//$years = range(date('Y'), 1905 ,-1);
		foreach (range(date('Y'), 1905 ,-1) as $number) {
			$years[$number] = $number;
		}		
		
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