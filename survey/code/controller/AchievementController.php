<?php
//
class AchievementController extends SiteController{
	#code
	
	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_achievement',
    		'AddAchievementForm',
    		'edit_achievement',
    		'EditAchievementForm',
    		'delete_achievement'
    );
	
	/**
	 * Family datalist
	 * @var DataList
	 *
	 */
	protected $list;
	
	public function init(){
		parent::init();
		$this->title = 'Loan';
	}

	/**
	 * render agriculture index page
	 * @return string
	 */	
	public function index(){
		$this->title = 'Saving';		
		return $this->renderWith(array('Loan','App'));
	}

    public function add_achievement(){
		    
    	$id = (int)$this->getRequest()->getVar('MemberID');
    	$member = FamilyMember::get()->byID($id);
    	if(!$member){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Achievement";
    	$form = $this->AddAchievementForm();
    
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
    
    
    public function AddAchievementForm(){
    	$form = new AddAchievementForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_achievement(){
    
    	$this->title = "Edit Achievement";
    	$form = $this->EditAchievementForm();
    	$form->setTemplate('AddAchievementForm');
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$achievement = Achievement::get()->byID($id);
    	if(!$achievement){
    		return $this->httpError(404,'Page not found');
    	}
    	if($achievement->exists() && $form){
    		$form->loadDataFrom($achievement);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditAchievementForm(){
    	$form = new EditAchievementForm($this, __FUNCTION__);
    	return $form;
    }
    
	public function delete_achievement(){

		$this->title = "Delete Achievement";
		$id = (int)$this->request->param('ID');
		//var_dump($_POST);EXIT();
		$achievement = Achievement::get()->byID($id);

		if(!$achievement){
			return $this->httpError(404,'Page not found');
		}

		if($achievement->exists()){
			$achievement->destroy();
			$achievement->delete();
			$backURL = urldecode($this->getRequest()->getVar('BackURL'));
			return $this->redirect($backURL.'&message=deleted');
			//return $this->redirect($this->Link($backURL.'&message=deleted'));
		}

	}	

	public function search(){
		// show Unathorised page with user does not have access other parish
		$parishID = Convert::raw2sql($this->request->getVar('ParishID'));		
		if(!$this->canAccess($parishID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}
		
		
		$this->title = 'Search Saving';
		$this->list = $this->Results();
		return $this->renderWith(array('Saving_results','App'));
	}

	public function printlist(){
		// show Unathorised page with user does not have access other parish
		$parishID = Convert::raw2sql($this->request->getVar('ParishID'));		
		if(!$this->canAccess($parishID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}
		
		$this->title = 'Saving list';		
		return $this->renderWith(array('Saving_printresults','Print'));
	}
	
    public function Title() {
        return $this->title;
    }

    public function Link($slug = null) {
        if($slug){
            return Controller::join_links(Director::baseURL(), 'achievement', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'achievement');
        }
    }

    public function Results(){

        $list = Family::get()->leftJoin('Saving','"Family"."ID" = "Saving"."FamilyID"');
		
        $parishID = Convert::raw2sql($this->request->getVar('ParishID'));
        if($parishID){
            $list = $list->filter(array(
                'ParishID' => $parishID
            ));
        }

		$educationFund = Convert::raw2sql($this->request->getVar('EducationFund'));		
        if($educationFund!='all'){
            $list = $list->filter(array(
                'Saving.EducationFund' => $educationFund
            ));
        }
		
		$lifeInsurance = Convert::raw2sql($this->request->getVar('LifeInsurance'));		
        if($lifeInsurance!='all'){
            $list = $list->filter(array(
                'Saving.LifeInsurance' => $lifeInsurance
            ));
        }

		$healthInsurance = Convert::raw2sql($this->request->getVar('HealthInsurance'));		
        if($healthInsurance!='all'){
            $list = $list->filter(array(
                'Loan.HealthInsurance' => $healthInsurance
            ));
        }
		
		$deathFund = Convert::raw2sql($this->request->getVar('DeathFund'));		
        if($deathFund!='all'){
            $list = $list->filter(array(
                'Saving.DeathFund' => $deathFund
            ));
        }
		
		$marriageFund = Convert::raw2sql($this->request->getVar('MarriageFund'));		
        if($marriageFund!='all'){
            $list = $list->filter(array(
                'Saving.MarriageFund' => $marriageFund
            ));
        }

		$mythri = Convert::raw2sql($this->request->getVar('Mythri'));		
        if($mythri!='all'){
            $list = $list->filter(array(
                'Saving.Mythri' => $mythri
            ));
        }
		$others = Convert::raw2sql($this->request->getVar('Others'));		
        if($others!='all'){
            $list = $list->filter(array(
                'Saving.Others' => $others
            ));
        }

        //$list = $list->leftJoin('Contact', "\"Contact\".\"FamilyID\" = \"Family\".\"ID\"");
        //Debug::show($list);

        return $list;
    }
	
	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
	
	
	public function SavingSearchForm(){
		$form = new SavingSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search Loan');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
	}

	
}
