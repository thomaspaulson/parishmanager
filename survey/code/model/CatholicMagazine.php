<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/9/2016
 * Time: 10:34 AM
 */
class CatholicMagazine extends DataObject
{
    private static $db = array(
        'Jeevadeepthi' => 'Boolean',
        'Jeevanaadam' => 'Boolean',
        'Christain' => 'Boolean',
        'PreshithaKeralam' => 'Boolean',
        'Shalom' => 'Boolean',
        'Cherupushpam' => 'Boolean',
        'Others' => 'Boolean',
        'Specify' => 'Varchar(100)'

    );

    private static $has_one = array(
        'Family' => 'Family'
    );


    private static $field_labels = array(
        'HasJeevadeepthi' => 'Has Jeevadeepthi',
        'HasJeevanaadam' => 'Has Jeevanaadam',
        'HasChristain' => 'Has Christain',
    );

    private static $summary_fields = array(
        'HasJeevadeepthi',
        'HasJeevanaadam',
        'HasChristain'
    );


    public function HasJeevadeepthi(){
        if($this->Jeevadeepthi)
            return 'Yes';
        else
            return 'No';
    }

    public function HasJeevanaadam(){
        if($this->Jeevanaadam)
            return 'Yes';
        else
            return 'No';
    }

    public function HasChristain(){
        if($this->Christain)
            return 'Yes';
        else
            return 'No';
    }
	
    public function HasOrNot($Title = null){		
        if($this->$Title && $Title)
            return 'Yes';
        else
            return 'No';
    }


	public function Magazines(){
		$magazinesArray = array('Jeevadeepthi','Jeevanaadam','Christain',
								'PreshithaKeralam', 'Shalom','Cherupushpam','Others',							
							);
		$magazines = null;
		foreach($magazinesArray as $magazine){
			if($this->$magazine){
				if($this->$magazine && $magazine =='Others')
					$magazines .= $magazine.'('.$this->Specify.'), ';
				else
					$magazines .= $magazine.', ';
			}			
		}		
		return rtrim($magazines, ', ');		
	}

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        if(Session::get("FamilyID")){
            $this->FamilyID = Session::get("FamilyID");
            $fields->replaceField('FamilyID', new HiddenField('FamilyID'));
        }

        $fields->addFieldToTab('Root.Main',new HeaderField('CustomHeader','Catholic Magazine'),'Jeevadeepthi');

        $fields->replaceField('Specify', new TextField('Specify','If others checked,please mention'));

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