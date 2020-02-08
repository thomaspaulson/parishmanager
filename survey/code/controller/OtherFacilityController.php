<?php
//
class OtherFacilityController extends SiteController{
	#code
	
	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_otherfacility',
    		'AddOtherFacilityForm',
    		'edit_otherfacility',
    		'EditOtherFacilityForm',
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
		$this->title = 'Other Facility';
	}

	/**
	 * render agriculture index page
	 * @return string
	 */	
	public function index(){
		$this->title = 'Other Facility';		
		return $this->renderWith(array('OtherFacility','App'));
	}
	
    public function add_otherfacility(){
		    
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Other-Facility";
    	$form = $this->AddOtherFacilityForm();
    
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
    
    
    public function AddOtherFacilityForm(){
    	$form = new AddOtherFacilityForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_otherfacility(){
    
    	$this->title = "Edit Other-Facility";
    	$form = $this->EditOtherFacilityForm();
    	$form->setTemplate('AddOtherFacilityForm');
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$otherFacility = OtherFacility::get()->byID($id);
    	if(!$otherFacility){
    		return $this->httpError(404,'Page not found');
    	}
    	if($otherFacility->exists() && $form){
    		$form->loadDataFrom($otherFacility);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditOtherFacilityForm(){
    	$form = new EditOtherFacilityForm($this, __FUNCTION__);
    	return $form;
    }
	

	

	public function search(){	
		
		$this->title = 'Search Other Facility';
		$this->list = $this->Results();
		return $this->renderWith(array('OtherFacility_results','App'));
	}

	public function printlist(){
		
		$this->title = 'Other Facility list';		
		return $this->renderWith(array('OtherFacility_printresults','Print'));
	}
	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "otherfacility.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address',
						'Contact Person','Contact',
						'Block','Unit',
						'Family','HouseNo',
						'WaterWell', 'DrillWell',
						'WaterConnection', 'RainwaterStorage',
						'Biogas', 'Electricity', 'SolarEnergy'						
					   );
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {
			$waterWell = $list->WaterWell ? 'Yes': 'No';
			$drillWell = $list->DrillWell ? 'Yes': 'No';			
			$waterConnection = $list->WaterConnection? 'Yes': 'No';
			$rainwaterStorage = $list->RainwaterStorage? 'Yes': 'No';
			$biogas = $list->Biogas? 'Yes': 'No';
			$electricity = $list->Electricity? 'Yes': 'No';
			$solarEnergy = $list->SolarEnergy? 'Yes': 'No';
			
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo,
 						   $list->FamilyNo, $list->HouseNo,
						   $waterWell, $drillWell,
						   $waterConnection, $rainwaterStorage,
						   $biogas, $electricity,  $solarEnergy						   
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
            return Controller::join_links(Director::baseURL(), 'otherfacility', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'otherfacility');
        }
    }

    public function Results(){

		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');
		$sqlQuery->addLeftJoin('OtherFacility','"Family"."ID" = "OtherFacility"."FamilyID"');	
	
        
		$waterWell = Convert::raw2sql($this->request->getVar('WaterWell'));
        if($waterWell!='all'){
			$sqlQuery->addWhere("OtherFacility.WaterWell = $waterWell");
        }
		
		$drillWell = Convert::raw2sql($this->request->getVar('DrillWell'));		
        if($drillWell!='all'){
			$sqlQuery->addWhere("OtherFacility.DrillWell = $drillWell");
        }
		
		$waterConnection = Convert::raw2sql($this->request->getVar('WaterConnection'));
        if($waterConnection!='all'){
			$sqlQuery->addWhere("OtherFacility.WaterConnection = $waterConnection");
        }
		
        $rainwaterStorage = Convert::raw2sql($this->request->getVar('RainwaterStorage'));		
        if($rainwaterStorage!='all'){
			$sqlQuery->addWhere("OtherFacility.RainwaterStorage = $rainwaterStorage");
        }
		
		$biogas = Convert::raw2sql($this->request->getVar('Biogas'));
        if($biogas!='all'){
			$sqlQuery->addWhere("OtherFacility.Biogas = $biogas");
        }
		
		$electricity = Convert::raw2sql($this->request->getVar('Electricity'));
        if($electricity!='all'){
			$sqlQuery->addWhere("OtherFacility.Electricity = $electricity");
        }
		
        $solarEnergy = Convert::raw2sql($this->request->getVar('SolarEnergy'));
        if($solarEnergy!='all'){
			$sqlQuery->addWhere("OtherFacility.SolarEnergy = $solarEnergy");
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

        $list = Family::get()->leftJoin('OtherFacility','"Family"."ID" = "OtherFacility"."FamilyID"');
		
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
        
		$waterWell = Convert::raw2sql($this->request->getVar('WaterWell'));
        if($waterWell!='all'){
            $list = $list->filter(array(
                'OtherFacility.WaterWell' => $waterWell
            ));
        }
		
		$drillWell = Convert::raw2sql($this->request->getVar('DrillWell'));		
        if($drillWell!='all'){
            $list = $list->filter(array(
                'OtherFacility.DrillWell' => $drillWell
            ));
        }
		
		$waterConnection = Convert::raw2sql($this->request->getVar('WaterConnection'));
        if($waterConnection!='all'){
            $list = $list->filter(array(
                'OtherFacility.WaterConnection' => $waterConnection
            ));
        }
		
        $rainwaterStorage = Convert::raw2sql($this->request->getVar('RainwaterStorage'));		
        if($rainwaterStorage!='all'){
            $list = $list->filter(array(
                'OtherFacility.RainwaterStorage' => $rainwaterStorage
            ));
        }
		
		$biogas = Convert::raw2sql($this->request->getVar('Biogas'));
        if($biogas!='all'){
            $list = $list->filter(array(
                'OtherFacility.Biogas' => $biogas
            ));
        }
		
		$electricity = Convert::raw2sql($this->request->getVar('Electricity'));
        if($electricity!='all'){
            $list = $list->filter(array(
                'OtherFacility.Electricity' => $electricity
            ));
        }
		
        $solarEnergy = Convert::raw2sql($this->request->getVar('SolarEnergy'));
        if($solarEnergy!='all'){
            $list = $list->filter(array(
                'OtherFacility.SolarEnergy' => $solarEnergy
            ));
        }

		$vegetableGarden = Convert::raw2sql($this->request->getVar('VegetableGarden'));		
        if($vegetableGarden!='all'){
            $list = $list->filter(array(
                'OtherFacility.VegetableGarden' => $vegetableGarden
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
	
	
	public function OtherFacilitySearchForm(){
		$form = new OtherFacilitySearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search Other-Facility');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
	}

}
