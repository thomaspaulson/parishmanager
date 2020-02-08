<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/9/2016
 * Time: 5:53 PM
 */
class Job extends DataObject
{
    private static $db = array(
        'Title' => 'Varchar(100)',
        'CompanyName' => 'Varchar(100)',
        'Type' => "Enum('govt, semi-govt, private, self, construction, fishing, carpentery, coir, business, homemaker, others, unemployed')",
        'Location' => 'Varchar(3)',// fr=abroad,out = outside keral,in = with kerala
        'Pension' => 'Boolean',
        'SavingScheme' => 'Boolean',
        'ESI' => 'Boolean',
        'PF' => 'Boolean',
        'Salary' => 'Varchar(2)'//vl=<4000, lo=4000-8000,av=8000-15000,me=15000-25000,am=25000-50000,up=>5000
    );

    private static $has_one = array(
        'FamilyMember' => 'FamilyMember'
    );

    private static $field_labels = array(
        'JobType' => 'Type',
    );

    private static $summary_fields = array(
        'Title',
        'CompanyName',
        'JobType'
    );

    public function JobType(){
        $typeCodes = Config::inst()->get('Job', 'TypeCode');
        return $typeCodes[$this->Type];
    }

    public function JobLocation(){
        $locationCodes = Config::inst()->get('Job', 'LocationCode');
        return $locationCodes[$this->Location];
    }

    public function MonthlySalary(){
        $salaryCodes = Config::inst()->get('Job', 'SalaryCode');
        return $salaryCodes[$this->Salary];
    }
	
	
    public function HasOrNot($Title = null){		
        if($this->$Title && $Title)
            return 'Yes';
        else
            return 'No';
    }
	
    public function getCMSFields(){
        $fields = parent::getCMSFields();

        if(Session::get("FamilyMemberID")){
            $this->FamilyMemberID = Session::get("FamilyMemberID");
            $fields->replaceField('FamilyMemberID', new HiddenField('FamilyMemberID'));
        }

        $typeCodes = Config::inst()->get('Job', 'TypeCode');
        $typeField = new DropdownField("Type", 'Type', $typeCodes );
        $fields->addFieldsToTab('Root.Main', $typeField);


        $locationCodes = Config::inst()->get('Job', 'LocationCode');
        $locationField = new DropdownField("Location", 'Location', $locationCodes );
        $fields->addFieldsToTab('Root.Main', $locationField);

        $salaryCodes = Config::inst()->get('Job', 'SalaryCode');
        $salaryField = new DropdownField("Salary", 'Salary', $salaryCodes );
        $fields->addFieldsToTab('Root.Main',$salaryField);

        return $fields;
    }

    function canView($member = null) {
        return true;
    }

    function canEdit($member = null) {
        return true;
    }

    function canDelete($member = null) {
        return true;
    }

    function canCreate($member = null) {
        return true;
    }

}
