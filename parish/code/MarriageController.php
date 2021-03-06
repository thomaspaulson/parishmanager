<?php
//
class MarriageController extends SiteController {

    public static $allowed_actions = array(
        'index', 'add', 'AddMarriageForm', 'edit', 'EditMarriageForm', 'view', 'delete', 'doprint'
    );    

    protected $list;
    
    public function init(){
        $this->title = 'Marriage certificate';
        parent::init();
    }

    public function index()
    {
    	$this->list = $this->getAllMarriageCertificates();				
        return $this->renderWith(array('Marriage', 'App'));
    }    

    	
    public function add(){
        $this->title = "Add marriage";
        $form = $this->AddMarriageForm();
        
        $backURL = urldecode($this->getRequest()->getVar('BackURL'));
        $redirectURL = $form->Fields()->fieldByName('RedirectURL');
        $redirectURL->setValue($backURL);

		$myparish = $this->MyParish();
		$parishID = $form->Fields()->fieldByName('ParishID');
		$parishID->setValue($myparish->ID);

        
        //	if($form->Fields()->fieldByName('Date')){
        //          $dateField = $form->Fields()->fieldByName('Date');
        //          $dateField->setValue(date('d-m-Y'));
        //      }        
        
        $data = array('Form' => $form);
        return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    }
    
    public function AddMarriageForm(){
    	$form = new AddMarriageForm($this, __FUNCTION__);		
    	return $form;
    }
    
