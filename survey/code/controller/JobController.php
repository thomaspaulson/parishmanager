<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 2:08 PM
 */
class JobController extends SiteController
{

	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_job',
    		'AddJobForm',
    		'edit_job',
    		'EditJobForm',
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
		$this->title = 'Job';
    }

    public function index() {
		$this->title = 'Job';		
        return $this->renderWith(array('Job', 'App'));
    }    

    public function add_job(){
		    
    	$id = (int)$this->getRequest()->getVar('MemberID');
    	$member = FamilyMember::get()->byID($id);
    	if(!$member){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Job";
    	$form = $this->AddJobForm();
    
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
    
    
    public function AddJobForm(){
    	$form = new AddJobForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_job(){
    
    	$this->title = "Edit Job";
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$job = Job::get()->byID($id);
    	if(!$job){
    		return $this->httpError(404,'Page not found');
    	}
    	
    	$form = $this->EditJobForm();
    	$form->setTemplate('AddJobForm');
    	
    	if($job->exists() && $form){
    		$form->loadDataFrom($job);
    	}
    
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
		
		$this->title = 'Search education';
		$this->list = $this->Results();	
		return $this->renderWith(array('Job_results', 'App'));
    }


	public function printlist() {
		
		$this->title = 'Job list';
        return $this->renderWith(array('Job_printresults', 'Print'));
    }

	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "job.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Gender',
						'DOB','Age',						
						'Job','Family',
						'Unit', 'Block', 'Contact'
						); 
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
				
		foreach($this->list as $list) {
			$jobType = $list->Type? '('.$this->JobType($list->Type).')': '';
			$raw = array(  $list->Name, $this->Sex($list->Gender),
						   $this->FormatDate($list->DateOfBirth,'d-m-Y'), $this->Age($list->DateOfBirth, $list->Age),
						   $list->Title .$jobType  , $list->FamilyName,						   
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
            return Controller::join_links(Director::baseURL(), 'job', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'job');
        }
    }

    public function Results(){
		
		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('FamilyMember');
		$sqlQuery->selectField('FamilyMember.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'FamilyName');
		$sqlQuery->selectField('FamilyMember.Name', 'Name');
		$sqlQuery->addLeftJoin('Job','"FamilyMember"."ID" = "Job"."FamilyMemberID"');
		$sqlQuery->addLeftJoin('Family','"Family"."ID" = "FamilyMember"."FamilyID"');		

        
		
		$type= Convert::raw2sql($this->request->getVar('Type'));
        if($type){
			$sqlQuery->addWhere("Job.Type = '$type'");
            //$list = $list->filter(array(
            //    'Job.Type' => $type
            //));
        }

		$location = Convert::raw2sql($this->request->getVar('Location'));
        if($location){
			$sqlQuery->addWhere("Job.Location = '$location'");
            //$list = $list->filter(array(
            //    'Job.Location' => $location
            //));
        }
		
		$salary = Convert::raw2sql($this->request->getVar('Salary'));
        if($salary){
			$sqlQuery->addWhere("Job.Salary = '$salary'");
            //$list = $list->filter(array(
            //    'Job.Salary' => $salary
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
				leftJoin('Job','"Job"."FamilyMemberID" = "FamilyMember"."ID"');
        
		
		$type= Convert::raw2sql($this->request->getVar('Type'));
        if($type){
            $list = $list->filter(array(
                'Job.Type' => $type
            ));
        }

		$location = Convert::raw2sql($this->request->getVar('Location'));
        if($location){
            $list = $list->filter(array(
                'Job.Location' => $location
            ));
        }
		
		$salary = Convert::raw2sql($this->request->getVar('Salary'));
        if($salary){
            $list = $list->filter(array(
                'Job.Salary' => $salary
            ));
        }
		
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
		
		///*
		$parishID = Convert::raw2sql($this->request->getVar('ParishID'));
        if($parishID){
            $list = $list->filter(array(
                'ParishID' => $parishID
            ));
        }// * /


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
	
    protected function JobType($type){
		if($type){
			$typeCodes = Config::inst()->get('Job', 'TypeCode');
			return $typeCodes[$type];
		}
    }
	
    public function JobSearchForm(){
        $form = new JobSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search job');
        $form->loadDataFrom($this->request->getVars());
        $form->disableSecurityToken();
        return $form;
    }

	
}
