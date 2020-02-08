<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/7/2016
 * Time: 2:19 PM
 */
class House extends DataObject
{
    private static $db = array(
        'Status' => "Enum('own, rent, joint, loan')",
        'Amount' => 'Int',
        'HoldsRationCard' => 'Boolean',
        'CardType' => 'VarChar(4)',
        'Type' => "Enum('hut,ollapera,sheet,odupura,concrete,2level,multilevel,flat')",
        'BuildYear' => 'Int'
    );

    private static $has_one = array(
        'Family' => 'Family'
    );

    private static $field_labels = array(
        'RationCardHolder' => 'Holds Ration Card',
        'Type' => 'House Type'
    );

    private static $summary_fields = array(
        'Status',
        'RationCardHolder',
        'Type',
        'BuildYear'
    );

    public function RationCardHolder(){
        return ($this->HoldsRationCard)?'Yes':'No';
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','House'),'Status');

        $cardTypes = Config::inst()->get('House', 'CardType');
        $cardTypeField = new DropdownField("CardType", 'Card Type', $cardTypes );
        $cardTypeField->setEmptyString('select...');
        $fields->addFieldsToTab('Root.Main',$cardTypeField);

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