<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/7/2016
 * Time: 4:07 PM
 */
class MonthlyExpense extends DataObject
{
    private static $db = array(
        'Food' => 'Int',
        'Education' => 'Int',
        'Medical' => 'Int',
        'Mobile' => 'Int',
        'Others' => 'Int',
        'Total' => 'Int'
    );

    private static $has_one = array(
        'Family' => 'Family'
    );

    private static $summary_fields = array(
        'Food',
        'Education',
        'Medical',
        'Total'
    );

    /*
    function Total(){
        return ($this->Food + $this->Education + $this->Medical + $this->Mobile + $this->Others);
    }
    */


    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Monthly Expense'),'Food');

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