<?php
class CommunityGroup_FamilyMembers extends DataObject{
    private static $db = array(    
    );	
    
    private static $has_one = array(
    'CommunityGroup' => 'CommunityGroup',
    'FamilyMember' => 'FamilyMember'    
    );
    
}
