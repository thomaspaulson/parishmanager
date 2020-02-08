<?php
//
class SavingController extends SiteController{
	#code
	
	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_saving',
    		'AddSavingForm',
    		'edit_saving',
    		'EditSavingForm',
			'export_to_csv'
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

    public function add_saving(){
		    
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Saving";
    	$form = $this->AddSavingForm();
    
    	$familyID = $form->Fields()->fieldByName('FamilyID');
    	$familyID->setValue($family->ID);
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    	$data = array(
    			'Form' => $form
    	);
    
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    }
    
    
    public function AddSavingForm(){
    	$form = new AddSavingForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_saving(){
    
    	$this->title = "Edit Saving";
    	$form = $this->EditSavingForm();
    	$form->setTemplate('AddSavingForm');
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$saving = Saving::get()->byID($id);
    	if(!$saving){
    		return $this->httpError(404,'Page not found');
    	}
    	if($saving->exists() && $form){
    		$form->loadDataFrom($saving);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditSavingForm(){
    	$form = new EditSavingForm($this, __FUNCTION__);
    	return $form;
    }
	

	public function search(){
		$this->title = 'Search Saving';
		$this->list = $this->Results();
		return $this->renderWith(array('Saving_results','App'));
	}

	public function printlist(){
		
		$this->title = 'Saving list';		
		return $this->renderWith(array('Saving_printresults','Print'));
	}
	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "saving.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address',
						'Contact Person','Contact',
						'Block','Unit',
						'Family','HouseNo',
						'EducationFund', 'LifeInsurance',
						'HealthInsurance', 'DeathFund',
						'MarriageFund', 'KLM',
						'Chitty', 'WIDs',
						'Others', '[specify]'						
					   );
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {
			$educationFund = $list->EducationFund ? 'Yes': 'No';
			$lifeInsurance = $list->LifeInsurance ? 'Yes': 'No';			
			$HealthInsurance = $list->HealthInsurance? 'Yes': 'No';
			$DeathFund = $list->DeathFund? 'Yes': 'No';			
			$MarriageFund = $list->MarriageFund? 'Yes': 'No';
			$KLM = $list->KLM? 'Yes': 'No';
			$Chitty = $list->Chitty? 'Yes': 'No';
			$WIDs = $list->WIDs? 'Yes': 'No';
			$others = $list->Others? 'Yes': 'No';
			
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo,
 						   $list->FamilyNo, $list->HouseNo,
						   $educationFund, $lifeInsurance,
						   $HealthInsurance, $DeathFund,
						   $MarriageFund, $KLM,
						   $Chitty, $WIDs,
						   $others, $list->Specify
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
            return Controller::join_links(Director::baseURL(), 'saving', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'saving');
        }
    }

    public function Results(){
		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');
		$sqlQuery->addLeftJoin('Saving','"Family"."ID" = "Saving"."FamilyID"');	
		
   

		$educationFund = Convert::raw2sql($this->request->getVar('EducationFund'));		
        if($educationFund!='all'){
			$sqlQuery->addWhere("Saving.EducationFund = $educationFund");
        }
		
		$lifeInsurance = Convert::raw2sql($this->request->getVar('LifeInsurance'));		
        if($lifeInsurance!='all'){
			$sqlQuery->addWhere("Saving.LifeInsurance = $lifeInsurance");			
        }

		$healthInsurance = Convert::raw2sql($this->request->getVar('HealthInsurance'));		
        if($healthInsurance!='all'){
			$sqlQuery->addWhere("Saving.HealthInsurance = $healthInsurance");
        }
		
		$deathFund = Convert::raw2sql($this->request->getVar('DeathFund'));		
        if($deathFund!='all'){
			$sqlQuery->addWhere("Saving.DeathFund = $deathFund");
        }
		
		$marriageFund = Convert::raw2sql($this->request->getVar('MarriageFund'));		
        if($marriageFund!='all'){
			$sqlQuery->addWhere("Saving.MarriageFund = $marriageFund");
        }

		$klm = Convert::raw2sql($this->request->getVar('KLM'));		
        if($klm!='all'){
			$sqlQuery->addWhere("Saving.KLM = $klm");
        }
		$chitty = Convert::raw2sql($this->request->getVar('Chitty'));		
        if($chitty!='all'){
			$sqlQuery->addWhere("Saving.Chitty = $chitty");
        }
		$wids = Convert::raw2sql($this->request->getVar('WIDs'));		
        if($wids!='all'){
			$sqlQuery->addWhere("Saving.WIDs = $wids");
        }
        
		$others = Convert::raw2sql($this->request->getVar('Others'));		
        if($others!='all'){
			$sqlQuery->addWhere("Saving.Others = $others");
        }


		$myparish = $this->MyParish();
		$sqlQuery->addWhere("Family.ParishID = $myparish->ID");

		$sqlQuery->setOrderBy('Family.ID DESC');
		$result = $sqlQuery->execute();		//echo  $sqlQuery->sql();
		// Iterate over results
		$arrList = new ArrayList();
		$count = $result->numRecords();		
		foreach($result as $row) {			
			$row['Counter'] = $count--;			
			$arrList->add($row); 
		}		
		return $arrList;
    }	
	/*
    public function Results(){

        $list = Family::get()->leftJoin('Saving','"Family"."ID" = "Saving"."FamilyID"');
		
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
        

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

		$klm = Convert::raw2sql($this->request->getVar('KLM'));		
        if($klm!='all'){
            $list = $list->filter(array(
                'Saving.KLM' => $klm
            ));
        }
		$chitty = Convert::raw2sql($this->request->getVar('Chitty'));		
        if($chitty!='all'){
            $list = $list->filter(array(
                'Saving.Chitty' => $chitty
            ));
        }
		$wids = Convert::raw2sql($this->request->getVar('WIDs'));		
        if($wids!='all'){
            $list = $list->filter(array(
                'Saving.WIDs' => $wids
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
	*/
	
	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
	
	
	public function SavingSearchForm(){
		$form = new SavingSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search saving');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
	}

	
}
