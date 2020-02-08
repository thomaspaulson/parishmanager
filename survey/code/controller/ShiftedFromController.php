<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 2:08 PM
 */
class ShiftedFromController extends SiteController
{

    public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_shifted_from',
    		'AddShiftedFromForm',
    		'edit_shifted_from',
    		'EditShiftedFromForm',
			'export_to_csv'    		
    );
	
	protected $list;

    public function init(){
        parent::init();
		$this->title = "Shifted Form";
    }

    public function index() {
        return $this->renderWith(array('ShiftedFrom', 'App'));
    }


    public function add_shifted_from(){
    
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Shifted-From";
    	$form = $this->AddShiftedFromForm();
    
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
    
    
    public function AddShiftedFromForm(){
    	$form = new AddShiftedFromForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_shifted_from(){
    
    	$this->title = "Edit Shifted-Form";
    	$form = $this->EditShiftedFromForm();
    	$form->setTemplate('AddShiftedFromForm');
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$shiftedForm = ShiftedFrom::get()->byID($id);
    	if(!$shiftedForm){
    		return $this->httpError(404,'Page not found');
    	}
    	if($shiftedForm->exists() && $form){
    		$form->loadDataFrom($shiftedForm);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditShiftedFromForm(){
    	$form = new EditShiftedFromForm($this, __FUNCTION__);
    	return $form;
    }
    
    
    public function search() {
		$this->title = "Search Shifted From ";
		$this->list = $this->Results();
        return $this->renderWith(array('ShiftedFrom_results', 'App'));
    }

    public function printlist() {				
		$this->title = "Shifted-Form list";
        return $this->renderWith(array('ShiftedFrom_printresults', 'Print'));
    }

	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "shiftedfrom.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address',
						'Contact Person','Contact',
						'Block','Unit',
						'Family','HouseNo',
						'Shifted', 'From', 'Reason'); 
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {
			$shifted = $list->Status ? 'Yes': 'No';			
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo,
 						   $list->FamilyNo, $list->HouseNo,
						   $shifted, $list->FromWhere, $list->Reason						   
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
            return Controller::join_links(Director::baseURL(), 'shifted-from', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'shifted-from');
        }
    }

    public function Results(){

		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');
		$sqlQuery->addLeftJoin('ShiftedFrom','"Family"."ID" = "ShiftedFrom"."FamilyID"');	

        $status = Convert::raw2sql($this->request->getVar('Status'));        
        
        if($status!=''){
			$sqlQuery->addWhere("ShiftedFrom.Status = $status");
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

        $list = Family::get()->leftJoin('ShiftedFrom','"Family"."ID" = "ShiftedFrom"."FamilyID"');

        $status = Convert::raw2sql($this->request->getVar('Status'));
        $area = Convert::raw2sql($this->request->getVar('Area'));
        
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
        
        if($status!=''){
            $list = $list->filter(array(
                'ShiftedFrom.Status' => $status
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

    public function ShiftedFromSearchForm(){
        $form = new ShiftedFromSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search Shifted-from');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
    }

}
