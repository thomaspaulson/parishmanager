<?php
//
class ParishAdmin extends ModelAdmin{
	
    private static $managed_models = array(
        'Family',
		'FamilyMember',
		'Parish',
		'CommunityGroup'
    );
	
	private static $url_segment = 'parishes';		
	private static $menu_title = 'My Parish';
	
    // ...
    public function getEditForm($id = null, $fields = null) {
        $form = parent::getEditForm($id, $fields);
		$model = singleton($this->modelClass);
		
        // $gridFieldName is generated from the ModelClass, eg if the Class 'Product'
        // is managed by this ModelAdmin, the GridField for it will also be named 'Product'

		if($this->modelClass == 'FamilyMember'){
			$gridFieldName = $this->sanitiseClassName($this->modelClass);
			$gridField = $form->Fields()->fieldByName($gridFieldName);

			// remove GridFieldAddNewButton if modelClass == 'FamilyMember'
			$gridField->getConfig()->removeComponentsByType('GridFieldAddNewButton');
		}

		
		/** add sorting if we have a field for... */
		if (class_exists('GridFieldSortableRows')
			&& $model->hasField('SortOrder')
			&& $gridField=$form->Fields()->dataFieldByName($this->sanitiseClassName($this->modelClass))) {
			if($gridField instanceof GridField) {
				$gridField->getConfig()->addComponent(new GridFieldSortableRows('SortOrder'));
			}
		}
			
		
        return $form;
    }
	
    public function getList() {
        $list = parent::getList();

        // Always limit by model class, in case you're managing multiple
        if($this->modelClass == 'Family') {
			$member = Member::currentUser();
			$parishes = $member->Parishes(); 
			if($parishes->exists()){
				$parishArray =  $parishes->getIDList();
				$list = $list->filter(array('ParishID'=>$parishArray));
			}			            
			//Debug::show($list->sql());
        }

        if($this->modelClass == 'FamilyMember') {
			$member = Member::currentUser();
			$parishes = $member->Parishes(); 
			if($parishes->exists()){
				$parishArray =  $parishes->getIDList();
				$list = $list->filter(array('ParishID'=>$parishArray));
			}			            
			//Debug::show($list->sql());
        }
		
        return $list;
    }	
}