<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 2:08 PM
 */
class EducationController extends SiteController
{

	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_education',
    		'AddEducationForm',
			'bulkadd',
			'AddBulkEducationForm',
    		'edit_education',
    		'EditEducationForm',
    		'delete_education',
			'export_to_csv'
    );		
	


	/**
	 * The current Family DataList .
	 *
	 * @var DataList
	 */	
	protected $list;
	
    public function init(){
        parent::init();
		$this->title = 'Education';
    }

    public function index() {
        return $this->renderWith(array('Education', 'App'));
    }
    
    public function add_education(){
		    
    	$id = (int)$this->getRequest()->getVar('MemberID');
    	$member = FamilyMember::get()->byID($id);
    	if(!$member){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Education";
    	$form = $this->AddEducationForm();
    
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
    
    
    public function AddEducationForm(){
    	$form = new AddEducationForm($this, __FUNCTION__);
    	return $form;
    }
	
	public function bulkadd(){
	
		if ($_SERVER['REQUEST_METHOD'] == 'POST')	{
			//print_r($_POST);	exit();
			$memberId = (int)$_POST['FamilyMemberID'];
			foreach($_POST['Code'] as $key => $val){
				if(!empty($val)){
					$education = Education::create();
					$education->Code = Convert ::raw2sql($val);
					$education->Subject = Convert ::raw2sql($_POST['Subject'][$key]);
					$education->Status = Convert ::raw2sql($_POST['Status'][$key]);
					$education->FamilyMemberID = $memberId;
					$education->write();
				}					
			}
			$redirectUrl = urldecode($_POST['RedirectURL']);			
			return $this->redirect($redirectUrl);
		}
    	$id = (int)$this->getRequest()->getVar('MemberID');
    	$member = FamilyMember::get()->byID($id);
    	if(!$member){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Education";
    	$form = $this->AddBulkEducationForm();
    
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
    
    public function AddBulkEducationForm(){		
    	$form = new AddBulkEducationForm($this, __FUNCTION__);
		$form->setFormAction($this->Link('bulkadd'));
    	return $form;
    }
	
    public function edit_education(){
    
    	$this->title = "Edit Education";
    	
    	$id = (int)$this->request->param('ID');
    	$education = Education::get()->byID($id);
    	if(!$education){
    		return $this->httpError(404,'Page not found');
    	}
    	
    	$form = $this->EditEducationForm();
    	$form->setTemplate('AddEducationForm');    	
    	if($education->exists() && $form){
    		$form->loadDataFrom($education);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
	public function delete_education(){

		$this->title = "Delete Education";
		$id = (int)$this->request->param('ID');
		//var_dump($_POST);EXIT();
		$education = Education::get()->byID($id);

		if(!$education){
			return $this->httpError(404,'Page not found');
		}

		if($education->exists()){
			$education->destroy();
			$education->delete();
			$backURL = urldecode($this->getRequest()->getVar('BackURL'));
			return $this->redirect($backURL.'&message=deleted');
			//return $this->redirect($this->Link($backURL.'&message=deleted'));
		}

	}
    
    public function EditEducationForm(){
    	$form = new EditEducationForm($this, __FUNCTION__);
    	return $form;
    }

    

    public function search() {
		
		$this->title = 'Search education';
		$this->list = $this->Results();	
		return $this->renderWith(array('Education_results', 'App'));
    }


	public function printlist() {

		
		$this->title = 'Education list';
        return $this->renderWith(array('Education_printresults', 'Print'));
    }

	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "education.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Gender',
						'DOB','Age',						
						'Eduction','Family',
						'Unit', 'Block', 'Contact'
						); 
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
				
		foreach($this->list as $list) {
			
			$raw = array(  $list->Name, $this->Sex($list->Gender),
						   $this->FormatDate($list->DateOfBirth,'d-m-Y'), $this->Age($list->DateOfBirth, $list->Age),
						   $this->Course($list->Code).' ('.$list->Subject.')' , $list->FamilyName,						   
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
            return Controller::join_links(Director::baseURL(), 'education', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'education');
        }
    }

	
	
    public function Results(){

		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('FamilyMember');
		$sqlQuery->selectField('FamilyMember.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'FamilyName');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('Education','"FamilyMember"."ID" = "Education"."FamilyMemberID"');
		$sqlQuery->addLeftJoin('Family','"Family"."ID" = "FamilyMember"."FamilyID"');
	
        
		
		if($ageFrom = $this->request->getVar('AgeForm')) {		
			$year = (int)$ageFrom;
			$time = strtotime("-$year year", time());
			$date = date("Y-m-d", $time);	
			//echo $date.'<br />';
			$sqlQuery->addWhere("FamilyMember.DateOfBirth <= '$date'");
			/*$list = $list->filter(array(
				'FamilyMember.DateOfBirth:LessThanOrEqual' => $date             
			));*/
		}
		
		if($ageUpTo = $this->request->getVar('AgeUpto')) {		
			$year = (int)$ageUpTo + 1; 
			$time = strtotime("-$year year", time());			
			$date = date("Y-m-d", $time);						
			//echo $date.'<br />';
			$sqlQuery->addWhere("FamilyMember.DateOfBirth >= '$date'");
			//$list = $list->filter(array(
			//	'FamilyMember.DateOfBirth:GreaterThanOrEqual' => $date             
			//));
		}
		
		$gender = Convert ::raw2sql($this->request->getVar('Gender'));
        if($gender!='all' && $gender){
			$sqlQuery->addWhere("FamilyMember.Gender = '$gender'");
            //$list = $list->filter(array(
            //    'FamilyMember.Gender' => $gender
            //));
        }
        		
		$code = Convert::raw2sql($this->request->getVar('Code'));
        if($code){
			$sqlQuery->addWhere("Education.Code = '$code'");
            //$list = $list->filter(array(
            //    'Education.Code' => $code
            //));
        }

		$status = Convert::raw2sql($this->request->getVar('Status'));
        if($code && $status){
			$sqlQuery->addWhere("Education.Status = $status");
            //$list = $list->filter(array(
            //    'Education.Status' => $status
            //));
        }
		$myparish = $this->MyParish();
		$sqlQuery->addWhere("FamilyMember.ParishID = $myparish->ID");		
		
		$sqlQuery->setOrderBy('FamilyMember.ID DESC');
		$result = $sqlQuery->execute();		
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

        $list = FamilyMember::get()->
				leftJoin('Education','"Education"."FamilyMemberID" = "FamilyMember"."ID"');
        
		
		if($ageFrom = $this->request->getVar('AgeForm')) {		
			$year = (int)$ageFrom;
			$time = strtotime("-$year year", time());
			$date = date("Y-m-d", $time);	
			//echo $date.'<br />';					
			$list = $list->filter(array(
				'FamilyMember.DateOfBirth:LessThanOrEqual' => $date             
			));
		}
		
		if($ageUpTo = $this->request->getVar('AgeUpto')) {		
			$year = (int)$ageUpTo + 1; 
			$time = strtotime("-$year year", time());			
			$date = date("Y-m-d", $time);						
			//echo $date.'<br />';
			$list = $list->filter(array(
				'FamilyMember.DateOfBirth:GreaterThanOrEqual' => $date             
			));
		}
		
		$gender = Convert ::raw2sql($this->request->getVar('Gender'));
        if($gender!='all' && $gender){
            $list = $list->filter(array(
                'FamilyMember.Gender' => $gender
            ));
        }
        		
		$code = Convert::raw2sql($this->request->getVar('Code'));
        if($code){
            $list = $list->filter(array(
                'Education.Code' => $code
            ));
        }

		$status = Convert::raw2sql($this->request->getVar('Status'));
        if($code && $status){
            $list = $list->filter(array(
                'Education.Status' => $status
            ));
        }
		
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
		


        //$list = $list->leftJoin('Contact', "\"Contact\".\"FamilyID\" = \"Family\".\"ID\"");
        //Debug::show($list);

        return $list;
    }
    */

	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
	
    public function EducationSearchForm(){
        $form = new EducationSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search education');
        $form->loadDataFrom($this->request->getVars());
        $form->disableSecurityToken();
        return $form;
    }


	protected function FormatDate($value, $format){
		if($value){
			$date = new DateTime($value);
			return $date->format($format);
		}
	}
	
	public function Sex($gender){
		if($gender == 'm')
			return 'Male';
		else
			return 'Female';
	}	
	
	protected function Age($dob, $age){		
		if($dob){
			$from = new DateTime($dob);
			$to   = new DateTime('today');
			return  $from->diff($to)->y;
		}
		else{
			return  $age;
		}
	}
	
    public function Course($code){
        $codes = Config::inst()->get('Education', 'Course');
        return ($code)?$codes[$code]:"";
    }
	

	protected function Dummy(){
		return 'dummy';
	}	
}
