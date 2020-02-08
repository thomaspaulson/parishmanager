<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 2:08 PM
 */
class FamilyMemberController extends SiteController
{

    public static $allowed_actions = array(
        'index',
    	'search',
    	'printlist',
    	'show',
    	'print_member',
    	'list_records',
    	'add_member',
		'AddFamilyMemberForm',
		'edit_member',
		'EditFamilyMemberForm',
		'view',
		'delete_member',
		'export_to_csv'
    );


	/**
	 * The current Family DataList .
	 *
	 * @var DataList
	 */	
	protected $list;
	
	protected $family;
	
    public function init(){
        parent::init();
		$this->title = 'Members';
    }

    public function index() {
        return $this->renderWith(array('FamilyMember', 'App'));
    }
    
    public function list_records() {
    	$this->title = 'Listing members';
    	$this->list = $this->Results();
    
    	return $this->renderWith(array('FamilyMember_listrecords', 'App'));
    }
    
    
    public function add_member(){
    	
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}    	
    	
    	$this->title = "Add member";
    	$form = $this->AddFamilyMemberForm();
    	
    	$familyID = $form->Fields()->fieldByName('FamilyID');
    	$familyID->setValue($family->ID);
    	$parishID = $form->Fields()->fieldByName('ParishID');
    	$parishID->setValue($family->ParishID);
    	
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    	 
    	$data = array(
    			'Form' => $form
    	);
    	
