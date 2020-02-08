<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/7/2016
 * Time: 2:41 PM
 */
class ShiftedFrom extends DataObject
{
    private static $db = array(
        'Status' => 'Boolean',
        'FromWhere' => 'Varchar(100)',
        'Reason' => 'Varchar(255)'
    );

    private static $has_one = array(
        'Family' => 'Family'
    );



    private static $summary_fields = array(
        'Shifted',
        'FromWhere',
        'Reason'
    );

    public function Shifted(){
        return ($this->Status)?'Yes':'No';
    }


    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Shifted From'),'Status');

        $options = array('1'=>'Yes','0'=>'No');
        $statusField = new OptionsetField("Status", 'Shifted from Urban/Rural area', $options );
        $fields->addFieldsToTab('Root.Main', $statusField);

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
