<?php
//
class Family extends DataObject
{

	private static $db = array(
		'Name' => 'varchar(255)',
		'Address' => 'varchar(255)',
		'Pincode' => 'varchar(10)',
		'HouseNo' => 'varchar(255)',
		'IsPanchayat' => 'Boolean',
		'IsMunicipality' => 'Boolean',
		'IsCorporation' => 'Boolean',
		'BlockNo' => 'Int',
		'UnitNo' => 'Int',
		'UnitName' => 'varchar(255)',
		'FamilyNo' => 'Int',
		'ContactNo' => 'varchar(255)',
		'Email' => 'varchar(255)',
		'Aadhaar' => 'varchar(255)'
	);

	private static $has_one = array(
		'Parish' => 'Parish'
	);

	private static $has_many = array(
		'FamilyMembers' => 'FamilyMember'
	);

    private static $belongs_to = array(
        'Contact' => 'Contact.Family',
		'House' => 'House.Family',
		'Land' => 'Land.Family',
		'ShiftedFrom' => 'ShiftedFrom.Family',
		'Agriculture' => 'Agriculture.Family',
		'Business' => 'Business.Family',
		'MonthlyIncome' => 'MonthlyIncome.Family',
		'MonthlyExpense' => 'MonthlyExpense.Family',
		'Vehicle' => 'Vehicle.Family',
		'Appliance' => 'Appliance.Family',
		'OtherFacility' => 'OtherFacility.Family',
		'Media' => 'Media.Family',
		'CatholicMagazine' => 'CatholicMagazine.Family',
		'Loan' => 'Loan.Family',
		'Saving' => 'Saving.Family',
    );	
	private static $default_sort = 'ID DESC';

	/*
	private static $defaults = array(
		'BlockNo' => null,
		'UnitNo' => null,
		'FamilyNo' => null
	);
	*/

	private static $summary_fields = array(
		'ID',
		'Name',
		'Address',
		'UnitNo',
		'FamilyNo',
		'ParishName'
	);

    private static $searchable_fields = array(
    	'Name',
      	'UnitNo',
		'FamilyNo',
	  	'ParishID'
   	);

	public function InPanchayat(){
		return ($this->IsPanchayat)?'Yes':'No';
	}

	public function InMunicipality(){
		return ($this->IsMunicipality)?'Yes':'No';
	}
	
	public function InCorporation(){
		return ($this->IsCorporation)?'Yes':'No';
	}
	
	public function ParishName(){
		return ($this->ParishID)?$this->Parish()->NameWithLocation():'';
	}
	
	public function Link($action = null, $BackURL = null ){		
		$controller = new FamilyController();
		$url = $controller->Link();
		if($BackURL){
			return Controller::join_links(
				$url,
				$action.'/'.$this->ID,
				'?RedirectURL=' . urlencode($BackURL)			
				);
		}
		else{
			return Controller::join_links(
				$url,
				$action.'/'.$this->ID
				);			
		}		
		
		/*
		if($BackURL){
			return Controller::join_links(
				$url,
				'show/'.$this->ID,
				'?RedirectURL=' . urlencode($BackURL)			
				);
		}
		else{
			return Controller::join_links(
				$url,
				'show/'.$this->ID
				);			
		}
		*/
	}
	


	public function scaffoldSearchFields($_params = null){
		$fields = parent::scaffoldSearchFields();
		//$fields->removeByName('ID');
		//$fields->removeByName('Address');
		//$fields->removeByName('Address');
		//$fields->removeByName('Address');		
		
		$member = Member::currentUser();
		$parishes = $member->Parishes(); 		
		if($parishes->exists()){
			$parishArray = $parishes->map('ID', 'NameWithLocation')->toArray();
		}
		else{
			$parishArray = Parish::get()->map('ID', 'NameWithLocation')->toArray();
		}
		
		$parishField = DropdownField::create('ParishID', 'Parish')
			->setSource($parishArray);
			
		$parishField->setEmptyString('select...');
		//$fields->push($parishField);
		$fields->replaceField('ParishID',$parishField);
		return $fields;
	}


	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		if($this->ID){
			Session::set("FamilyID", $this->ID);
			Session::set("ParishID", $this->ParishID);
		}