    	return $this->customise($data)->renderWith(array('FamilyMember_form', 'App'));
    }
    
    
    public function AddFamilyMemberForm(){
    	$form = new AddFamilyMemberForm($this, __FUNCTION__);
    	
    	return $form;
    
    }
    
    public function view(){
    	// show Unathorised page with user does not have access other parish
    	$id = Convert::raw2sql($this->request->param('ID'));
    	$familyMember = FamilyMember::get()->byID($id);
    	if(!$familyMember){
    		return $this->httpError('404','Page not found');
    	}
    	$this->title = 'Family Member details';
    	$data = array('FamilyMember' => $familyMember);
    	if($this->request->isAjax()){
    		return $this->customise($data )
    		->renderWith(array('FamilyMember_view'));
    	}
    	else{
    		return $this->customise($data )
    		->renderWith(array('FamilyMember_view','App'));
    	}
    }
    
		public function edit_member(){
		
			$this->title = "Edit member";
			$form = $this->EditFamilyMemberForm();
			$form->setTemplate('AddFamilyMemberForm');
			$id = (int)$this->request->param('ID');
			//var_dump($_POST);EXIT();
			$familyMember = FamilyMember::get()->byID($id);
			if(!$familyMember){
				return $this->httpError(404,'Page not found');
			}
			if($familyMember->exists() && $form){
				$form->loadDataFrom($familyMember);
			}

			$backURL = urldecode($this->getRequest()->getVar('BackURL'));
			$redirectURL = $form->Fields()->fieldByName('RedirectURL');
			$redirectURL->setValue($backURL);    	 
			
			if($familyMember->DateOfMarriage){
				$dom = $form->Fields()->fieldByName('DateOfMarriage');
				$dom->setValue(date('d-m-Y',strtotime($familyMember->DateOfMarriage)));
			}
			 
			if($familyMember->DateOfBirth){
				$dob = $form->Fields()->fieldByName('DateOfBirth');
				$dob->setValue(date('d-m-Y',strtotime($familyMember->DateOfBirth)));
			}	

			//check whether user belongs to myparish
			//$myParish = $this->MyParish();
			//$inParish = $family->Parishes()->filter(array('ID' => $myParish->ID))->First();
			//if(!$inParish){
			//	return $this->renderWith(array('Unathorised_access', 'App'));
			//}
    
    		$data = array(
    				'Form' => $form
    		);
    		return $this->customise($data)->renderWith(array('FamilyMember_form', 'App'));
    
    	}    
    
    	public function EditFamilyMemberForm(){
    		$form = new EditFamilyMemberForm($this, __FUNCTION__);
    		return $form;
    	}
    
    	public function delete_member(){
    
    		$this->title = "Delete family member";
    		$id = (int)$this->request->param('ID');
    		//var_dump($_POST);EXIT();
    		$familyMember = FamilyMember::get()->byID($id);
    
    		if(!$familyMember){
    			return $this->httpError(404,'Page not found');
    		}
    
    		if($familyMember->exists()){
    			$familyMember->destroy();
    			$familyMember->delete();
    			$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    			return $this->redirect($backURL.'&message=deleted');
    			//return $this->redirect($this->Link($backURL.'&message=deleted'));
    		}
    
    	}
    
    public function getFamily(){
    	if($this->family)
    		return $this->family;
    	else 
    		return null;
    }
    

    public function search() {
		
		$this->title = 'Search members';
		$this->list = $this->Results();	
		return $this->renderWith(array('FamilyMember_results', 'App'));
    }

    public function search_by_date() {
		
		$this->title = 'Search members';
		$this->list = $this->Results();	
		return $this->renderWith(array('FamilyMember_results', 'App'));
    }
	
	public function printlist() {
		// show Unathorised page with user does not have access other parish
		$parishID = Convert::raw2sql($this->request->getVar('ParishID'));		
		if(!$this->canAccess($parishID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}
		
		$this->title = 'Members list';
        return $this->renderWith(array('FamilyMember_printresults', 'Print'));
    }

	public function show(){
		$familyMemeberID = Convert::raw2sql($this->request->param('ID'));		
		$familyMember = FamilyMember::get()->byID($familyMemeberID);		
		if(!$familyMember){
			return $this->httpError('404','Page not found');
		}
		$this->title = 'Show Member details';
		$data = array('FamilyMember' => $familyMember);
		if($this->request->isAjax()){
			return $this->customise($data )
				->renderWith(array('FamilyMember_show'));
		}
		else{
			return $this->customise($data )
				->renderWith(array('FamilyMember_show','App'));			
		}
	}
	

	public function print_member(){		
		$familyMemeberID = Convert::raw2sql($this->request->param('ID'));		
		$familyMember = FamilyMember::get()->byID($familyMemeberID);		
		if(!$familyMember){
			return $this->httpError('404','Page not found');
		}		
		$this->title = 'Print Family Member details';
		$data = array('FamilyMember' => $familyMember);
		
        return $this->customise($data )
			->renderWith(array('FamilyMember_print','Print'));		
	}	
	
	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "members.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Gender',
						'DOB','Age',
						'Blood Gr','Status',
						'Marriage','Family',
						'Passport', 'Bank account', 'Driving licence',
						'Unit', 'Block', 'Contact'
						); 
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
				
		foreach($this->list as $list) {
			$holdsPassport = $list->HoldsPassport ? 'Yes': 'No';
			$holdsBankAccount = $list->HoldsBankAccount	 ? 'Yes': 'No';
			$holdsDrivingLicence = $list->HoldsDrivingLicence? 'Yes': 'No';
			
			$raw = array(  $list->Name, $this->Sex($list->Gender),
						   $this->DOB($list->DateOfBirth,'d-m-Y'), $this->Age($list->DateOfBirth, $list->Age),
						   $list->BloodGroup, $this->MStatus($list->MartialStatus),
						   $this->DOB($list->DateOfMarriage,'d-m-Y'), $list->FamilyName,
						   $holdsPassport, $holdsBankAccount, $holdsDrivingLicence,
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
            return Controller::join_links(Director::baseURL(), 'members', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'members');
        }        
        
    }
	
	protected function Budddu(){
		return 'Budddu()';
	}
	
	public function Results(){
		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('FamilyMember');
		$sqlQuery->selectField('FamilyMember.ID', 'ID');		
		$sqlQuery->selectField('Family.Name', 'FamilyName');
		$sqlQuery->selectField('FamilyMember.Name', 'Name');
		$sqlQuery->addLeftJoin('Family','"Family"."ID" = "FamilyMember"."FamilyID"');		
		
		if($name = Convert::raw2sql($this->request->getVar('Name'))) {
			$sqlQuery->addWhere("FamilyMember.Name LIKE '%$name%'");
		}

		if($dateOfBirth = Convert::raw2sql($this->request->getVar('DateOfBirth'))) {		
			$date = date('Y-m-d', strtotime($dateOfBirth));
			$sqlQuery->addWhere("FamilyMember.DateOfBirth = '$date'");
		}
        
		
		if($ageFrom = $this->request->getVar('AgeForm')) {		
			$year = (int)$ageFrom;
			$time = strtotime("-$year year", time());
			$date = date("Y-m-d", $time);	
			//echo $date.'<br />';
			$sqlQuery->addWhere("FamilyMember.DateOfBirth <= '$date'");			
		}
		
		if($ageUpTo = $this->request->getVar('AgeUpto')) {		
			$year = (int)$ageUpTo + 1; 
			$time = strtotime("-$year year", time());
			$date = date("Y-m-d", $time);						
			//echo $date.'<br />';
			$sqlQuery->addWhere("FamilyMember.DateOfBirth >= '$date'");			
		}
		
		
		$gender = Convert ::raw2sql($this->request->getVar('Gender'));
        if($gender!='all' && $gender){
			$sqlQuery->addWhere("FamilyMember.Gender = '$gender'");
        }

			
		$bloodGroup = Convert::raw2sql($this->request->getVar('BloodGroup'));
        if($bloodGroup){
			$sqlQuery->addWhere("FamilyMember.BloodGroup = '$bloodGroup'");
        }
		
		$martialStatus = Convert::raw2sql($this->request->getVar('MartialStatus'));		
        if($martialStatus){
			$sqlQuery->addWhere("FamilyMember.MartialStatus = '$martialStatus'");
        }

		
        $holdsPassport = Convert::raw2sql($this->request->getVar('HoldsPassport'));
		
        if($holdsPassport!='all' && $holdsPassport!=''){
			$sqlQuery->addWhere("FamilyMember.HoldsPassport = $holdsPassport");
        }

        $holdsBankAccount = Convert::raw2sql($this->request->getVar('HoldsBankAccount'));
        if($holdsBankAccount!='all' && $holdsBankAccount!=''){
			$sqlQuery->addWhere("FamilyMember.HoldsBankAccount = $holdsBankAccount");
        }
		
		$holdsDrivingLicence = Convert::raw2sql($this->request->getVar('HoldsDrivingLicence'));
        if($holdsDrivingLicence!='all' && $holdsDrivingLicence!=''){
			$sqlQuery->addWhere("FamilyMember.HoldsDrivingLicence = $holdsDrivingLicence");
        }
		
		$day = Convert::raw2sql($this->request->getVar('Day'));		
		if($day){
			$sqlQuery->addWhere("DAY(FamilyMember.DateOfBirth) = $day");
			//$list = $list->where('DAY("DateOfBirth") = '.$day);
		}
		
		$month = Convert::raw2sql($this->request->getVar('Month'));
		if($month){
			$sqlQuery->addWhere("MONTH(FamilyMember.DateOfBirth) = $month");
			//$list = $list->where('MONTH("DateOfBirth") = '.$month);
		}
		
		$year = Convert::raw2sql($this->request->getVar('Year'));
		if($year){
			$sqlQuery->addWhere("YEAR(FamilyMember.DateOfBirth) = $year");
			//$list = $list->where('YEAR("DateOfBirth") = '.$year);
		}
	
		
		if($mYearsForm = $this->request->getVar('MYearsForm')) {		
			$year = (int)$mYearsForm;
			$time = strtotime("-$year year", time());
			$date = date("Y-m-d", $time);	
			//echo $date.'<br />';
			$sqlQuery->addWhere("FamilyMember.DateOfMarriage <= '$date'");
		}
		
		if($mYearsUpto = $this->request->getVar('MYearsUpto')) {		
			$year = (int)$mYearsUpto + 1; 
			$time = strtotime("-$year year", time());
			$date = date("Y-m-d", $time);						
			//echo $date.'<br />';
			$sqlQuery->addWhere("FamilyMember.DateOfMarriage >= '$date'");
		}
		
		$mDay = Convert::raw2sql($this->request->getVar('MDay'));		
		if($mDay){
			$sqlQuery->addWhere("DAY(FamilyMember.DateOfMarriage) = $mDay");
			//$list = $list->where('DAY("DateOfMarriage") = '.$mDay);
		}
		
		$mMonth = Convert::raw2sql($this->request->getVar('MMonth'));
		if($mMonth){
			$sqlQuery->addWhere("MONTH(FamilyMember.DateOfMarriage) = $mMonth");
			//$list = $list->where('MONTH("DateOfMarriage") = '.$mMonth);
		}
		
		$mYear = Convert::raw2sql($this->request->getVar('MYear'));
		if($mYear){
			$sqlQuery->addWhere("YEAR(FamilyMember.DateOfMarriage) = $mYear");
			//$list = $list->where('YEAR("DateOfMarriage") = '.$mYear);
		}		
		
		$myparish = $this->MyParish();
		$sqlQuery->addWhere("FamilyMember.ParishID = $myparish->ID");		
		
		
		$sqlQuery->setOrderBy('FamilyMember.ID DESC');
		$result = $sqlQuery->execute();
		//echo $sqlQuery->sql();
		// Iterate over results
		$arrList = new ArrayList();
		$count = $result->numRecords();
		//echo 'SELECT COUNT(*) FROM "Family" where ParishID = '.$myparish->ID;
		foreach($result as $row) {			
			$row['Counter'] = $count--;			
			$arrList->add($row); 
		}		
		return $arrList;
	}


	/*
    public function Results(){

        $list = FamilyMember::get();

		if($name = ($this->request->getVar('Name'))) {					
			$list = $list->filter(array(
				'Name:PartialMatch' => $name             
			));
		}

		if($dateOfBirth = Convert::raw2sql($this->request->getVar('DateOfBirth'))) {		
			//$year = (int)$ageFrom;
			//$time = strtotime("-$year year", time());
			//$date = date("Y-m-d", $time);	
			//echo $date.'<br />';					
			$list = $list->filter(array(
				'DateOfBirth:PartialMatch' => date('Y-m-d', strtotime($dateOfBirth))             
			));			
		}
        
		if($ageFrom = $this->request->getVar('AgeForm')) {		
			$year = (int)$ageFrom;
			$time = strtotime("-$year year", time());
			$date = date("Y-m-d", $time);	
			//echo $date.'<br />';					
			$list = $list->filter(array(
				'DateOfBirth:LessThanOrEqual' => $date             
			));			
		}
		
		if($ageUpTo = $this->request->getVar('AgeUpto')) {		
			$year = (int)$ageUpTo + 1; 
			$time = strtotime("-$year year", time());
			$date = date("Y-m-d", $time);						
			//echo $date.'<br />';
			$list = $list->filter(array(
				'DateOfBirth:GreaterThanOrEqual' => $date             
			));			
		}
		
		$gender = Convert ::raw2sql($this->request->getVar('Gender'));
        if($gender!='all' && $gender){
            $list = $list->filter(array(
                'Gender' => $gender
            ));
        }

		$bloodGroup = Convert::raw2sql($this->request->getVar('BloodGroup'));
        if($bloodGroup){
            $list = $list->filter(array(
                'BloodGroup' => $bloodGroup
            ));
        }
		
		$martialStatus = Convert::raw2sql($this->request->getVar('MartialStatus'));		
        if($martialStatus){
            $list = $list->filter(array(
                'MartialStatus' => $martialStatus
            ));
        }

        $holdsPassport = Convert::raw2sql($this->request->getVar('HoldsPassport'));
        if($holdsPassport!='all' && $holdsPassport){
            $list = $list->filter(array(
                'HoldsPassport' => $holdsPassport
            ));
        }

        $holdsBankAccount = Convert::raw2sql($this->request->getVar('HoldsBankAccount'));
        if($holdsBankAccount!='all' && $holdsBankAccount){
            $list = $list->filter(array(
                'HoldsBankAccount' => $holdsBankAccount
            ));
        }
		
		$holdsDrivingLicence = Convert::raw2sql($this->request->getVar('HoldsDrivingLicence'));
        if($holdsDrivingLicence!='all' && $holdsDrivingLicence){
            $list = $list->filter(array(
                'HoldsDrivingLicence' => $holdsDrivingLicence
            ));
        }

		$day = Convert::raw2sql($this->request->getVar('Day'));		
		if($day){
			$list = $list->where('DAY("DateOfBirth") = '.$day);
		}
		
		$month = Convert::raw2sql($this->request->getVar('Month'));
		if($month){
			$list = $list->where('MONTH("DateOfBirth") = '.$month);
		}
		
		$year = Convert::raw2sql($this->request->getVar('Year'));
		if($year){
			$list = $list->where('YEAR("DateOfBirth") = '.$year);
		}

		if($mYearsForm = $this->request->getVar('MYearsForm')) {		
			$year = (int)$mYearsForm;
			$time = strtotime("-$year year", time());
			$date = date("Y-m-d", $time);	
			//echo $date.'<br />';					
			$list = $list->filter(array(
				'DateOfMarriage:LessThanOrEqual' => $date             
			));			
		}
		
		if($mYearsUpto = $this->request->getVar('MYearsUpto')) {		
			$year = (int)$mYearsUpto + 1; 
			$time = strtotime("-$year year", time());
			$date = date("Y-m-d", $time);						
			//echo $date.'<br />';
			$list = $list->filter(array(
				'DateOfMarriage:GreaterThanOrEqual' => $date             
			));			
		}
		
		$mDay = Convert::raw2sql($this->request->getVar('MDay'));		
		if($mDay){
			$list = $list->where('DAY("DateOfMarriage") = '.$mDay);
		}
		
		$mMonth = Convert::raw2sql($this->request->getVar('MMonth'));
		if($mMonth){
			$list = $list->where('MONTH("DateOfMarriage") = '.$mMonth);
		}
		
		$mYear = Convert::raw2sql($this->request->getVar('MYear'));
		if($mYear){
			$list = $list->where('YEAR("DateOfMarriage") = '.$mYear);
		}
		
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
		
		
        

        //$list = $list->leftJoin('Contact', "\"Contact\".\"FamilyID\" = \"Family\".\"ID\"");
        //Debug::show($list->sql());
		//Debug::show($list);

        return $list->sort('ID DESC');
    }*/

	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}

	public function Sex($gender){
		if($gender == 'm')
			return 'Male';
		else
			return 'Female';
	}

	//return MartialStatus ie 'Married/Single/...'
	public function MStatus($martialStatus){
		switch($martialStatus){
			case 'm':
				return 'Married';
				break;

			case 's':
				return 'Single';
				break;

			case 'w':
				return 'Widow/Widower';
				break;

			case 'd':
				return 'Divorced';
				break;

			case 'o':
				return 'Others';
				break;

			case 'p':
				return 'Priests';
				break;
			
			case 'n':
				return 'Sisters';
				break;				
				
		}

	}

	public function Age($dob, $age){
		if($dob){
			$from = new DateTime($dob);
			$to   = new DateTime('today');
			return  $from->diff($to)->y.'';
		}
		else{
			return $age;
		}
	}
	
	public function DOB($date, $format){
		if($date){
			$date = new DateTime($date);
			return $date->format( $format);
		}
		return 'NA';
		//return date($format , $date );	
	}
		
	public function FamilyMemberLiteSearchForm(){
		$form = new FamilyMemberLiteSearchForm($this,__FUNCTION__);
		$form->setFormMethod('get')
		->setFormAction($this->link('list-records'));
		$form->setLegend('Search members');
		$form->loadDataFrom($this->request->getVars());
		$form->disableSecurityToken();
		return $form;
	}
	
    public function FamilyMemberSearchForm(){
        $form = new FamilyMemberSearchForm($this, __FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search members');
        $form->loadDataFrom($this->request->getVars());
        $form->disableSecurityToken();
        return $form;
    }
	
    public function FamilyMemberSearchByDateForm(){
        $form = new FamilyMemberSearchByDateForm($this, __FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search by date');
        $form->loadDataFrom($this->request->getVars());
        $form->disableSecurityToken();
        return $form;
    }

    public function EducationSearchForm(){
        $controller = new EducationController();
        $form = $controller->EducationSearchForm();
        return $form;
    }

	
    public function JobSearchForm(){
        $controller = new JobController();
        $form = $controller->JobSearchForm();
        return $form;
    }
	
	
    public function HealthSearchForm(){
        $controller = new HealthController();
        $form = $controller->HealthSearchForm();
        return $form;
    }

	
    public function GroupsSearchForm(){
        $controller = new GroupsController();
        $form = $controller->GroupsSearchForm();
        return $form;
    }
	
	
}
