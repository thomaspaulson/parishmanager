<?php
class OtherDetailsController extends SiteController{
    #code
    public static $allowed_actions = array(
        'index'
    );
	


    public function init(){
        parent::init();
		$this->title = "Other details";
    }

    public function index() {
        return $this->renderWith(array('OtherDetails', 'App'));
    }
    
    public function Title() {
        return $this->title;
    }

   	public function VehicleSearchForm(){
		$controller = new VehicleController();
		$form = $controller->VehicleSearchForm();
        return $form;
	}
	

   	public function ApplianceSearchForm(){
		$controller = new ApplianceController();
		$form = $controller->ApplianceSearchForm();
        return $form;
	}


	public function OtherFacilitySearchForm	(){
		$controller = new OtherFacilityController();
		$form = $controller->OtherFacilitySearchForm();
        return $form;
	}
	
	public function MediaSearchForm(){
		$controller = new MediaController();
		$form = $controller->MediaSearchForm();
        return $form;
	}

	public function CatholicMagazineSearchForm(){
		$controller = new CatholicMagazineController();
		$form = $controller->CatholicMagazineSearchForm();
        return $form;
	}
	
}
