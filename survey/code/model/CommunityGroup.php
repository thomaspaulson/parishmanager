<?php
//
class CommunityGroup extends DataObject  implements PermissionProvider{
	
	private static $db = array(
		'Title' => 'varchar(255)',
		'SortOrder' => 'Int'
	);

	private static $many_many = array(
		"FamilyMembers" => "FamilyMember",
	);

	private static $default_sort = 'ID DESC';

	private static $summary_fields = array(
		'ID',
		'Title',
	);

	private static $searchable_fields = array(
		'Title',
	);

	function canView($member = null) {
		return Permission::check('CommunityGroup_VIEW');
	}
	function canEdit($member = null) {
		//return true;
		return Permission::check('CommunityGroup_EDIT');
	}
	function canDelete($member = null) {
		//return true;
		return Permission::check('CommunityGroup_DELETE');
	}
	function canCreate($member = null) {
		return Permission::check('CommunityGroup_CREATE');
	}

	function providePermissions() {
		return array(
			'CommunityGroup_VIEW' => 'Read an community group object',
			'CommunityGroup_EDIT' => 'Edit an community group object',
			'CommunityGroup_DELETE' => 'Delete an community group object',
			'CommunityGroup_CREATE' => 'Create an community group object',
		);
	}
}