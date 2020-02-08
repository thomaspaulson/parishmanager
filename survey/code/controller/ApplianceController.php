<?php
//
class ApplianceController extends SiteController{
	#code
	
	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_appliance',
    		'AddApplianceForm',
    		'edit_appliance',
    		'EditApplianceForm',
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
		$this->title = 'Appliance';
	}

	/**
	 * render agriculture index page
	 * @return string
	 */	
	public function index(){
		$this->title = 'Appliance';		
		return $this->renderWith(array('Vehicles','App'));
	}


    public function add_appliance(){
		    
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Appliance";
    	$form = $this->AddApplianceForm();
    
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
    
    
    public function AddApplianceForm(){
    	$form = new AddApplianceForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_appliance(){
    
    	$this->title = "Edit Appliance";
    	$form = $this->EditApplianceForm();
    	$form->setTemplate('AddApplianceForm');
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$appliance = Appliance::get()->byID($id);
    	if(!$appliance){
    		return $this->httpError(404,'Page not found');
    	}
    	if($appliance->exists() && $form){
    		$form->loadDataFrom($appliance);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditApplianceForm(){
    	$form = new EditApplianceForm($this, __FUNCTION__);
    	return $form;
    }
	


	public function search(){				
		$this->title = 'Search Appliance';
		$this->list = $this->Results();
		return $this->renderWith(array('Appliance_results','App'));
	}

	public function printlist(){
		$this->title = 'Appliance list';		
		return $this->renderWith(array('Appliance_printresults','Print'));
	}
	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "appliance.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address',
						'Contact Person','Contact',
						'Block','Unit',
						'Family','HouseNo',
						'WashingMachine', 'AirConditioner',
						'MicrowaveOven', 'CookingGas',
						'Fridge', 'Others', '[specify]'						
					   );
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {
			$washingMachine = $list->WashingMachine ? 'Yes': 'No';
			$airConditioner = $list->AirConditioner ? 'Yes': 'No';			
			$microwaveOven = $list->MicrowaveOven? 'Yes': 'No';
			$cookingGas = $list->CookingGas? 'Yes': 'No';
			$fridge = $list->Fridge? 'Yes': 'No';
			$others = $list->Others? 'Yes': 'No';
			
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo,
 						   $list->FamilyNo, $list->HouseNo,
						   $washingMachine, $airConditioner,
						   $microwaveOven, $cookingGas,
						   $fridge, $others,  $list->Specify						   
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
            return Controller::join_links(Director::baseURL(), 'appliance', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'appliance');
        }
    }
	
    public function Results(){

		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');
		$sqlQuery->addLeftJoin('Appliance','"Family"."ID" = "Appliance"."FamilyID"');	
	
		
        //$computer = Convert::raw2sql($this->request->getVar('Computer'));
		$washingMachine = Convert::raw2sql($this->request->getVar('WashingMachine'));
		$airConditioner = Convert::raw2sql($this->request->getVar('AirConditioner'));
        $microwaveOven = Convert::raw2sql($this->request->getVar('MicrowaveOven'));		
		$cookingGas = Convert::raw2sql($this->request->getVar('CookingGas'));
		$fridge = Convert::raw2sql($this->request->getVar('Fridge'));
        $others = Convert::raw2sql($this->request->getVar('Others'));
		
		
        if($washingMachine!='all'){
			$sqlQuery->addWhere("Appliance.WashingMachine = $washingMachine");
        }
		
        if($airConditioner!='all'){
			$sqlQuery->addWhere("Appliance.AirConditioner = $airConditioner");
        }
		
        if($microwaveOven!='all'){
			$sqlQuery->addWhere("Appliance.MicrowaveOven = $microwaveOven");
        }
		
        if($cookingGas!='all'){
			$sqlQuery->addWhere("Appliance.CookingGas = $cookingGas");
        }
		
        if($fridge!='all'){
			$sqlQuery->addWhere("Appliance.Fridge = $fridge");
        }

        if($others!='all'){
			$sqlQuery->addWhere("Appliance.Others = $others");
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

        $list = Family::get()->leftJoin('Appliance','"Family"."ID" = "Appliance"."FamilyID"');		
		
        //$computer = Convert::raw2sql($this->request->getVar('Computer'));
		$washingMachine = Convert::raw2sql($this->request->getVar('WashingMachine'));
		$airConditioner = Convert::raw2sql($this->request->getVar('AirConditioner'));
        $microwaveOven = Convert::raw2sql($this->request->getVar('MicrowaveOven'));		
		$cookingGas = Convert::raw2sql($this->request->getVar('CookingGas'));
		$fridge = Convert::raw2sql($this->request->getVar('Fridge'));
        $others = Convert::raw2sql($this->request->getVar('Others'));
		
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
        
		
        if($washingMachine!='all'){
            $list = $list->filter(array(
                'Appliance.WashingMachine' => $washingMachine
            ));
        }
		
        if($airConditioner!='all'){
            $list = $list->filter(array(
                'Appliance.AirConditioner' => $airConditioner
            ));
        }
		
        if($microwaveOven!='all'){
            $list = $list->filter(array(
                'Appliance.MicrowaveOven' => $microwaveOven
            ));
        }
		
        if($cookingGas!='all'){
            $list = $list->filter(array(
                'Appliance.CookingGas' => $cookingGas
            ));
        }
		
        if($fridge!='all'){
            $list = $list->filter(array(
                'Appliance.Fridge' => $fridge
            ));
        }

        if($others!='all'){
            $list = $list->filter(array(
                'Appliance.Others' => $others
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
	
	
	public function ApplianceSearchForm(){
		$form = new ApplianceSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search Appliance');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
	}


}
