<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 2:08 PM
 */
class GroupsController extends SiteController
{

	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_groups',
    		'AddGroupsForm',
    		'edit_groups',
    		'EditGroupsForm',
			'export_to_csv' 
    );

	/**
	 * The current Family DataList .
	 *
	 * @var DataList
	 */	
	protected $list;
	protected $count;
    public function init(){
        parent::init();
		$this->title = 'Groups';
    }

    public function index() {	
        return $this->renderWith(array('Group', 'App'));
    }
    public function add_groups(){
		    
    	$id = (int)$this->getRequest()->getVar('MemberID');
    	$member = FamilyMember::get()->byID($id);
    	if(!$member){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Community-Groups";
    	$form = $this->AddGroupsForm();
    
    	$familyMemberID = $form->Fields()->fieldByName('FamilyMemberID');
    	$familyMemberID->setValue($member->ID);
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    	$data = array(
    			'Form' => $form
    	);
    
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    }
    
    
    public function AddGroupsForm(){
    	$form = new AddGroupsForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_groups(){
    
    	$id = (int)$this->getRequest()->getVar('MemberID');
    	$member = FamilyMember::get()->byID($id);
    	if(!$member){
    		return $this->httpError(404,'Page not found');
    	}    
    
    	$this->title = "Edit Community-Groups";
    	
    	$form = $this->AddGroupsForm();    	
    
    	$familyMemberID = $form->Fields()->fieldByName('FamilyMemberID');
    	$familyMemberID->setValue($member->ID);
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditJobForm(){
    	$form = new EditJobForm($this, __FUNCTION__);
    	return $form;
    }
    

    public function search() {
		$this->title = 'Search groups';
		$this->list = $this->Results();	
		return $this->renderWith(array('Group_results', 'App'));
    }

	public function printlist() {	
		$this->title = 'Groups list';
        return $this->renderWith(array('Group_printresults', 'Print'));
    }
	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "groups.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Gender',
						'DOB','Age',
						'Groups','Family',
						'Unit', 'Block', 'Contact'
						); 
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {			
			$groupsTitle = null;
			foreach($list->CommunityGroups() as $group ){
				$groupsTitle = $group->Title.', ';
			}
			$groupsTitle = rtrim($groupsTitle, ', ');
			
			$raw = array(  $list->Name, $this->Sex($list->Gender),
						   $this->FormatDate($list->DateOfBirth,'d-m-Y'), $this->Age($list->DateOfBirth, $list->Age),
						   $groupsTitle, $list->FamilyName,
						   $list->UnitNo, $list->BlockNo,  $list->ContactNo
					);
			fputcsv($fp, $raw);
			//echo $list->Name.'<br>';
		}		
		fclose($fp);
	}	
	
	
    public function Title() {
        return $this->title;
    }
    public function Link($slug = null) {
        if($slug){
            return Controller::join_links(Director::baseURL(), 'groups', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'groups');
        }
    }

    public function Results(){
        $list = FamilyMember::get();		//$list = FamilyMember::get()->leftJoin('CommunityGroup','"CommunityGroup"."FamilyMemberID" = "FamilyMember"."ID"');
		
		$group= Convert::raw2sql($this->request->getVar('Group'));
        if($group){
            $list = $list->filter(array(
                'CommunityGroups.ID' => $group
            ));
        }

		
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
		
		
//		$parishID = Convert::raw2sql($this->request->getVar('ParishID'));
//        if($parishID){
//            $list = $list->filter(array(
//                'ParishID' => $parishID
//            ));
//        }

        //$list = $list->leftJoin('Contact', "\"Contact\".\"FamilyID\" = \"Family\".\"ID\"");
        //Debug::show($list->sql());		$this->count = $list->count();
		
        return $list;
    }		

	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
	
    public function GroupsSearchForm(){
        $form = new GroupsSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search groups');
        $form->loadDataFrom($this->request->getVars());
        $form->disableSecurityToken();
        return $form;
    }

	
}