		$nameField = TextField::create('Name','Family Name');
		$fields->replaceField('Name', $nameField);

		$houseNoField = TextField::create('HouseNo','House No (govt)');
		$fields->replaceField('HouseNo', $houseNoField);
		
		$member = Member::currentUser();
		$parishes = $member->Parishes(); 
		
		if($parishes->exists()){
			$parishArray = $parishes->map('ID', 'NameWithLocation')->toArray();
		}
		else{
			$parishArray = Parish::get()->map('ID', 'NameWithLocation')->toArray();
		}
		
		$parishField = DropdownField::create('ParishID', 'Parish')
			->setSource($parishArray);
		$parishField->setEmptyString('select...');		
		$fields->replaceField('ParishID', $parishField);
		
		

		//remove FamilyMembers tab
		$fields->removeByName('FamilyMembers');

		$memberGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$familyMemberList = FamilyMember::get()->filter(array(
					'FamilyID' => $this->ID
				))->sort('ID ASC');
		$familyMemberGridField = new GridField('Members', 'Family members',
			$familyMemberList,
			$memberGridFieldConfig);
		$fields->addFieldsToTab('Root.Members', array(
			$familyMemberGridField
		));


		//house gridfield
		$houseGridFeildConfig = GridFieldConfig_RecordEditor::create();
		$houseList = House::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($houseList->count()){
			$houseGridFeildConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$houseGridField = new GridField('House', 'House',
			$houseList,
			$houseGridFeildConfig);
		$fields->addFieldsToTab('Root.Housing', array(
			$houseGridField
		));


		//land gridfield
		$landGridFeildConfig = GridFieldConfig_RecordEditor::create();
		$landList = Land::get()->filter(array(
					'FamilyID' => $this->ID
					))->sort('ID ASC');
		// remove add button if record already exists
		if($landList->count()){
			$landGridFeildConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$landGridField = new GridField('Land', 'Land',
			$landList,
			$landGridFeildConfig);
		$fields->addFieldsToTab('Root.Housing', array(
			$landGridField
		));


		//ShiftedFrom gridfield
		$shiftedFromGridFeildConfig = GridFieldConfig_RecordEditor::create();
		$shiftedFromList = ShiftedFrom::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($shiftedFromList->count()){
			$shiftedFromGridFeildConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$shiftedFromGridField = new GridField('Shifted', 'Shifted',
			$shiftedFromList,
			$shiftedFromGridFeildConfig);
		$fields->addFieldsToTab('Root.Housing', array(
			$shiftedFromGridField
		));


		//Agriculture gridfield
		$agricultureGridFeildConfig = GridFieldConfig_RecordEditor::create();
		$agricultureList = Agriculture::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($agricultureList->count()){
			$agricultureGridFeildConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$agricultureGridField = new GridField('Agriculture', 'Agriculture',
			$agricultureList,
			$agricultureGridFeildConfig);
		$fields->addFieldsToTab('Root.Occupation', array(
			$agricultureGridField
		));


		//Business gridfield
		$businessGridFeildConfig = GridFieldConfig_RecordEditor::create();
		$businessList = Business::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($businessList->count()){
			$businessGridFeildConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$businessGridField = new GridField('Business', 'Business',
			$businessList,
			$businessGridFeildConfig);
		$fields->addFieldsToTab('Root.Occupation', array(
			$businessGridField
		));

		//MonthlyIncome gridfield
		$monthlyIncomeGridFeildConfig = GridFieldConfig_RecordEditor::create();
		$monthlyIncomeList = MonthlyIncome::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($monthlyIncomeList->count()){
			$monthlyIncomeGridFeildConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$monthlyIncomeGridField = new GridField('MonthlyIncome', 'MonthlyIncome',
			$monthlyIncomeList,
			$monthlyIncomeGridFeildConfig);
		$fields->addFieldsToTab('Root.Monthly', array(
			$monthlyIncomeGridField
		));


		//MonthlyExpense gridfield
		$monthlyExpenseGridFeildConfig = GridFieldConfig_RecordEditor::create();
		$monthlyExpenseList = MonthlyExpense::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($monthlyExpenseList->count()){
			$monthlyExpenseGridFeildConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$monthlyExpenseGridField = new GridField('MonthlyExpense', 'MonthlyExpense',
			$monthlyExpenseList,
			$monthlyExpenseGridFeildConfig);
		$fields->addFieldsToTab('Root.Monthly', array(
			$monthlyExpenseGridField
		));


		//Vehicle gridfield
		$vehicleGridFeildConfig = GridFieldConfig_RecordEditor::create();
		$vehicleList = Vehicle::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($vehicleList->count()){
			$vehicleGridFeildConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$vehicleGridField = new GridField('Vehicle', 'Vehicle',
			$vehicleList,
			$vehicleGridFeildConfig);
		$fields->addFieldsToTab('Root.OtherDetails', array(
			$vehicleGridField
		));


		//Appliance gridfield
		$applianceGridFeildConfig = GridFieldConfig_RecordEditor::create();
		$applianceList = Appliance::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($applianceList->count()){
			$applianceGridFeildConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$applianceGridField = new GridField('Appliance', 'Appliance',
			$applianceList,
			$applianceGridFeildConfig);
		$fields->addFieldsToTab('Root.OtherDetails', array(
			$applianceGridField
		));


		//OtherFacility gridfield
		$otherFacilityGridFeildConfig = GridFieldConfig_RecordEditor::create();
		$otherFacilityList = OtherFacility::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($otherFacilityList->count()){
			$otherFacilityGridFeildConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$otherFacilityGridField = new GridField('OtherFacility', 'Other Facility',
			$otherFacilityList,
			$otherFacilityGridFeildConfig);
		$fields->addFieldsToTab('Root.OtherDetails', array(
			$otherFacilityGridField
		));


		//Media gridfield
		$mediaGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$mediaList = Media::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($mediaList->count()){
			$mediaGridFieldConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$mediaGridField = new GridField('Media', 'Media',
			$mediaList,
			$mediaGridFieldConfig);
		$fields->addFieldsToTab('Root.OtherDetails', array(
			$mediaGridField
		));

		//CatholicMagazine gridfield
		$catholicMagazineGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$catholicMagazineList = CatholicMagazine::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($catholicMagazineList->count()){
			$catholicMagazineGridFieldConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$catholicMagazineGridField = new GridField('CatholicMagazine', 'Catholic Magazine',
			$catholicMagazineList,
			$catholicMagazineGridFieldConfig);
		$fields->addFieldsToTab('Root.OtherDetails', array(
			$catholicMagazineGridField
		));


		//Loan gridfield
		$loanGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$loanList = Loan::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($loanList->count()){
			$loanGridFieldConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$loanGridField = new GridField('Loan', 'Loan',
			$loanList,
			$loanGridFieldConfig);
		$fields->addFieldsToTab('Root.Financial', array(
			$loanGridField
		));

		//Saving gridfield
		$savingGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$savingList = Saving::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($savingList->count()){
			$savingGridFieldConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$savingGridField = new GridField('Saving', 'Saving',
			$savingList,
			$savingGridFieldConfig);
		$fields->addFieldsToTab('Root.Financial', array(
			$savingGridField
		));



		//Talent gridfield
		$talentGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$talentList = Talent::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($talentList->count()){
			$talentGridFieldConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$talentGridField = new GridField('Talent', 'Talent',
			$talentList,
			$talentGridFieldConfig);
		$fields->addFieldsToTab('Root.Members', array(
			$talentGridField
		));


		//Contact gridfield
		$contactGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$contactList = Contact::get()->filter(array(
			'FamilyID' => $this->ID
		))->sort('ID ASC');
		// remove add button if record already exists
		if($contactList->count()){
			$contactGridFieldConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$contactGridField = new GridField('Contact', 'Contact',
			$contactList,
			$contactGridFieldConfig);
		$fields->addFieldsToTab('Root.Contact', array(
			$contactGridField
		));

		return $fields;
	}

	function canView($member = null) {
		return true;
	}
	function canEdit($member = null) {
		return true;
	}
	function canDelete($member = null) {
		return true;
	}
	function canCreate($member = null) {
		return true;
	}

}
