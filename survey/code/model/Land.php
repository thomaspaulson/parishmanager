<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/7/2016
 * Time: 9:41 AM
 */
class Land extends DataObject
{
    //
    private static $db = array(
        'HoldsLand' => 'Boolean',
        'Area' => "Enum('nil,1-3cent,4-6cent,7-15cent,16-50cent,50-100cent,agriculture')",
        'InCent' => 'Int'
    );

    private static $has_one = array(
        'Family' => 'Family'
    );

    private static $field_labels = array(
        'LandHolder' => 'Holds Land',
        'InCent' => 'Total Land(cents)'
    );

    private static $summary_fields = array(
        'LandHolder',
        'Area',
        'InCent'
    );

    public function LandHolder(){
        return ($this->HoldsLand)?'Yes':'No';
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        Requirements::javascript('survey/javascript/land.js');

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Land'),'HoldsLand');

        $options = array('1'=>'Yes','0'=>'No');
        $holdsLand = new OptionsetField("HoldsLand", 'Holds Land', $options );
        $fields->addFieldsToTab('Root.Main',$holdsLand);

        $fields->removeByName('InCent');
        //$fields->addFieldToTab( 'Root.Main', new LiteralField('wrap-open', '<div class="remove-cmshelp-icon">'));

        $landInAcre = null;
        $landInCent = null;
        if($this->ID){
            $landInAcre = floor($this->InCent/100);
            $landInCent = ($this->InCent%100);
        }
        $fields->addFieldToTab(
            'Root.Main',
            FieldGroup::create(
                TextField::create("LandInAcre","Land in acre")->setValue($landInAcre),
                TextField::create("LandInCent","Land in cent")->setValue($landInCent),
                TextField::create("InCent","Total land(in cent)")
            )
        );
        //$fields->addFieldToTab( 'Root.Main', new LiteralField('wrap-close', '</div>'));

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