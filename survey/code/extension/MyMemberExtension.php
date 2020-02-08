<?php
//
class MyMemberExtension extends DataExtension
{
	
	private static $many_many = array(
		'Parishes' => 'Parish'
		);

	public function updateCMSFields(FieldList $fields)
	{
		$fields->removebyName('Parishes');
		$parishes = Parish::get()->map('ID','NameWithLocation','')->toArray();
		$parishField = ListboxField::create('Parishes', 'Parishes', $parishes)
			->setMultiple(true)
			->setDescription('Assign/unassign member to parish');
		$fields->addFieldToTab('Root.Main',$parishField,'DateFormat');
	}
	
	public function canEditParish($parish = null){
		
		if($this->owner->inGroup('Administrators')){
			return true;
		}
		
		if($this->owner->inGroup('Managers')){
			return true;
		}

		if($this->owner->inGroup('Priests') && $this->isMemberOf($this->owner, $parish->ID)){
			return true;
		}
		
		return false;		
	}
	
	
	protected function isMemberOf($member, $parish_id){
		$parishes = $member->Parishes();
		
		if(!$parishes->exists()){
			return false;
		}
		
		if($parishes instanceof ManyManyList) {
			return in_array($parish_id, $parishes->getIDList());
		}
		
		return $parishes->byID($parish_id) !== null;
		
	}
}
