<?php
class MonthlyController extends SiteController{
    #code
    public static $allowed_actions = array(
        'index'
    );
	


    public function init(){
        parent::init();
		$this->title = "Monthly";
    }

    public function index() {
        return $this->renderWith(array('Monthly', 'App'));
    }
    
    public function Title() {
        return $this->title;
    }

	public function MonthlyIncomeSearchForm(){
		$controller = new MonthlyIncomeController();
		$form = $controller->MonthlyIncomeSearchForm();
        return $form;
	}
	
	public function MonthlyExpenseSearchForm(){
		$controller = new MonthlyExpenseController();
		$form = $controller->MonthlyExpenseSearchForm();
        return $form;
	}
    
}
