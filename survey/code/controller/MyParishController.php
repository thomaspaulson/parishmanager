<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 2:08 PM
 */
class MyParishController extends SiteController
{

    public static $url_handlers = array(
    );


    public static $allowed_actions = array(
        'index', 'edit','EditParishForm', 'success',
		'add_member','AddMemberForm','list_member','edit_member','EditMemberForm','delete_member'
    );

    public function init(){
        parent::init();
		$this->title = "My Parish";
    }

    public function index() {
        return $this->renderWith(array('MyParish', 'App'));
    }

	public function edit(){
		return $this->renderWith(array('MyParish_edit', 'App'));
	}
	
	public function EditParishForm(){
		
		$member = Member::currentUser();
		
		$form = new EditParishForm($this, __FUNCTION__);
		
		$myParish = $this->MyParish();
		$parishID = null;
		if ($myParish){
			$parishID = $myParish->ID;
		}
		
		if($member->canEditParish($myParish)){
			$form->loadDataFrom($myParish);	
			return $form;	
		}			
		
		return null;
	}
	
    /**
	 * print sucsess message
     */
    public function success()
    {
		return $this->renderWith(array('MyParish', 'App'));
    }	
	
	public function add_member(){
		$this->title = "Add member";
		$data = array(
				'Form' => $this->AddMemberForm()
				);
		return $this->customise($data)->renderWith(array('MyParish_member', 'App'));	
	}
	
	public function AddMemberForm(){
		$member = Member::currentUser();
		
		$form = new AddMemberForm($this, __FUNCTION__);
		
		$myParish = $this->MyParish();
		$parishID = null;
		if ($myParish){
			$parishID = $myParish->ID;
		}
		
		if($member->canEditParish($myParish)){
			$form->Fields()->fieldByName('ParishID')->setValue($parishID);			
			return $form;	
		}			
		
		return null;
	}

	public function edit_member(){
		$this->title = "Edit member";
		$form = $this->EditMemberForm();
		$id = (int)$this->request->param('ID');
		//var_dump($_POST);EXIT();
		$selectedMember = Member::get()->byID($id);
		if(!$selectedMember){
			 return $this->httpError(404,'Page not found');
		}
		if($form && !$form->Fields()->fieldByName('ID')->Value()){
			if($selectedMember->exists()){
				$selectedMember->Password='';
				$form->loadDataFrom($selectedMember);			
			}
		}
		//check whether user belongs to myparish
		$myParish = $this->MyParish();	
		$inParish = $selectedMember->Parishes()->filter(array('ID' => $myParish->ID))->First();
		if(!$inParish){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}
		
		$data = array(
				'Form' => $form
				);
		return $this->customise($data)->renderWith(array('MyParish_member', 'App'));	
	}

	public function EditMemberForm(){
		$member = Member::currentUser();
		
		$form = new EditMemberForm($this, __FUNCTION__);
		
		$myParish = $this->MyParish();
	
		if($member->canEditParish($myParish)){
			return $form;	
		}			
		
		return null;
	}
	
	public function delete_member(){
		
		$member = Member::currentUser();
	
		$myParish = $this->MyParish();
	
		if(!$member->canEditParish($myParish)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}					
		
	
		$this->title = "Delete member";	
		$id = (int)$this->request->param('ID');
		//var_dump($_POST);EXIT();
		$selectedMember = Member::get()->byID($id);

		if(!$selectedMember){
			 return $this->httpError(404,'Page not found');
		}
		
		//
		$inParish = $selectedMember->Parishes()->filter(array('ID' => $myParish->ID))->First();
		if(!$inParish){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}

		if($selectedMember->exists()){
			$selectedMember->destroy();
			$selectedMember->delete();
			return $this->redirect($this->Link('list-member/?message=deleted'));
		}		
	}

	public function list_member(){
		$this->title = "List members";
		return $this->renderWith(array('MyParish_listmember', 'App'));	
	}
	
	public function Results(){
		$myParish = $this->MyParish();
		if($myParish){
			return $myParish->Members()->sort('ID DESC');
		}
		else{
			return null;	
		}

	}
	
	public function RecentMembers($limit = 5){
		$myParish = $this->MyParish();
		if($myParish){
			return $myParish->Members()->sort('ID DESC')->limit($limit);
		}
		else{
			return null;	
		}
	}	
	
	public function Updated(){
		if($this->request->getVar('updated')){
			return 'Parish updated';
		}
		return null;
	}
	
    public function Title() {
        return $this->title;
    }
	
    public function Link($slug = null ) {
        if($slug){
            return Controller::join_links(Director::baseURL(), 'myparish', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'myparish');
        }

    }


}