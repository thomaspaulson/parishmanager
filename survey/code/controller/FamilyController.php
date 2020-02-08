<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 2:08 PM
 */
class FamilyController extends SiteController
{

    public static $allowed_actions = array(
        'index',
		'search_by_parish',
		'search_by_location',
		'print_by_parish',
		'print_by_location',
		'show',
		'print_family',
		'listall',
		'getlist',
		'list_records',
		'add_family',
		'AddFamilyForm',
		'edit_family',
		'EditFamilyForm',
		'view',
		'delete_family',
		'export_to_csv',
    );


	/**
	 * The current Family DataList .
	 *
	 * @var DataList
	 */	
	protected $list;
	
    public function init(){
        parent::init();
		$this->title = 'Family';
    }

    public function index() {
        return $this->renderWith(array('Family', 'App'));
    }

    public function listall(){
		
		$parish = $this->MyParish();//echo($parish->ID);			
		if(!$this->canAccess($parish->ID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}		
		
		$this->title = 'Listing family';
		$this->list = $this->Results();		
		
        return $this->renderWith(array('Family_listall', 'Angular'));
    }

	public function getlist(){
		
		$family = Family::get();
		
		$jsonDataFormatter = new JSONDataFormatter();
                   
        $response = $this->getResponse()->addHeader('Content-type', 'application/json; charset=utf-8');

		$JSON = $jsonDataFormatter->convertDataObjectSet($family);
   
        $response->setBody($JSON);

        return $response;
		
	}

    public function list_records() {
		
		$parish = $this->MyParish();//echo($parish->ID);			
		if(!$this->canAccess($parish->ID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}
		
		
		$this->title = 'Listing family';
		$this->list = $this->Results();		
		
        return $this->renderWith(array('Family_listrecords', 'App'));
    }
	
	
	public function add_family(){
		$this->title = "Add Family";
		$form = $this->AddFamilyForm();
		
		$backURL = urldecode($this->getRequest()->getVar('BackURL'));
		$redirectURL = $form->Fields()->fieldByName('RedirectURL');
		$redirectURL->setValue($backURL);
		
		$myparish = $this->MyParish();
		$parishID = $form->Fields()->fieldByName('ParishID');
		$parishID->setValue($myparish->ID);
		
		
		$data = array(
				'Form' => $form 
				);
		return $this->customise($data)->renderWith(array('Family_form', 'App'));			
	}
	
	
	public function AddFamilyForm(){							
		$form = new AddFamilyForm($this, __FUNCTION__);				
		return $form;
		
	}
	
	public function view(){
		// show Unathorised page with user does not have access other parish
		$familyID = Convert::raw2sql($this->request->param('ID'));		
		$family = Family::get()->byID($familyID);		
		if(!$family){
			return $this->httpError('404','Page not found');
		}
		$this->title = 'Family details';
		$data = array('Family' => $family);
		if($this->request->isAjax()){
			return $this->customise($data )
				->renderWith(array('Family_view'));
		}
		else{
			return $this->customise($data )
				->renderWith(array('Family_view','App'));			
		}
	}
	
	public function edit_family(){
		
		$this->title = "Edit family";
		$form = $this->EditFamilyForm();
		$form->setTemplate('AddFamilyForm');
		$id = (int)$this->request->param('ID');
		//var_dump($_POST);EXIT();
		$family = Family::get()->byID($id);
		if(!$family){
			 return $this->httpError(404,'Page not found');
		}
		
		$parishID = $family->ParishID;
		if(!$this->canAccess($parishID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}
		
		if($family->exists() && $form){			
			$form->loadDataFrom($family);			
		}
		
		$backURL = urldecode($this->getRequest()->getVar('BackURL'));
		$redirectURL = $form->Fields()->fieldByName('RedirectURL');
		$redirectURL->setValue($backURL);
		
		//check whether user belongs to myparish
		//$myParish = $this->MyParish();	
		//$inParish = $family->Parishes()->filter(array('ID' => $myParish->ID))->First();
		//if(!$inParish){
		//	return $this->renderWith(array('Unathorised_access', 'App'));
		//}
		
		$data = array(
				'Form' => $form
				);
		return $this->customise($data)->renderWith(array('Family_form', 'App'));	
		
	}
	
	
	public function EditFamilyForm(){							
		$form = new EditFamilyForm($this, __FUNCTION__);				
		return $form;		
	}
	
	public function delete_family(){
		
		$this->title = "Delete family";	
		$id = (int)$this->request->param('ID');
		//var_dump($_POST);EXIT();
		$family = Family::get()->byID($id);

		if(!$family){
			 return $this->httpError(404,'Page not found');
		}		

		if($family->exists()){
			$family->destroy();
			$family->delete();
			$backURL = urldecode($this->getRequest()->getVar('BackURL'));//exit($backURL );
			return $this->redirect($backURL.'&message=deleted');
			//return $this->redirect($this->Link($backURL.'&message=deleted'));			
		}		
		
	}
	
    public function search_by_parish() {
		// show Unathorised page with user does not have access other parish		
		/*$parishID = Convert::raw2sql($this->request->getVar('ParishID'));		
		if(!$this->canAccess($parishID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}*/
		
		$this->title = 'Search by parish';
		$this->list = $this->Results();	
		return $this->renderWith(array('Family_parishresults', 'App'));
    }

    public function search_by_location() {
		// show Unathorised page with user does not have access other parish
		/*$parishID = Convert::raw2sql($this->request->getVar('ParishID'));		
		if(!$this->canAccess($parishID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}*/
		
		$this->title = 'Search by location';
		$this->list = $this->Results();	
        return $this->renderWith(array('Family_locationresults', 'App'));
    }

	public function print_by_parish() {		
		$this->title = 'Family list';
        return $this->renderWith(array('Family_printparishresults', 'Print'));
    }

    public function print_by_location() {		
		$this->title = 'Family list';
        return $this->renderWith(array('Family_printlocationresults', 'Print'));
    }

	public function show(){
		// show Unathorised page with user does not have access other parish
		$familyID = Convert::raw2sql($this->request->param('ID'));		
		$family = Family::get()->byID($familyID);		
		if(!$family){
			return $this->httpError('404','Page not found');
		}
		$this->title = 'Show Family details';
		$data = array('Family' => $family);
		if($this->request->isAjax()){
			return $this->customise($data )
				->renderWith(array('Family_show'));
		}
		else{
			return $this->customise($data )
				->renderWith(array('Family_show','App'));			
		}
	}
	

	public function print_family(){
		// show Unathorised page with user does not have access other parish
		$familyID = Convert::raw2sql($this->request->param('ID'));		
		$family = Family::get()->byID($familyID);		
		if(!$family){
			return $this->httpError('404','Page not found');
		}
		$this->title = 'Print Family details';
		$data = array('Family' => $family);
        return $this->customise($data )
			->renderWith(array('Family_print','Print'));		
	}		
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "family.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address','Contact Person','Contact','Block','Unit', 'Family','HouseNo'); 
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
				
		foreach($this->list as $list) {
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo, $list->FamilyNo,
						   $list->HouseNo
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
            return Controller::join_links(Director::baseURL(), 'family', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'family');
        }
    }
    
    public function Results(){
        
		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');

		$name = Convert::raw2sql($this->request->getVar('Name'));
        $blockNo = Convert::raw2sql($this->request->getVar('BlockNo'));
        $unitNo = Convert::raw2sql($this->request->getVar('UnitNo'));
        $parishID = Convert::raw2sql($this->request->getVar('ParishID'));
        $pincode = Convert::raw2sql($this->request->getVar('Pincode'));
        $isPanchayat = Convert::raw2sql($this->request->getVar('IsPanchayat'));
        $isMunicipality = Convert::raw2sql($this->request->getVar('IsMunicipality'));
        $isCorporation = Convert::raw2sql($this->request->getVar('IsCorporation'));

		
		$myparish = $this->MyParish();
		$sqlQuery->addWhere("Family.ParishID = $myparish->ID");
		
		
		if($name) {		
			$sqlQuery->addWhere("Family.Name LIKE '%$name%'");
		}
		
        if($blockNo){
			$sqlQuery->addWhere("Family.BlockNo = $blockNo");
        }

        if($unitNo){
			$sqlQuery->addWhere("Family.UnitNo = $unitNo");			
        }

        if($pincode){
			$sqlQuery->addWhere("Family.Pincode LIKE '%$pincode%'");			
        }

        if($isPanchayat){
			$sqlQuery->addWhere("Family.IsPanchayat = $isPanchayat");						
        }

        if($isMunicipality){
			$sqlQuery->addWhere("Family.IsMunicipality = $isMunicipality");									
        }
        
        if($isCorporation){
			$sqlQuery->addWhere("Family.IsCorporation = $isCorporation");												
        }
        
		
		$sqlQuery->setOrderBy('Family.ID DESC');
		$result = $sqlQuery->execute();
		//echo $sqlQuery->sql();
		// Iterate over results
		$arrList = new ArrayList();
		$count = $result->numRecords();
		//echo 'SELECT COUNT(*) FROM "Family" where ParishID = '.$myparish->ID;
		$counter = 0;
		foreach($result as $row) {			
			$row['Counter'] = $count--;
			//$row['Counter'] = ++$counter;
			$arrList->add($row); 
		}
		
		return $arrList;
		
    }

	/*
    public function Results(){

        $list = Family::get();		
		//$list = Family::get()->leftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');

		$name = Convert::raw2sql($this->request->getVar('Name'));
        $blockNo = Convert::raw2sql($this->request->getVar('BlockNo'));
        $unitNo = Convert::raw2sql($this->request->getVar('UnitNo'));
        $parishID = Convert::raw2sql($this->request->getVar('ParishID'));
        $pincode = Convert::raw2sql($this->request->getVar('Pincode'));
        $isPanchayat = Convert::raw2sql($this->request->getVar('IsPanchayat'));
        $isMunicipality = Convert::raw2sql($this->request->getVar('IsMunicipality'));
        $isCorporation = Convert::raw2sql($this->request->getVar('IsCorporation'));

		
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
		
		
		
		if($name) {		
			//echo $date.'<br />';					
			$list = $list->filter(array(
				'Name:PartialMatch' => $name             
			));
		}
		
        if($blockNo){
            $list = $list->filter(array(
                'BlockNo' => $blockNo
            ));
        }

        if($unitNo){
            $list = $list->filter(array(
                'UnitNo' => $unitNo
            ));
        }

        if($pincode){
            $list = $list->filter(array(
                'Pincode' => $pincode
            ));
        }

        if($isPanchayat){
            $list = $list->filter(array(
                'IsPanchayat' => $isPanchayat
            ));
        }

        if($isMunicipality){
            $list = $list->filter(array(
                'IsMunicipality' => $isMunicipality
            ));
        }
        
        if($isCorporation){
            $list = $list->filter(array(
                'IsCorporation' => $isCorporation
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
	
	
    public function FamilySearchForm(){
        $form = new FamilySearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('list-records'));
        $form->setLegend('Search');
        $form->loadDataFrom($this->request->getVars());
        $form->disableSecurityToken();
        return $form;
    }
	
    public function ParishSearchForm(){
        $form = new ParishSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search-by-parish'));
        $form->setLegend('Based on parish');
        $form->loadDataFrom($this->request->getVars());
        $form->disableSecurityToken();
        return $form;
    }

    public function LocationSearchForm(){
        $form = new LocationSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search-by-location'));
        $form->setLegend('Based on location');
        $form->loadDataFrom($this->request->getVars());
        $form->disableSecurityToken();
        return $form;
    }


    public function HouseSearchForm(){
        $controller = new HouseController();
        $form = $controller->HouseSearchForm();
        return $form;
    }


    public function LandSearchForm(){
        $controller = new LandController();
        $form = $controller->LandSearchForm();
        return $form;
    }

    public function ShiftedFromSearchForm(){
        $controller = new ShiftedFromController();
        $form = $controller->ShiftedFromSearchForm();
        return $form;
    }


    public function AgricultureSearchForm(){
        $controller = new AgricultureController();
        $form = $controller->AgricultureSearchForm();
        return $form;
    }
	
	public function BusinessSearchForm(){
		$controller = new BusinessController();
		$form = $controller->BusinessSearchForm();
        return $form;
	}

	public function MonthlyIncomeSearchForm(){
		$controller = new MonthlyIncomeController();
		$form = $controller->MonthlyIncomeSearchForm();
        return $form;
	}
	
	public function MonthlyExpenseSearchForm(){
		$controller = new MonthlyExpenseController();
		$form = $controller->MonthlyExpenseSearchForm();
        return $form;
	}
	
	public function VehicleSearchForm(){
		$controller = new VehicleController();
		$form = $controller->VehicleSearchForm();
        return $form;
	}
	
	public function ApplianceSearchForm(){
		$controller = new ApplianceController();
		$form = $controller->ApplianceSearchForm();
        return $form;
	}
	
	public function OtherFacilitySearchForm(){
		$controller = new OtherFacilityController();
		$form = $controller->OtherFacilitySearchForm();
        return $form;
	}
	
	public function MediaSearchForm(){
		$controller = new MediaController();
		$form = $controller->MediaSearchForm();
        return $form;
	}

	public function CatholicMagazineSearchForm(){
		$controller = new CatholicMagazineController();
		$form = $controller->CatholicMagazineSearchForm();
        return $form;
	}
	
	public function LoanSearchForm(){
		$controller = new LoanController();
		return $controller->LoanSearchForm();
	}

	public function SavingSearchForm(){
		$controller = new SavingController();
		return $controller->SavingSearchForm();
	}
	
}
