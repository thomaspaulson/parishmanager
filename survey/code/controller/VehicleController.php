<?php
//
class VehicleController extends SiteController{
	#code
	
	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_vehicle',
    		'AddVehicleForm',
    		'edit_vehicle',
    		'EditVehicleForm',
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
		$this->title = 'Vehicle';
	}

	/**
	 * render agriculture index page
	 * @return string
	 */	
	public function index(){
		$this->title = 'Vehicle';		
		return $this->renderWith(array('Vehicle','App'));
	}

    public function add_vehicle(){
		    
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Vehicle";
    	$form = $this->AddVehicleForm();
    
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
    
    
    public function AddVehicleForm(){
    	$form = new AddVehicleForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_vehicle(){
    
    	$this->title = "Edit Vehicle";
    	$form = $this->EditVehicleForm();
    	$form->setTemplate('AddVehicleForm');
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$vehicle = Vehicle::get()->byID($id);
    	if(!$vehicle){
    		return $this->httpError(404,'Page not found');
    	}
    	if($vehicle->exists() && $form){
    		$form->loadDataFrom($vehicle);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditVehicleForm(){
    	$form = new EditVehicleForm($this, __FUNCTION__);
    	return $form;
    }
	

	public function search(){
		
		$this->title = 'Search Vehicle';
		$this->list = $this->Results();
		return $this->renderWith(array('Vehicle_results','App'));
	}

	public function printlist(){
		
		$this->title = 'Vehicle list';		
		return $this->renderWith(array('Vehicle_printresults','Print'));
	}

	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "vehicle.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address',
						'Contact Person','Contact',
						'Block','Unit',
						'Family','HouseNo',
						'Cycle', 'Bike',
						'Autoriskaw', 'LightVehicle',
						'HeavyCommercial', 'CountryBoat',
						'Vallam', 'FishingBoat', 'TouristBoat',
						'Others', '[specify]'
					   );
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {
			$Cycle = $list->Cycle ? 'Yes': 'No';
			$Bike = $list->Bike ? 'Yes': 'No';			
			$Autoriskaw = $list->Autoriskaw? 'Yes': 'No';
			$LightVehicle = $list->LightVehicle? 'Yes': 'No';
			$HeavyCommercial = $list->HeavyCommercial? 'Yes': 'No';
			$CountryBoat = $list->CountryBoat? 'Yes': 'No';
			$Vallam = $list->Vallam? 'Yes': 'No';
			$FishingBoat = $list->FishingBoat? 'Yes': 'No';
			$TouristBoat = $list->TouristBoat? 'Yes': 'No';
			$Others = $list->Others? 'Yes': 'No';
			
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo,
 						   $list->FamilyNo, $list->HouseNo,
						   $Cycle, $Bike,
						   $Autoriskaw, $LightVehicle,
						   $HeavyCommercial, $CountryBoat, 
						   $Vallam,  $FishingBoat, $TouristBoat,
						   $Others,  $list->Specify
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
            return Controller::join_links(Director::baseURL(), 'vehicle', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'vehicle');
        }
    }
	
    public function Results(){

		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');
		$sqlQuery->addLeftJoin('Vehicle','"Family"."ID" = "Vehicle"."FamilyID"');	
		
        $cycle = Convert::raw2sql($this->request->getVar('Cycle'));
		$bike = Convert::raw2sql($this->request->getVar('Bike'));
		$autoriskaw = Convert::raw2sql($this->request->getVar('Autoriskaw'));
        $lightVehicle = Convert::raw2sql($this->request->getVar('LightVehicle'));		
		$heavyCommercial = Convert::raw2sql($this->request->getVar('HeavyCommercial'));
		$countryBoat = Convert::raw2sql($this->request->getVar('CountryBoat'));
        $vallam = Convert::raw2sql($this->request->getVar('Vallam'));
		$fishingBoat = Convert::raw2sql($this->request->getVar('FishingBoat'));
		$touristBoat = Convert::raw2sql($this->request->getVar('TouristBoat'));		
		

        if($cycle!='all'){
			$sqlQuery->addWhere("Vehicle.Cycle = $cycle");
        }
        if($bike!='all'){
			$sqlQuery->addWhere("Vehicle.Bike = $bike");			
        }
        if($autoriskaw!='all'){
			$sqlQuery->addWhere("Vehicle.Autoriskaw = $autoriskaw");
        }
        if($lightVehicle!='all'){
			$sqlQuery->addWhere("Vehicle.LightVehicle = $lightVehicle");
        }
        if($heavyCommercial!='all'){
			$sqlQuery->addWhere("Vehicle.HeavyCommercial = $heavyCommercial");
        }
        if($countryBoat!='all'){
			$sqlQuery->addWhere("Vehicle.CountryBoat = $countryBoat");
        }
        if($vallam!='all'){
			$sqlQuery->addWhere("Vehicle.Vallam = $vallam");
        }
        if($fishingBoat!='all'){
			$sqlQuery->addWhere("Vehicle.FishingBoat = $fishingBoat");
        }
        if($touristBoat!='all'){
			$sqlQuery->addWhere("Vehicle.TouristBoat = $touristBoat");
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

        $list = Family::get()->leftJoin('Vehicle','"Family"."ID" = "Vehicle"."FamilyID"');
		
        $cycle = Convert::raw2sql($this->request->getVar('Cycle'));
		$bike = Convert::raw2sql($this->request->getVar('Bike'));
		$autoriskaw = Convert::raw2sql($this->request->getVar('Autoriskaw'));
        $lightVehicle = Convert::raw2sql($this->request->getVar('LightVehicle'));		
		$heavyCommercial = Convert::raw2sql($this->request->getVar('HeavyCommercial'));
		$countryBoat = Convert::raw2sql($this->request->getVar('CountryBoat'));
        $vallam = Convert::raw2sql($this->request->getVar('Vallam'));
		$fishingBoat = Convert::raw2sql($this->request->getVar('FishingBoat'));
		$touristBoat = Convert::raw2sql($this->request->getVar('TouristBoat'));		
		
		
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
        

        if($cycle!='all'){
            $list = $list->filter(array(
                'Vehicle.Cycle' => $cycle
            ));
        }
        if($bike!='all'){
            $list = $list->filter(array(
                'Vehicle.Bike' => $bike
            ));
        }
        if($autoriskaw!='all'){
            $list = $list->filter(array(
                'Vehicle.Autoriskaw' => $autoriskaw
            ));
        }
        if($lightVehicle!='all'){
            $list = $list->filter(array(
                'Vehicle.LightVehicle' => $lightVehicle
            ));
        }
        if($heavyCommercial!='all'){
            $list = $list->filter(array(
                'Vehicle.HeavyCommercial' => $heavyCommercial
            ));
        }
        if($countryBoat!='all'){
            $list = $list->filter(array(
                'Vehicle.CountryBoat' => $countryBoat
            ));
        }
        if($vallam!='all'){
            $list = $list->filter(array(
                'Vehicle.Vallam' => $vallam
            ));
        }
        if($fishingBoat!='all'){
            $list = $list->filter(array(
                'Vehicle.FishingBoat' => $fishingBoat
            ));
        }
        if($touristBoat!='all'){
            $list = $list->filter(array(
                'Vehicle.TouristBoat' => $touristBoat
            ));
        }


        return $list;
    }*/
	
	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
	
	
	public function VehicleSearchForm(){
		$form = new VehicleSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search Vehicle');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
	}

	
}
