<?php
//
class LoanController extends SiteController{
	#code
	
	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_loan',
    		'AddLoanForm',
    		'edit_loan',
    		'EditLoanForm',
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
		$this->title = 'Loan';		
		return $this->renderWith(array('Loan','App'));
	}
	
    public function add_loan(){
		    
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Loan";
    	$form = $this->AddLoanForm();
    
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
    
    
    public function AddLoanForm(){
    	$form = new AddLoanForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_loan(){
    
    	$this->title = "Edit Loan";
    	$form = $this->EditLoanForm();
    	$form->setTemplate('AddLoanForm');
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$loan = Loan::get()->byID($id);
    	if(!$loan){
    		return $this->httpError(404,'Page not found');
    	}
    	if($loan->exists() && $form){
    		$form->loadDataFrom($loan);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditLoanForm(){
    	$form = new EditLoanForm($this, __FUNCTION__);
    	return $form;
    }
	

	public function search(){
		$this->title = 'Search Loan';
		$this->list = $this->Results();
		return $this->renderWith(array('Loan_results','App'));
	}

	public function printlist(){		
		$this->title = 'Loan list';		
		return $this->renderWith(array('Loan_printresults','Print'));
	}
	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "loan.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address',
						'Contact Person','Contact',
						'Block','Unit',
						'Family','HouseNo',
						'HasLoan', 'From Bank',
						'From private bank', 'From person', 'Reason'										
					   );
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {
			$hasLoan = $list->HasLoan ? 'Yes': 'No';
			$fromBank = $list->HasLoan &&  $list->FromBank  ? 'Yes': '';
			$fromPrivateBank = $list->HasLoan &&  $list->FromPrivateBank  ? 'Yes': '';
			$fromPerson = $list->HasLoan &&  $list->FromPerson  ? 'Yes': '';			
			$reason = $list->HasLoan &&  $list->Reason  ? $list->Reason: '';
			
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo,
 						   $list->FamilyNo, $list->HouseNo,
						   $hasLoan, $fromBank,
						   $fromPrivateBank, $fromPerson, $reason						   					   
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
            return Controller::join_links(Director::baseURL(), 'loan', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'loan');
        }
    }
	
    public function Results(){

		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');
		$sqlQuery->addLeftJoin('Loan','"Family"."ID" = "Loan"."FamilyID"');	

		$hasLoan = Convert::raw2sql($this->request->getVar('HasLoan'));		
        if($hasLoan!='all'){
			$sqlQuery->addWhere("Loan.HasLoan = $hasLoan");
        }
        
		if($hasLoan==1){
			$fromBank = Convert::raw2sql($this->request->getVar('FromBank'));		
			if($fromBank){
				$sqlQuery->addWhere("Loan.FromBank = $fromBank");
			}
			$fromPrivateBank = Convert::raw2sql($this->request->getVar('FromPrivateBank'));		
			if($fromPrivateBank){
				$sqlQuery->addWhere("Loan.FromPrivateBank = $fromPrivateBank");
			}
			$fromPerson = Convert::raw2sql($this->request->getVar('FromPerson'));		
			if($fromPerson){
				$sqlQuery->addWhere("Loan.FromPerson = $fromPerson");
			}
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

        $list = Family::get()->leftJoin('Loan','"Family"."ID" = "Loan"."FamilyID"');
		
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
        

		$hasLoan = Convert::raw2sql($this->request->getVar('HasLoan'));		
        if($hasLoan!='all'){
            $list = $list->filter(array(
                'Loan.HasLoan' => $hasLoan
            ));
        }
        return $list;
    }*/
	
	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
	
	
	public function LoanSearchForm(){
		$form = new LoanSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search Loan');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
	}

	
}
