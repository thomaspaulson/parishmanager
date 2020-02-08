<?php
class AddGroupsForm extends BaseForm{
	
    public function __construct(
        $controller,
        $name,
        FieldList $fields = null,
        FieldList $actions = null,
        $validator = null
    ) {
        parent::__construct($controller, $name, $fields, $actions, $validator);
        //$this->addExtraClass('js-places-search-form');	       
    }

    public function getFormFields() {

        $fields = parent::getFormFields();
		
        $fields->push(CheckboxField::create('CommunityGroups[]','Title')); 
        $fields->push(HiddenField::create('FamilyMemberID','FamilyMemberID'));
		$fields->push(HiddenField::create('RedirectURL','RedirectURL'));		


	    return $fields;
    }

    public function getFormActions() {
        $actions = parent::getFormActions();
        $actions->first()->setTitle('Create');
        $cancel = FormAction::create('doCancel', 'Cancel')->setUseButtonTag(true);
        $cancel->addExtraClass('secondary');
        $actions->push($cancel);
        return $actions;
    }

    public function getFormValidator() {
		return  null;
        //return RequiredFields::create(array('Status','Type'));
    }

    /**
     * @param $data array Data from request vars
     * @param $form ContactForm The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
		//Debug::show($data); exit();
		//$email = $data['Email'];
		
        $member_id = Convert::raw2sql($data['FamilyMemberID']);
        $query = "DELETE FROM CommunityGroup_FamilyMembers WHERE `FamilyMemberID` = '$member_id'";
    
        DB::query($query);    
        
    
        if (isset($data['CommunityGroups'])) {
            foreach ($data['CommunityGroups'] as  $group_id) {
                //print $data['Type[\''.$forum_id.'\']'];
				$dataObject = new CommunityGroup_FamilyMembers();
                $dataObject->CommunityGroupID =  Convert::raw2sql($group_id);
                $dataObject->FamilyMemberID =  $member_id;              
                
                $dataObject->write();
            }
        }
        		
        //$achievement = Achievement::create();
		//$form->saveInto($achievement);		
		//$achievement->write();

		$redirectUrl = urldecode($data['RedirectURL']);
		return $this->getController()->redirect(
				$redirectUrl
		);
		
    }
    	    
    /*
    public function forTemplate()
    {
        $groups = $this->ListGroups();
        $data = array('ListGroups' => $groups);
    
        return $this->customise($data)->renderWith(array($this->class, 'Form'));
    }    
    */ 
    
    public function ListGroups()
    {
        $groups = CommunityGroup::get()->sort('SortOrder DESC');
        return $groups;
    }    
    
    public function InGroup($group_id)
    {
		$controller = $this->getController();
		$member_id = (int)$controller->getRequest()->getVar('MemberID');
        $entry = CommunityGroup_FamilyMembers::get()
		->filter(array(
				'FamilyMemberID' => $member_id,
				'CommunityGroupID' => $group_id,
			))->First();
    
        if ($entry) {
            return true;
        } else {
            return false;
        }
    }
        
    
}
