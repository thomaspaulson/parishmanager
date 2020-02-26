<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 2:08 PM
 */
class HomeController extends SiteController
{

    public static $url_handlers = array(
        'parish-search' => 'parish_search',
    );


    public static $allowed_actions = array(
        'index','parish_search'
    );

    public function init(){
        parent::init();
		$this->title = "Home";
    }

    public function index() {
        return $this->renderWith(array('Home', 'App'));
    }

	
    public function Title() {
        return $this->title;
    }

    public function Link() {
        return Director::baseURL();
    }

	public function Families(){
		$list =  Family::get();
		
		$myparish = $this->MyParish();
        $list = $list->Filter(array('ParishID' => $myparish->ID ));
        
		return $list;
	}
	
	public function FamilyMembers(){
		$list =  FamilyMember::get();
		
		$myparish = $this->MyParish();
		$list = $list->Filter(array('ParishID' => $myparish->ID ));
				
		return $list;
	}
	
	
}