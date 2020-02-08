<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/7/2016
 * Time: 3:23 PM
 */
class Agriculture extends DataObject
{
    private static $db = array(
        //'Type' => "Enum('paddy,betelnut,cocunut,rubber,spice,fruit,flower,fish,others')",
		'Cocunut' => 'Boolean',        
		'Produce' => 'Boolean',        
		'Paddy' => 'Boolean',        
		'Fruit' => 'Boolean',        
		'Fish' => 'Boolean',        								
		'Cow' => 'Boolean',        										
		'Goat' => 'Boolean',        								
		'Chicken' => 'Boolean',        												
		'Duck' => 'Boolean',        												
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

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Agriculture'),'Type');
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
