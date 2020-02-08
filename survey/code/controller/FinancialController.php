<?php
class FinancialController extends SiteController{
    #code
    public static $allowed_actions = array(
        'index'
    );
	


    public function init(){
        parent::init();
		$this->title = "Financial details";
    }

    public function index() {
        return $this->renderWith(array('Financial', 'App'));
    }
    
    public function Title() {
        return $this->title;
    }

	public function LoanSearchForm(){
		$controller = new LoanController();
		return $controller->LoanSearchForm();
	}

	public function SavingSearchForm(){
		$controller = new SavingController();
		return $controller->SavingSearchForm();
	}
	
}
