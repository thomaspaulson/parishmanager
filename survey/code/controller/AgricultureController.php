<?php
//
class AgricultureController extends SiteController{
	#code
	

	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_agriculture',
    		'AddAgricultureForm',
    		'edit_agriculture',
    		'EditAgricultureForm',
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
		$this->title = 'Agriculture';
	}

	/**
	 * render agriculture index page
	 * @return string
	 */	
	public function index(){
		$this->title = 'Agriculture';		
		return $this->renderWith(array('Agriculture','App'));
	}
	
    public function add_agriculture(){
		    
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Agriculture";
    	$form = $this->AddAgricultureForm();
    
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
    
    
    public function AddAgricultureForm(){
    	$form = new AddAgricultureForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_agriculture(){
    
    	$this->title = "Edit Agriculture";
    	$form = $this->EditAgricultureForm();
    	$form->setTemplate('AddAgricultureForm');
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$agriculture = Agriculture::get()->byID($id);
    	if(!$agriculture){
    		return $this->httpError(404,'Page not found');
    	}
    	if($agriculture->exists() && $form){
    		$form->loadDataFrom($agriculture);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditAgricultureForm(){
    	$form = new EditAgricultureForm($this, __FUNCTION__);
    	return $form;
    }
	

	public function search(){
		$this->title = 'Search Agriculture';
		$this->list = $this->Results();
		return $this->renderWith(array('Agriculture_results','App'));
	}

	public function printlist(){
		$this->title = 'Agriculture list';		
		return $this->renderWith(array('Agriculture_printresults','Print'));
	}
	
	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "agriculture.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address',
						'Contact Person','Contact',
						'Block','Unit',
						'Family','HouseNo',
						'Coconut', 'Vegetable',
						'Rice', 'Fruit', 'Fish',						
						'Cow', 'Chicken',
						'Duck', 'Others', 'Specify'
					   );
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {
			$coconut = $list->Cocunut ? 'Yes': 'No';
			$vegetable = $list->Vegetable ? 'Yes': 'No';
			$rice = $list->Rice? 'Yes': 'No';
			$fruit = $list->Fruit? 'Yes': 'No';
			$fish = $list->Fish? 'Yes': 'No';
			$Cow = $list->Cow? 'Yes': 'No';
			$Chicken = $list->Chicken? 'Yes': 'No';
			$Duck = $list->Duck? 'Yes': 'No';
			$Others = $list->Others? 'Yes': 'No';
			
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo,
 						   $list->FamilyNo, $list->HouseNo,
						   $coconut, $vegetable,
						   $rice, $fruit, $fish,
						   $Cow, $Chicken,
						   $Duck, $Others, $list->Specify
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
            return Controller::join_links(Director::baseURL(), 'agriculture', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'agriculture');
        }
    }
	
    public function Results(){

		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');
		$sqlQuery->addLeftJoin('Agriculture','"Family"."ID" = "Agriculture"."FamilyID"');	


        $cocunut = Convert::raw2sql($this->request->getVar('Cocunut'));
        if($cocunut){
			$sqlQuery->addWhere("Agriculture.Cocunut = $cocunut");
        }
		
        $produce = Convert::raw2sql($this->request->getVar('Produce'));
        if($produce){
			$sqlQuery->addWhere("Agriculture.Produce = $produce");			
        }
		
        $paddy = Convert::raw2sql($this->request->getVar('Paddy'));
        if($paddy){
			$sqlQuery->addWhere("Agriculture.Paddy = $paddy");						
        }
		
        $fruit = Convert::raw2sql($this->request->getVar('Fruit'));
        if($fruit){
			$sqlQuery->addWhere("Agriculture.Fruit = $fruit");									
        }
		
        $fish = Convert::raw2sql($this->request->getVar('Fish'));
        if($fish){
			$sqlQuery->addWhere("Agriculture.Fish = $fish");									
        }
		
        $cow = Convert::raw2sql($this->request->getVar('Cow'));
        if($cow){
			$sqlQuery->addWhere("Agriculture.Cow = $cow");									
        }
		
        $goat = Convert::raw2sql($this->request->getVar('Goat'));
        if($goat){
			$sqlQuery->addWhere("Agriculture.Goat = $goat");									
        }
		
        $chicken = Convert::raw2sql($this->request->getVar('Chicken'));
        if($chicken){
			$sqlQuery->addWhere("Agriculture.Chicken = $chicken");									
        }
		
		$duck = Convert::raw2sql($this->request->getVar('Duck'));
        if($duck){
			$sqlQuery->addWhere("Agriculture.Duck = $duck");									
        }
		
        $others = Convert::raw2sql($this->request->getVar('Others'));
        if($others){
			$sqlQuery->addWhere("Agriculture.Others = $others");									
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

        $list = Family::get()->leftJoin('Agriculture','"Family"."ID" = "Agriculture"."FamilyID"');

        $cocunut = Convert::raw2sql($this->request->getVar('Cocunut'));
        if($cocunut){
            $list = $list->filter(array(
                'Agriculture.Cocunut' => $cocunut
            ));
        }        
        $produce = Convert::raw2sql($this->request->getVar('Produce'));
        if($produce){
            $list = $list->filter(array(
                'Agriculture.Produce' => $produce
            ));
        }
        $paddy = Convert::raw2sql($this->request->getVar('Paddy'));
        if($paddy){
            $list = $list->filter(array(
                'Agriculture.Paddy' => $paddy
            ));
        }
        $fruit = Convert::raw2sql($this->request->getVar('Fruit'));
        if($fruit){
            $list = $list->filter(array(
                'Agriculture.Fruit' => $fruit
            ));
        }
        $fish = Convert::raw2sql($this->request->getVar('Fish'));
        if($fish){
            $list = $list->filter(array(
                'Agriculture.Fish' => $fish
            ));
        }
        $cow = Convert::raw2sql($this->request->getVar('Cow'));
        if($cow){
            $list = $list->filter(array(
                'Agriculture.Cow' => $cow
            ));
        }
        $goat = Convert::raw2sql($this->request->getVar('Goat'));
        if($goat){
            $list = $list->filter(array(
                'Agriculture.Goat' => $goat
            ));
        }
        $chicken = Convert::raw2sql($this->request->getVar('Chicken'));
        if($chicken){
            $list = $list->filter(array(
                'Agriculture.Chicken' => $chicken
            ));
        }
        $duck = Convert::raw2sql($this->request->getVar('Duck'));
        if($duck){
            $list = $list->filter(array(
                'Agriculture.Duck' => $duck
            ));
        }
        $others = Convert::raw2sql($this->request->getVar('Others'));
        if($others){
            $list = $list->filter(array(
                'Agriculture.Others' => $others
            ));
        }


		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
        

        //$list = $list->leftJoin('Contact', "\"Contact\".\"FamilyID\" = \"Family\".\"ID\"");
        //Debug::show($list);

        return $list;
    }
    */
	
	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
	
	
	public function AgricultureSearchForm(){
		$form = new AgricultureSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search Agriculture');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
	}


}
