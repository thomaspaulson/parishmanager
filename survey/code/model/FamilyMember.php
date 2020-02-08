<?php
//
class FamilyMember extends DataObject{

	private static $db = array(
		'Name' => 'varchar(255)',
		'DateOfBirth' => 'Date',
		'Age' => 'Int',
		'DateOfMarriage' => 'Date',
		'Gender' => 'varchar(2)',
		'MartialStatus' => 'varchar(2)',
		'Relation' => "Enum('Guardian, Father, Mother, Son, Daughter, Wife, Husband, Brother, Sister, Inlaw, Grandfather, Grandmother, Grandson, Granddaughter,Others')",
		'HoldsPassport' => 'Boolean',
		'HoldsBankAccount' => 'Boolean',
		'HoldsDrivingLicence' => 'Boolean',
		'BloodGroup' => "Enum('NA,O +,O -,A +,A -,B +,B -,AB +,AB -')"
	);

    private static $has_one = array(
        'Family' => 'Family',
		'Parish' => 'Parish'
    );

	private static $belongs_to = array(
		'Health' => 'Health.FamilyMember',
		'Job' => 'Job.FamilyMember',
		'Achievement' => 'Achievement.FamilyMember',
	);
	
	private static $has_many = array(
		'Educations' => 'Education'
	);

	private static $belongs_many_many = array(
		"CommunityGroups" => "CommunityGroup",
	);

	private static $default_sort = 'ID ASC';

	private static $field_labels = array(
		'DateOfBirth' => 'DateOfBirth',
		'Sex' => 'Gender', // renames the column to "Gender"
		'MStatus' => 'Martial Status'
	);

	private static $summary_fields = array(
		'ID',
		'Name',
		'DateOfBirth',
		'Sex',
		'MStatus'
	);

   private static $searchable_fields = array(
      'Name',
      'DateOfBirth',	  	
   );
	
	
	public function Sex(){
		if($this->Gender == 'm')
			return 'Male';
		else
			return 'Female';
	}

	//return MartialStatus ie 'Married/Single/...'
	public function MStatus(){
		switch($this->MartialStatus){
			case 'm':
				return 'Married';
				break;

			case 's':
				return 'Single';
				break;

			case 'w':
				return 'Widow/Widower';
				break;

			case 'd':
				return 'Divorced';
				break;

			case 'c':
				return 'Child';
				break;

		}

	}

	public function Age(){
		if($this->DateOfBirth){
			$from = new DateTime($this->DateOfBirth);
			$to   = new DateTime('today');
			return  $from->diff($to)->y;
		}
		else{
			return $this->Age;
		}
	}

	
    public function HasOrNot($Title = null){		
        if($this->$Title && $Title)
            return 'Yes';
        else
            return 'No';
    }
	
    
	public function Link($action = null, $BackURL = null ){
		$controller = new FamilyMemberController();
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
		$controller = new FamilyMemberController();
		$url = $controller->Link();
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
	
	
	public function Relatives(){
		$list = FamilyMember::get();
		$list = $list->Filter(array(
					'FamilyID' => $this->FamilyID
				));
		$list = $list->exclude(array(
				'ID' => $this->ID
				)); //echo $list->sql();
		return $list;
	}
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();

		if($this->ID){
			Session::set("FamilyMemberID", $this->ID);
		}

		if(Session::get("FamilyID") && !$this->ID){
			$this->FamilyID = Session::get("FamilyID");
			$this->ParishID = Session::get("ParishID");			
		}		
		
		$fields->replaceField('FamilyID', new HiddenField('FamilyID'));
		$fields->replaceField('ParishID', new HiddenField('ParishID'));			
		$dateOfBirth = new DateField('DateOfBirth','Date Of Birth');
		$dateOfBirth->setConfig('dateformat', 'dd-MM-yyyy');
		$dateOfBirth->setDescription('e.g. '.date('d-m-Y'));
		$dateOfBirth->setAttribute('placeholder','dd-MM-yyyy');
		$fields->addFieldsToTab('Root.Main', $dateOfBirth);

		$genders = Config::inst()->get('FamilyMember', 'Gender');
		$gender = new OptionsetField("Gender", 'Gender', $genders );
		$fields->addFieldsToTab('Root.Main', $gender);

		$status = Config::inst()->get('FamilyMember', 'MartialStatus');
		$martialStatus = new OptionsetField("MartialStatus", 'Martial Status', $status );
		$fields->addFieldsToTab('Root.Main', $martialStatus);
		

		$fields->insertBefore(new Tab('Job', 'Job'), 'CommunityGroups');
		//Job GridField
		$jobGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$jobList = Job::get()->filter(array(
			'FamilyMemberID' => $this->ID
		))->sort('ID ASC');
		if($jobList->count()){
			$jobGridFieldConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$jobGridField = new GridField('Job', 'Job',
			$jobList,
			$jobGridFieldConfig);
		$fields->addFieldsToTab('Root.Job', array(
						$jobGridField
					));


		$fields->insertBefore(new Tab('Health', 'Health'), 'CommunityGroups');
		//Health GridField
		$healthGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$healthList = Health::get()->filter(array(
			'FamilyMemberID' => $this->ID
		))->sort('ID ASC');
		if($healthList->count()){
			$healthGridFieldConfig->removeComponentsByType('GridFieldAddNewButton');
		}
		$healthGridField = new GridField('Health', 'Health',
			$healthList,
			$healthGridFieldConfig);
		$fields->addFieldsToTab('Root.Health', array(
			$healthGridField
		));


		//Job GridField
		/*
		$communityGroupsCongfig = GridFieldConfig_RelationEditor::create();
		//$jobGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$communityGroupsList = $this->CommunityGroups();
		$communityGroupsGridField = new GridField('CommunityGroups', 'Community Groups',
			$communityGroupsList,
			$communityGroupsCongfig);
		$fields->addFieldsToTab('Root.CommunityGroups', array(
			$communityGroupsGridField
		));
		*/

		//CommunityGroups ListboxField
		$communityGroupsList = CommunityGroup::get()->map('ID','Title')->toArray();
		$communityGroupsField = new ListboxField(
			$name = "CommunityGroups",
			$title = "Communtiy Groups",
			$communityGroupsList
			);
		$communityGroupsField->setMultiple(true);
		$fields->addFieldsToTab('Root.CommunityGroups', $communityGroupsField);

		//exit('dd');
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
