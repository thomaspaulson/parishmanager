<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 2:08 PM
 */
class LandController extends SiteController
{

    public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_land',
    		'AddLandForm',
    		'edit_land',
    		'EditLandForm',
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
		$this->title = "Land";
    }

    public function index() {
        return $this->renderWith(array('Land', 'App'));
    }
    

    public function add_land(){
    
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add land";
    	$form = $this->AddLandForm();
    
    	$familyID = $form->Fields()->fieldByName('FamilyID');
    	$familyID->setValue($family->ID);
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    	$data = array(
    			'Form' => $form
    	);
    
    	return $this->customise($data)->renderWith(array('Land_form', 'App'));
    }
    
    
    public function AddLandForm(){
    	$form = new AddLandForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_land(){
    
    	$this->title = "Edit land";
    	$form = $this->EditLandForm();
    	$form->setTemplate('AddLandForm');
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$land = Land::get()->byID($id);
    	if(!$land){
    		return $this->httpError(404,'Page not found');
    	}
    	if($land->exists() && $form){
    		$form->loadDataFrom($land);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Land_form', 'App'));
    
    }
    
    
    public function EditLandForm(){
    	$form = new EditLandForm($this, __FUNCTION__);
    	return $form;
    }
    

    public function search() {
		// show Unathorised page with user does not have access other parish
		/*$parishID = Convert::raw2sql($this->request->getVar('ParishID'));		
		if(!$this->canAccess($parishID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}*/
		
		$this->title = "Search land ";
		$this->list = $this->Results();	
        return $this->renderWith(array('Land_results', 'App'));
    }

    public function printlist() {
		// show Unathorised page with user does not have access other parish
		$parishID = Convert::raw2sql($this->request->getVar('ParishID'));		
		if(!$this->canAccess($parishID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}
		
		$this->title = "Land list";
        return $this->renderWith(array('Land_printresults', 'Print'));
    }

	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "land.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address',
						'Contact Person','Contact',
						'Block','Unit',
						'Family','HouseNo',
						'Holds Land', 'Area'); 
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {
			$holdsLand = $list->HoldsLand? 'Yes': 'No';			
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo,
 						   $list->FamilyNo, $list->HouseNo,
						   $holdsLand, $list->Area
						   
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
            return Controller::join_links(Director::baseURL(), 'land', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'land');
        }
    }
	

    public function Results(){

		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');
		$sqlQuery->addLeftJoin('Land','"Family"."ID" = "Land"."FamilyID"');	


        $holdsLand = Convert::raw2sql($this->request->getVar('HoldsLand'));
        $area = Convert::raw2sql($this->request->getVar('Area'));        
        
        
		$myparish = $this->MyParish();
		$sqlQuery->addWhere("Family.ParishID = $myparish->ID");


        if($holdsLand!=''){
			$sqlQuery->addWhere("Land.HoldsLand = $holdsLand");
        }

        if($holdsLand && $area){
			$sqlQuery->addWhere("Land.Area = '$area'");			
        }		

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

        $list = Family::get()->leftJoin('Land','"Family"."ID" = "Land"."FamilyID"');

        $holdsLand = Convert::raw2sql($this->request->getVar('HoldsLand'));
        $area = Convert::raw2sql($this->request->getVar('Area'));
        
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
        

        if($holdsLand!=''){
            $list = $list->filter(array(
                'Land.HoldsLand' => $holdsLand
            ));
        }

        if($holdsLand && $area){
            $list = $list->filter(array(
                'Land.Area' => $area
            ));
        }


        return $list;
    }
	*/
	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
	

    public function LandSearchForm(){
        $form = new LandSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->Link('search'));
        $form->setLegend('Search Land');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
    }
}
