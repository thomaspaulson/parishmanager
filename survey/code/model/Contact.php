<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/9/2016
 * Time: 10:34 AM
 */
class Contact extends DataObject
{
    private static $db = array(
        'Name' => 'Varchar(100)',
        'Email' => 'Varchar(100)',
        'Mobile' => 'Varchar(100)'
    );

    private static $has_one = array(
        'Family' => 'Family'
    );

    private static $summary_fields = array(
        'Name',
        'Email',
        'Mobile'
    );


    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Contact details'),'Name');

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