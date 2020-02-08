<?php
//
class Parish extends DataObject implements PermissionProvider{

    /**
     * @config
     */
    private static $my_parish;
	
	private static $db = array(
		'Title' => 'varchar(255)',
		'Location' => 'varchar(100)',
		'Address' => 'varchar(255)',
		'Landline' => 'varchar(50)'
	);
	
    private static $has_many = array(
        'Families' => 'Family'
    );

	private static $belongs_many_many = array(
		'Members' => 'Member'
	);

	private static $summary_fields = array(
		'Title',
		'Address',
	);

	public function NameWithLocation(){
		return ucwords(strtolower($this->Title)).', '.$this->Location;
	}

	function canView($member = null) {
		return Permission::check('PARISH_VIEW');
	}
	function canEdit($member = null) {
		return Permission::check('PARISH_EDIT');
	}
	function canDelete($member = null) {
		return Permission::check('PARISH_DELETE');
	}
	function canCreate($member = null) {
		return Permission::check('PARISH_CREATE');
	}

	function providePermissions() {
		return array(
			'PARISH_VIEW' => 'Read an parish object',
			'PARISH_EDIT' => 'Edit an parish object',
			'PARISH_DELETE' => 'Delete an parish object',
			'PARISH_CREATE' => 'Create an parish object',
		);
	}
}
