<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/7/2016
 * Time: 3:23 PM
 */
class Business extends DataObject
{
    private static $db = array(
        //'Type' => "Enum('streetvendor,unduvandi,pettikada,shop,trade,industry,selfemployed,others')",
		'Streetvendor' => 'Boolean',        
		'Unduvandi' => 'Boolean',        
		'Pettikada' => 'Boolean',        
		'Shop' => 'Boolean',        
		'Trade' => 'Boolean',        								
		'Industry' => 'Boolean',        										
		'Selfemployed' => 'Boolean',        								
		'Others' => 'Boolean',  		      																
        'Specify' => 'Varchar(100)'

    );

    private static $has_one = array(
        'Family' => 'Family'
    );


    private static $summary_fields = array(
        'Type',
        'Other',
    );


    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Business'),'Type');

        $fields->replaceField('Other', new TextField('Other','If type is others,please mention'));

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
