<?php
class HousingController extends SiteController{
    #code
    public static $allowed_actions = array(
        'index','search','printlist'
    );
	


    public function init(){
        parent::init();
		$this->title = "Housing";
    }

    public function index() {
        return $this->renderWith(array('Housing', 'App'));
    }
    
    public function Title() {
        return $this->title;
    }
    
    public function HouseSearchForm(){
        $controller = new HouseController();
        $form = $controller->HouseSearchForm();
        return $form;
    }

    
    public function LandSearchForm(){
        $controller = new LandController();
        $form = $controller->LandSearchForm();
        return $form;
    }

    public function ShiftedFromSearchForm(){
        $controller = new ShiftedFromController();
        $form = $controller->ShiftedFromSearchForm();
        return $form;
    }
    
    
}
