<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/9/2016
 * Time: 10:34 AM
 */
class Loan extends DataObject
{
    private static $db = array(
        'HasLoan' => 'Boolean',
        'Amount' => 'Int',
        //'FromWhere' => "Enum('bank, private-bank, person')",
        'FromBank' => 'Boolean',
        'FromPrivateBank' => 'Boolean',
        'FromPerson' => 'Boolean',		
        'Reason' => 'Varchar(100)'
    );

    private static $has_one = array(
        'Family' => 'Family'
    );

    private static $field_labels = array(
        'OnLoan' => 'Has Loan',
    );

    private static $summary_fields = array(
        'OnLoan',
        'Amount',
        'FromWhere'
    );

    public function OnLoan(){
        if($this->HasLoan)
            return 'Yes';
        else
            return 'No';
    }


    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Loan'),'HasLoan');


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