<?php
class OccupationController extends SiteController{
    #code
    public static $allowed_actions = array(
        'index'
    );
	


    public function init(){
        parent::init();
		$this->title = "Occupation";
    }

    public function index() {
        return $this->renderWith(array('Occupation', 'App'));
    }
    
    public function Title() {
        return $this->title;
    }

	public function AgricultureSearchForm(){
		$controller = new AgricultureController();
		$form = $controller->AgricultureSearchForm();
        return $form;
	}
    
	public function BusinessSearchForm(){
		$controller = new BusinessController();
		$form = $controller->BusinessSearchForm();
        return $form;
	}
    
    
}
