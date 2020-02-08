<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 2:08 PM
 */
class HealthController extends SiteController
{

	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_health',
    		'AddHealthForm',
    		'edit_health',
    		'EditHealthForm',
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
		$this->title = 'Health';
    }

    public function index() {
        return $this->renderWith(array('Health', 'App'));
    }


    public function add_health(){
		    
    	$id = (int)$this->getRequest()->getVar('MemberID');
    	$member = FamilyMember::get()->byID($id);
    	if(!$member){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Health";
    	$form = $this->AddHealthForm();
    
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
    
    
    public function AddHealthForm(){
    	$form = new AddHealthForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_health(){
    
    	$this->title = "Edit Health";
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$health = Health::get()->byID($id);
    	if(!$health){
    		return $this->httpError(404,'Page not found');
    	}
    	
    	$form = $this->EditHealthForm();
    	$form->setTemplate('AddHealthForm');
    	
    	if($health->exists() && $form){
    		$form->loadDataFrom($health);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditHealthForm(){
    	$form = new EditHealthForm($this, __FUNCTION__);
    	return $form;
    }



    public function search() {
		
		$this->title = 'Search health';
		$this->list = $this->Results();	
		return $this->renderWith(array('Health_results', 'App'));
    }


	public function printlist() {
		
		$this->title = 'Health list';
        return $this->renderWith(array('Health_printresults', 'Print'));
    }

	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "health.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Gender',
						'DOB','Age',						
						'Blind', 'Deaf',
						'Dumb', 'Other Physical Disability',
						'Mental Disability', 'Heart Disease',
						'Diabetes', 'Cancer',
						'Blood Pressure', 'Alcoholic',
						'Other disease', '[other info]',
						'Family','Unit', 'Block', 'Contact'
						); 
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {			
			$Blind = $list->Blind ? 'Yes': 'No';
			$Deaf = $list->Deaf? 'Yes': 'No';
			$Dumb = $list->Dumb? 'Yes': 'No';
			$OtherPhysicalDisability = $list->OtherPhysicalDisability? 'Yes': 'No';
			$MentalDisability = $list->MentalDisability? 'Yes': 'No';
			$HearthDisease = $list->HearthDisease? 'Yes': 'No';
			$Diabetes = $list->Diabetes? 'Yes': 'No';
			$Cancer = $list->Cancer? 'Yes': 'No';
			$BloodPressure = $list->BloodPressure? 'Yes': 'No';
			$Alcoholic = $list->Alcoholic? 'Yes': 'No';
			$OtherDisease = $list->OtherDisease? 'Yes': 'No';
			
			$raw = array(  $list->Name, $this->Sex($list->Gender),
						   $this->FormatDate($list->DateOfBirth,'d-m-Y'), $this->Age($list->DateOfBirth, $list->Age),
						   $Blind, $Deaf,
						   $Dumb, $OtherPhysicalDisability,
						   $MentalDisability, $Deaf,
						   $Diabetes, $Cancer,
						   $BloodPressure, $Alcoholic,
						   $OtherDisease, $list->OtherHealthInfo,
						   $list->FamilyName, $list->UnitNo, $list->BlockNo,  $list->ContactNo
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
            return Controller::join_links(Director::baseURL(), 'health', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'health');
        }
    }

    public function Results(){

		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('FamilyMember');
		$sqlQuery->selectField('FamilyMember.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'FamilyName');
		$sqlQuery->selectField('FamilyMember.Name', 'Name');
		$sqlQuery->addLeftJoin('Health','"FamilyMember"."ID" = "Health"."FamilyMemberID"');
		$sqlQuery->addLeftJoin('Family','"Family"."ID" = "FamilyMember"."FamilyID"');		

        
		
        
		
		$blind= Convert::raw2sql($this->request->getVar('Blind'));
        if($blind){
			$sqlQuery->addWhere("Health.Blind = $blind");
        }

		$deaf = Convert::raw2sql($this->request->getVar('Deaf'));
        if($deaf){
			$sqlQuery->addWhere("Health.Deaf = $deaf");
        }
		
		$dumb = Convert::raw2sql($this->request->getVar('Dumb'));
        if($dumb){
			$sqlQuery->addWhere("Health.Dumb = $dumb");
        }
		
				
		$otherPhsicalDisability = Convert::raw2sql($this->request->getVar('OtherPhsicalDisability'));
        if($otherPhsicalDisability){
			$sqlQuery->addWhere("Health.OtherPhsicalDisability = $otherPhsicalDisability");			
        }
		
		$learningDisability = Convert::raw2sql($this->request->getVar('LearningDisability'));
        if($learningDisability){
			$sqlQuery->addWhere("Health.LearningDisability = $learningDisability");
        }
		
		$mentalDisability = Convert::raw2sql($this->request->getVar('MentalDisability'));
        if($mentalDisability){
			$sqlQuery->addWhere("Health.MentalDisability = $mentalDisability");
        }
		
		$hearthDisease = Convert::raw2sql($this->request->getVar('HearthDisease'));
        if($hearthDisease){
			$sqlQuery->addWhere("Health.HearthDisease = $hearthDisease");
        }

		
		$diabetes = Convert::raw2sql($this->request->getVar('Diabetes'));
        if($diabetes){
			$sqlQuery->addWhere("Health.Diabetes = $diabetes");
        }
		
		$cancer = Convert::raw2sql($this->request->getVar('Cancer'));
        if($cancer){
			$sqlQuery->addWhere("Health.Cancer = $cancer");
        }
		
		$bloodPressure = Convert::raw2sql($this->request->getVar('BloodPressure'));
        if($bloodPressure){
			$sqlQuery->addWhere("Health.BloodPressure = $bloodPressure");
        }
		
		$alcoholic = Convert::raw2sql($this->request->getVar('Alcoholic'));
        if($alcoholic){
			$sqlQuery->addWhere("Health.Alcoholic = $alcoholic");
        }
		
		$otherDisease = Convert::raw2sql($this->request->getVar('OtherDisease'));
        if($otherDisease){
			$sqlQuery->addWhere("Health.OtherDisease = $otherDisease");
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

        $list = FamilyMember::get()->
				leftJoin('Health','"Health"."FamilyMemberID" = "FamilyMember"."ID"');
        
		
		$blind= Convert::raw2sql($this->request->getVar('Blind'));
        if($blind!='all'){
            $list = $list->filter(array(
                'Health.Blind' => $blind
            ));
        }

		$deaf = Convert::raw2sql($this->request->getVar('Deaf'));
        if($deaf!='all'){
            $list = $list->filter(array(
                'Health.Deaf' => $deaf
            ));
        }
		
		$dumb = Convert::raw2sql($this->request->getVar('Dumb'));
        if($dumb!='all'){
            $list = $list->filter(array(
                'Health.Dumb' => $dumb
            ));
        }

		$otherPhsicalDisability = Convert::raw2sql($this->request->getVar('OtherPhsicalDisability'));
        if($otherPhsicalDisability!='all'){
            $list = $list->filter(array(
                'Health.OtherPhsicalDisability' => $otherPhsicalDisability
            ));
        }
		
		$learningDisability = Convert::raw2sql($this->request->getVar('LearningDisability'));
        if($learningDisability!='all'){
            $list = $list->filter(array(
                'Health.LearningDisability' => $learningDisability
            ));
        }
		
		$mentalDisability = Convert::raw2sql($this->request->getVar('MentalDisability'));
        if($mentalDisability!='all'){
            $list = $list->filter(array(
                'Health.MentalDisability' => $mentalDisability
            ));
        }
		
		$hearthDisease = Convert::raw2sql($this->request->getVar('HearthDisease'));
        if($hearthDisease!='all'){
            $list = $list->filter(array(
                'Health.HearthDisease' => $hearthDisease
            ));
        }
		
		$diabetes = Convert::raw2sql($this->request->getVar('Diabetes'));
        if($diabetes!='all'){
            $list = $list->filter(array(
                'Health.Diabetes' => $diabetes
            ));
        }
		
		$cancer = Convert::raw2sql($this->request->getVar('Cancer'));
        if($cancer!='all'){
            $list = $list->filter(array(
                'Health.Cancer' => $cancer
            ));
        }
		
		$bloodPressure = Convert::raw2sql($this->request->getVar('BloodPressure'));
        if($bloodPressure!='all'){
            $list = $list->filter(array(
                'Health.BloodPressure' => $bloodPressure
            ));
        }
		
		$alcoholic = Convert::raw2sql($this->request->getVar('Alcoholic'));
        if($alcoholic!='all'){
            $list = $list->filter(array(
                'Health.Alcoholic' => $alcoholic
            ));
        }
		
		$otherDisease = Convert::raw2sql($this->request->getVar('OtherDisease'));
        if($otherDisease!='all'){
            $list = $list->filter(array(
                'Health.OtherDisease' => $otherDisease
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
        //Debug::show($list);
		
        return $list;
    }*/

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
	
	protected function Sex($gender){
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
    public function HealthSearchForm(){
        $form = new HealthSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search health');
        $form->loadDataFrom($this->request->getVars());
        $form->disableSecurityToken();
        return $form;
    }

	
}
