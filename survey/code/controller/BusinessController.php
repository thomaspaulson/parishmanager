<?php
//
class BusinessController extends SiteController{
	#code
	
	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_business',
    		'AddBusinessForm',
    		'edit_business',
    		'EditBusinessForm',
			'export_to_csv'
    );
	
	/**
	 * Family datalist
	 * @var DataList
	 *
	 */
	protected $list;
	
	public function init(){
		parent::init();
		$this->title = 'Business';
	}

	/**
	 * render agriculture index page
	 * @return string
	 */	
	public function index(){
		$this->title = 'Business';		
		return $this->renderWith(array('Business','App'));
	}

    public function add_business(){
		    
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Business";
    	$form = $this->AddBusinessForm();
    
    	$familyID = $form->Fields()->fieldByName('FamilyID');
    	$familyID->setValue($family->ID);
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    	$data = array(
    			'Form' => $form
    	);
    
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    }
    
    
    public function AddBusinessForm(){
    	$form = new AddBusinessForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_business(){
    
    	$this->title = "Edit Business";
    	$form = $this->EditBusinessForm();
    	$form->setTemplate('AddBusinessForm');
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$business = Business::get()->byID($id);
    	if(!$business){
    		return $this->httpError(404,'Page not found');
    	}
    	if($business->exists() && $form){
    		$form->loadDataFrom($business);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditBusinessForm(){
    	$form = new EditBusinessForm($this, __FUNCTION__);
    	return $form;
    }

	public function search(){		
		$this->title = 'Search Business';
		$this->list = $this->Results();
		return $this->renderWith(array('Business_results','App'));
	}

	public function printlist(){
		$this->title = 'Business list';		
		return $this->renderWith(array('Business_printresults','Print'));
	}
	
	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "business.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address',
						'Contact Person','Contact',
						'Block','Unit',
						'Family','HouseNo',
						'Streetvendor', 'Unduvandi',
						'Shop', 'Trade',
						'Industry', 'Selfemployed',
						'Others', 'Specify'
					   );
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {			
			$Streetvendor = $list->Streetvendor ? 'Yes': 'No';
			$Unduvandi = $list->Unduvandi? 'Yes': 'No';
			$Pettikada = $list->Pettikada? 'Yes': 'No';
			$Shop = $list->Shop? 'Yes': 'No';
			$Trade = $list->Trade? 'Yes': 'No';
			$Industry = $list->Industry? 'Yes': 'No';
			$Selfemployed = $list->Selfemployed? 'Yes': 'No';
			$Others = $list->Others? 'Yes': 'No';
			
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo,
 						   $list->FamilyNo, $list->HouseNo,
						   $Streetvendor, $Unduvandi,
						   $Shop, $Trade, 
						   $Industry, $Selfemployed,
						   $Others, $list->Specify
					);
			fputcsv($fp, $raw);
			//echo $list->Name.'<br>';
		}		
		fclose($fp);
	}	
	
    public function Title() {
        return $this->title;
    }

    public function Link($slug = null) {
        if($slug){
            return Controller::join_links(Director::baseURL(), 'business', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'business');
        }
    }

    public function Results(){

		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');
		$sqlQuery->addLeftJoin('Business','"Family"."ID" = "Business"."FamilyID"');	



        $Streetvendor = Convert::raw2sql($this->request->getVar('Streetvendor'));
        if($Streetvendor){
			$sqlQuery->addWhere("Business.Streetvendor = $Streetvendor");
        }
		
        $Unduvandi = Convert::raw2sql($this->request->getVar('Unduvandi'));
        if($Unduvandi){			
			$sqlQuery->addWhere("Business.Unduvandi = $Unduvandi");
        }
		
        $Pettikada = Convert::raw2sql($this->request->getVar('Pettikada'));
        if($Pettikada){
			$sqlQuery->addWhere("Business.Pettikada = $Pettikada");
        }
        $Shop = Convert::raw2sql($this->request->getVar('Shop'));
        if($Shop){
			$sqlQuery->addWhere("Business.Shop = $Shop");
        }
        $Trade = Convert::raw2sql($this->request->getVar('Trade'));
        if($Trade){
			$sqlQuery->addWhere("Business.Trade = $Trade");
        }
        $Industry = Convert::raw2sql($this->request->getVar('Industry'));
        if($Industry){
			$sqlQuery->addWhere("Business.Industry = $Industry");
        }
        $Selfemployed = Convert::raw2sql($this->request->getVar('Selfemployed'));
        if($Selfemployed){
			$sqlQuery->addWhere("Business.Selfemployed = $Selfemployed");
        }
        $Others = Convert::raw2sql($this->request->getVar('Others'));
        if($Others){
			$sqlQuery->addWhere("Business.Others = $Others");
        }
        
		$myparish = $this->MyParish();
		$sqlQuery->addWhere("Family.ParishID = $myparish->ID");

		$sqlQuery->setOrderBy('Family.ID DESC');
		$result = $sqlQuery->execute();		//echo  $sqlQuery->sql();
		// Iterate over results
		$arrList = new ArrayList();
		$count = $result->numRecords();		
		foreach($result as $row) {			
			$row['Counter'] = $count--;			
			$arrList->add($row); 
		}	
		
		return $arrList;
    }
	
	/*	
    public function Results(){

        $list = Family::get()->leftJoin('Business','"Family"."ID" = "Business"."FamilyID"');

        $Streetvendor = Convert::raw2sql($this->request->getVar('Streetvendor'));
        if($Streetvendor){
            $list = $list->filter(array(
                'Business.Streetvendor' => $Streetvendor
            ));
        }
        $Unduvandi = Convert::raw2sql($this->request->getVar('Unduvandi'));
        if($Unduvandi){
            $list = $list->filter(array(
                'Business.Unduvandi' => $Unduvandi
            ));
        }
        $Pettikada = Convert::raw2sql($this->request->getVar('Pettikada'));
        if($Pettikada){
            $list = $list->filter(array(
                'Business.Pettikada' => $Pettikada
            ));
        }
        $Shop = Convert::raw2sql($this->request->getVar('Shop'));
        if($Shop){
            $list = $list->filter(array(
                'Business.Shop' => $Shop
            ));
        }
        $Trade = Convert::raw2sql($this->request->getVar('Trade'));
        if($Trade){
            $list = $list->filter(array(
                'Business.Trade' => $Trade
            ));
        }
        $Industry = Convert::raw2sql($this->request->getVar('Industry'));
        if($Industry){
            $list = $list->filter(array(
                'Business.Industry' => $Industry
            ));
        }
        $Selfemployed = Convert::raw2sql($this->request->getVar('Selfemployed'));
        if($Selfemployed){
            $list = $list->filter(array(
                'Business.Selfemployed' => $Selfemployed
            ));
        }
        $Others = Convert::raw2sql($this->request->getVar('Others'));
        if($Others){
            $list = $list->filter(array(
                'Business.Others' => $Others
            ));
        }
        
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
        
        //$list = $list->leftJoin('Contact', "\"Contact\".\"FamilyID\" = \"Family\".\"ID\"");
        //Debug::show($list);

        return $list;
    }*/
	
	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
	
	
	public function BusinessSearchForm(){
		$form = new BusinessSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->Link('search'));
        $form->setLegend('Search Business');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
	}
	
}
