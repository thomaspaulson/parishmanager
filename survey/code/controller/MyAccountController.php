<?php
class MyAccountController extends SiteController{
	#code	
	
	private static $allowed_actions = array(
		'index'	, 'edit', 'EditMyAccountForm','thanks'
	);
	
	public function init(){
		parent::init();
		$this->title = 'My Account';
	}
	
	public function index(){
		return $this->renderWith(array(
					'MyAccount','App'
				));
	}
	
	public function edit(){
		$this->title = 'Edit my account';
		return $this->renderWith(array(
					'MyAccount_edit','App'
				));
	}

	public function thanks(){
		$this->title = 'My Account ';
		return $this->renderWith(array(
					'MyAccount_edit','App'
				));
	}

	public function Title(){
		return $this->title;		
	}

    public function Link($slug = null) {
        if($slug){
            return Controller::join_links(Director::baseURL(), 'myaccount', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'myaccount');
        }
    }

	/**
	 *   @return Member Returns the member object 
     */
    public function Member()
    {
        $member = Member::currentUser();        
        return $member;
    }
	
	protected function IsSuccess(){
		$url = $this->request->allParams();
		return (isset($url['Action']) && ($url['Action'] == 'thanks'));
	}
	
	public function EditMyAccountForm(){
		
		$fields = new FieldList();
	  
		$fields->push(new TextField('FirstName','First Name'));
		$fields->push(new TextField('Surname','Second Name'));
		$fields->push(new TextField('Email','Email'));
	  
	    $member = $this->Member();
        $validator = $member ? $member->getValidator(false) : singleton('Member')->getValidator(false);
			
        $form = new Form($this, 'EditMyAccountForm', $fields,
            new FieldList(new FormAction("dosave", _t('MyProfily.UPADTEMYACCOUNT', 'Update changes'))),
            $validator
        );		
		
       if ($member && $member->hasMethod('canEdit') && $member->canEdit()) {
            $member->Password = '';
            $form->loadDataFrom($member);
            return $form;
        }
				
        return null;		
	}

	

    /**
     * Save member profile action
     *
     * @param array $data
     * @param $form
     */
    public function dosave($data, $form)
    {
        $member = Member::currentUser();
        
        $SQL_email = Convert::raw2sql($data['Email']);
        //$forumGroup = DataObject::get_one('Group', "\"Code\" = 'forum-members'");
        
        // An existing member may have the requested email that doesn't belong to the
        // person who is editing their profile - if so, throw an error
        $existingMember = DataObject::get_one('Member', "\"Email\" = '$SQL_email'");
        if ($existingMember) {
            if ($existingMember->ID != $member->ID) {
                $form->addErrorMessage('Email',
                    _t(
                        'MyAccount.EMAILEXISTS',
                        'Sorry, that email address already exists. Please choose another.'
                    ),
                    'bad'
                );
                Session::set("FormInfo.".$form->FormName().".data", $data);
                return $this->redirectBack();
            }
        }
		
		
        $form->saveInto($member);
        $member->write();        
        
        return $this->redirect('thanks');
    }	
}