    public function edit(){
        $id = (int)$this->request->param('ID');

        $marriageCertificate = MarriageCertificate::get()->byID($id);
        if(!$marriageCertificate){
            return $this->httpError('404','Page not found');	
        }

        $this->title = 'Edit  / <small>'. $marriageCertificate->GroomName.'</small>';


		$parishID = $marriageCertificate->ParishID;
		if(!$this->canAccess($parishID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}


        $form = $this->EditMarriageForm();

        $form->setTemplate('AddMarriageForm');

        if($marriageCertificate->exists() && $form){
            $form->loadDataFrom($marriageCertificate);
        }

        if($marriageCertificate->GroomDOB){
            $groomDOB = $form->Fields()->fieldByName('GroomDOB');
            $groomDOB->setValue(date('d-m-Y',strtotime($marriageCertificate->GroomDOB)));
        }	

        if($marriageCertificate->GroomBaptisedAt){
            $groomBaptisedAt = $form->Fields()->fieldByName('GroomBaptisedAt');
            $groomBaptisedAt->setValue(date('d-m-Y',strtotime($marriageCertificate->GroomBaptisedAt)));
        }

        if($marriageCertificate->BrideDOB){
            $brideDOB = $form->Fields()->fieldByName('BrideDOB');
            $brideDOB->setValue(date('d-m-Y',strtotime($marriageCertificate->BrideDOB)));
        }	

        if($marriageCertificate->BrideBaptisedAt){
            $brideBaptisedAt = $form->Fields()->fieldByName('BrideBaptisedAt');
            $brideBaptisedAt->setValue(date('d-m-Y',strtotime($marriageCertificate->BrideBaptisedAt)));
        }

        
        if($marriageCertificate->DOMarriage){
            $marriageDate = $form->Fields()->fieldByName('DOMarriage');
            $marriageDate->setValue(date('d-m-Y',strtotime($marriageCertificate->DOMarriage)));
        }

        if($marriageCertificate->Date){
                $date = $form->Fields()->fieldByName('Date');
                $date->setValue(date('d-m-Y',strtotime($marriageCertificate->Date)));
        }
        
        $backURL = urldecode($this->getRequest()->getVar('BackURL'));
        $redirectURL = $form->Fields()->fieldByName('RedirectURL');
        $redirectURL->setValue($backURL);

        $data = array('Form' => $form);
        return $this->customise($data)->renderWith(array('Generic_form', 'App'));
		
    }
    
    public function EditMarriageForm(){
    	$form = new EditMarriageForm($this, __FUNCTION__);		
    	return $form;    
    }


    public function view(){
        $id = (int)$this->request->param('ID');
        $marriageCertificate = MarriageCertificate::get()->byID($id);

        if(!$marriageCertificate){
            return $this->httpError('404','Page not found');	
        }

        $this->title = $marriageCertificate->GroomName.' / <small> Marriage certificate</small>';
    	$data = array('MarriageCertificate' => $marriageCertificate);
    	if($this->request->isAjax()){
            return $this->customise($data )
                ->renderWith(array('Marriage_view'));
    	}
    	else{
            return $this->customise($data )
            ->renderWith(array('Marriage_view','App'));
    	}        

    }    


    public function delete(){
        $id = (int)$this->request->param('ID');
        $marriageCertificate = MarriageCertificate::get()->byID($id);
        if(!$marriageCertificate){
            return $this->httpError('404','Page not found');	
        }		

        $marriageCertificate->Deleted = 1;
    	$marriageCertificate->write();

	    $backURL = urldecode($this->getRequest()->getVar('BackURL'));//exit($backURL );
        if($backURL){
            return $this->redirect($backURL.'&message=deleted');
        }
        	return $this->redirect($this->Link().'?message=deleted');
    }    
    

    public function SearchForm(){
        $form = new MarriageSearchForm($this, __FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link());

        $form->setLegend('Search');
        $form->loadDataFrom($this->request->getVars());
        $form->disableSecurityToken();		
        return $form;		 

    }

	
    public function doprint(){		
        //
        $id = (int)$this->request->param('ID');
        $marriageCertificate = MarriageCertificate::get()->byID($id);

        if(!$marriageCertificate){
            return $this->httpError('404','Page not found');	
        }

        $this->title = 'Marriage certificate';
        $data = array('MarriageCertificate' => $marriageCertificate);
        return $this->customise($data )
		->renderWith(array('Marriage_print','Print'));	        
    }        
    

    public function getAllMarriageCertificates(){
        $sqlQuery = new SQLQuery();
        $sqlQuery->setFrom('MarriageCertificate');		

        $groomName = Convert::raw2sql($this->request->getVar('GroomName'));
        $brideName = Convert::raw2sql($this->request->getVar('BrideName'));
        $blockNo = Convert::raw2sql($this->request->getVar('DOB'));

        if($groomName) {		
            $sqlQuery->addWhere("MarriageCertificate.GroomName LIKE '%$groomName%'");
        }

        if($brideName) {		
            $sqlQuery->addWhere("MarriageCertificate.BrideName LIKE '%$brideName%'");
        }
        
        if($dateOfMarriage = Convert::raw2sql($this->request->getVar('DateOfMarriage'))) {	
            $date = date('Y-m-d', strtotime($dateOfMarriage));
            $sqlQuery->addWhere("MarriageCertificate.DateOfMarriage = '$date'");
        }
        
        $sqlQuery->addWhere("MarriageCertificate.Deleted != '1'");
        
		$myparish = $this->MyParish();
		$sqlQuery->addWhere("MarriageCertificate.ParishID = $myparish->ID");		

        $sqlQuery->setOrderBy('MarriageCertificate.ID DESC');
        
        $result = $sqlQuery->execute();
        //echo $sqlQuery->sql();
        $arrList = new ArrayList();
        $count = $result->numRecords();
        $counter = 0;
        foreach($result as $row) {			
            $row['Counter'] = $count--;
            $arrList->add($row); 
        }		
        return $arrList;
    }

    public function PaginatedList(){
        $list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
        return $list;
    }	

    public function MetaTitle() {
        return $this->title;
    }
    
    public function RecentBrith($numRecords = 3){
        $list = MarriageCertificate::get()
                ->sort('ID DESC')
                ->filter('Deleted', 0)
                ->limit($numRecords);
        return $list;
    }    

    
    public function Link($slug = null) {
        if($slug){
            return Controller::join_links(Director::baseURL(), 'marriage', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'marriage');
        }        
        
    }    

}

