<?php
//
class MonthlyExpenseController extends SiteController{
	#code
	
	#code	
	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_monthly_expense',
    		'AddMonthlyExpenseForm',
    		'edit_monthly_expense',
    		'EditMonthlyExpenseForm',
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
		$this->title = 'Monthly-Expense';
	}

	/**
	 * render agriculture index page
	 * @return string
	 */	
	public function index(){
		$this->title = 'Monthly-Expense';		
		return $this->renderWith(array('MonthlyExpense','App'));
	}

    public function add_monthly_expense(){
		    
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Monthly-Expense";
    	$form = $this->AddMonthlyExpenseForm();
    
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
    
    
    public function AddMonthlyExpenseForm(){
    	$form = new AddMonthlyExpenseForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_monthly_expense(){
    
    	$this->title = "Edit Monthly-Expense";
    	$form = $this->EditMonthlyExpenseForm();
    	$form->setTemplate('AddMonthlyExpenseForm');
    	
    	$id = (int)$this->request->param('ID');
    	$monthlyExpense = MonthlyExpense::get()->byID($id);
    	if(!$monthlyExpense){
    		return $this->httpError(404,'Page not found');
    	}
    	if($monthlyExpense->exists() && $form){
    		$form->loadDataFrom($monthlyExpense);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditMonthlyExpenseForm(){
    	$form = new EditMonthlyExpenseForm($this, __FUNCTION__);
    	return $form;
    }

	public function search(){
		$this->title = 'Search Monthly-Expense';
		$this->list = $this->Results();
		return $this->renderWith(array('MonthlyExpense_results','App'));
	}

	public function printlist(){
		
		$this->title = 'Monthly-Expense list';		
		return $this->renderWith(array('MonthlyExpense_printresults','Print'));
	}
	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "monthlyexpense.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address',
						'Contact Person','Contact',
						'Block','Unit',
						'Family','HouseNo',
						'Education','Medical',
						'Others','Total Expense'
					   );
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {			
			
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo,
 						   $list->FamilyNo, $list->HouseNo,
						   $list->Education, $list->Medical,
						   $list->Others, $list->Total
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
            return Controller::join_links(Director::baseURL(), 'monthlyexpense', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'monthlyexpense');
        }
    }


    public function Results(){

		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');
		$sqlQuery->addLeftJoin('MonthlyExpense','"Family"."ID" = "MonthlyExpense"."FamilyID"');	

        $amountForm = Convert::raw2sql($this->request->getVar('AmountForm'));
        if($amountForm){
			$sqlQuery->addWhere("MonthlyExpense.Total >= $amountForm");
        }

		$amountUpto = Convert::raw2sql($this->request->getVar('AmountUpto'));		
        if($amountUpto){
			$sqlQuery->addWhere("MonthlyExpense.Total <= $amountUpto");			
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

	
        $list = Family::get()->leftJoin('MonthlyExpense','"Family"."ID" = "MonthlyExpense"."FamilyID"');
		
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			

		
        $amountForm = Convert::raw2sql($this->request->getVar('AmountForm'));
        if($amountForm){			
            $list = $list->where(
				     'MonthlyExpense.Total >= '. $amountForm
					);			
        }

		$amountUpto = Convert::raw2sql($this->request->getVar('AmountUpto'));		
        if($amountUpto){
            $list = $list->where(
                 'MonthlyExpense.Total <= '. $amountUpto
		            );			
        }		
		//echo $list->sql();			
        return $list;
    }*/

	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
		
	public function MonthlyExpenseSearchForm(){
		$form = new MonthlyExpenseSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->Link('search'));
        $form->setLegend('Search Monthly-Expense');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
	}


}
