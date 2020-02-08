<?php
//
class MediaController extends SiteController{
	#code
	
	public static $allowed_actions = array(
        	'index',
    		'search',
    		'printlist',
    		'add_media',
    		'AddMediaForm',
    		'edit_media',
    		'EditMediaForm',
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
		$this->title = 'Media';
	}

	/**
	 * render agriculture index page
	 * @return string
	 */	
	public function index(){
		$this->title = 'Media';		
		return $this->renderWith(array('Media','App'));
	}
	
    public function add_media(){
		    
    	$familyID = (int)$this->getRequest()->getVar('FamilyID');
    	$family = Family::get()->byID($familyID);
    	if(!$family){
    		return $this->httpError(404,'Page not found');
    	}
    
    	$this->title = "Add Media";
    	$form = $this->AddMediaForm();
    
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
    
    
    public function AddMediaForm(){
    	$form = new AddMediaForm($this, __FUNCTION__);
    	return $form;
    }
    
    public function edit_media(){
    
    	$this->title = "Edit Media";
    	$form = $this->EditMediaForm();
    	$form->setTemplate('AddMediaForm');
    	$id = (int)$this->request->param('ID');
    	//var_dump($_POST);EXIT();
    	$media = Media::get()->byID($id);
    	if(!$media){
    		return $this->httpError(404,'Page not found');
    	}
    	if($media->exists() && $form){
    		$form->loadDataFrom($media);
    	}
    
    	$backURL = urldecode($this->getRequest()->getVar('BackURL'));
    	$redirectURL = $form->Fields()->fieldByName('RedirectURL');
    	$redirectURL->setValue($backURL);
    
    
    	$data = array(
    			'Form' => $form
    	);
    	return $this->customise($data)->renderWith(array('Generic_form', 'App'));
    
    }
    
    
    public function EditMediaForm(){
    	$form = new EditMediaForm($this, __FUNCTION__);
    	return $form;
    }
	
	

	public function search(){		
		$this->title = 'Search Media';
		$this->list = $this->Results();
		return $this->renderWith(array('Media_results','App'));
	}

	public function printlist(){
		$this->title = 'Media list';		
		return $this->renderWith(array('Media_printresults','Print'));
	}
	
	public function export_to_csv(){		
		$this->title = 'export';
		$this->list = $this->Results();	
		//exit('dd') ;
		$filename = "media.csv";
		$fp = fopen('php://output', 'w');
		$header = array('Name','Address',
						'Contact Person','Contact',
						'Block','Unit',
						'Family','HouseNo',
						'Newspaper', 'Television',
						'Magazine', 'KidsMagazine',
						'Internet', 'CatholicMagazine',
						'Computer', 'Others', '[specify]'						
					   );
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		fputcsv($fp, $header);
		
		foreach($this->list as $list) {
			$newspaper = $list->Newspaper ? 'Yes': 'No';
			$television = $list->Television ? 'Yes': 'No';			
			$magazine = $list->Magazine? 'Yes': 'No';
			$kidsMagazine = $list->KidsMagazine? 'Yes': 'No';			
			$internet = $list->Internet? 'Yes': 'No';
			$catholicMagazine = $list->CatholicMagazine? 'Yes': 'No';
			$computer = $list->Computer? 'Yes': 'No';
			$others = $list->Others? 'Yes': 'No';
			
			$raw = array(  $list->Name, $list->Address,
						   $list->MemberName, $list->ContactNo,
						   $list->BlockNo, $list->UnitNo,
 						   $list->FamilyNo, $list->HouseNo,
						   $newspaper, $television,
						   $magazine, $kidsMagazine,
						   $internet, $catholicMagazine,
						   $computer, $others, $list->Specify
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
            return Controller::join_links(Director::baseURL(), 'media', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'media');
        }
    }
	
    public function Results(){
		$sqlQuery = new SQLQuery();
		$sqlQuery->setFrom('Family');
		$sqlQuery->selectField('Family.ID', 'ID');
		$sqlQuery->selectField('Family.Name', 'Name');
		$sqlQuery->selectField('FamilyMember.Name', 'MemberName');
		$sqlQuery->addLeftJoin('FamilyMember','"Family"."ID" = "FamilyMember"."FamilyID" AND "FamilyMember"."Relation" = \'Guardian\'');
		$sqlQuery->addLeftJoin('Media','"Family"."ID" = "Media"."FamilyID"');	

		$newspaper = Convert::raw2sql($this->request->getVar('Newspaper'));
        if($newspaper!='all'){
			$sqlQuery->addWhere("Media.Newspaper = $newspaper");
        }
		
        $television = Convert::raw2sql($this->request->getVar('Television'));		
        if($television!='all'){
			$sqlQuery->addWhere("Media.Television = $television");
        }
		
		
		$magazine = Convert::raw2sql($this->request->getVar('Magazine'));		
        if($magazine!='all'){
			$sqlQuery->addWhere("Media.Magazine = $magazine");
        }
		
		$kidsMagazine = Convert::raw2sql($this->request->getVar('KidsMagazine'));
        if($kidsMagazine!='all'){
			$sqlQuery->addWhere("Media.KidsMagazine = $kidsMagazine");
        }
		
		$internet = Convert::raw2sql($this->request->getVar('Internet'));
        if($internet!='all'){
			$sqlQuery->addWhere("Media.Internet = $internet");
        }
		
		$catholicMagazine = Convert::raw2sql($this->request->getVar('CatholicMagazine'));
        if($catholicMagazine!='all'){
			$sqlQuery->addWhere("Media.CatholicMagazine = $catholicMagazine");
        }		

		$computer = Convert::raw2sql($this->request->getVar('Computer'));
        if($computer!='all'){
			$sqlQuery->addWhere("Media.Computer = $computer");
        }		

		$others = Convert::raw2sql($this->request->getVar('Others'));
        if($others!='all'){
			$sqlQuery->addWhere("Media.Others = $others");
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

        $list = Family::get()->leftJoin('Media','"Family"."ID" = "Media"."FamilyID"');
				
	
		$myparish = $this->MyParish();
		$list = $list->filter(array(
			'ParishID' => $myparish->ID
		));			
        
		$newspaper = Convert::raw2sql($this->request->getVar('Newspaper'));
        if($newspaper!='all'){
            $list = $list->filter(array(
                'Media.Newspaper' => $newspaper
            ));
        }
		
        $television = Convert::raw2sql($this->request->getVar('Television'));		
        if($television!='all'){
            $list = $list->filter(array(
                'Media.Television' => $television
            ));
        }
		
		
		$magazine = Convert::raw2sql($this->request->getVar('Magazine'));		
        if($magazine!='all'){
            $list = $list->filter(array(
                'Media.Magazine' => $magazine
            ));
        }
		
		$kidsMagazine = Convert::raw2sql($this->request->getVar('KidsMagazine'));
        if($kidsMagazine!='all'){
            $list = $list->filter(array(
                'Media.KidsMagazine' => $kidsMagazine
            ));
        }
		
		$internet = Convert::raw2sql($this->request->getVar('Internet'));
        if($internet!='all'){
            $list = $list->filter(array(
                'Media.Internet' => $internet
            ));
        }
		
		$catholicMagazine = Convert::raw2sql($this->request->getVar('CatholicMagazine'));
        if($catholicMagazine!='all'){
            $list = $list->filter(array(
                'Media.CatholicMagazine' => $catholicMagazine
            ));
        }		

		$computer = Convert::raw2sql($this->request->getVar('Computer'));
        if($computer!='all'){
            $list = $list->filter(array(
                'Media.Computer' => $computer
            ));
        }		

		$others = Convert::raw2sql($this->request->getVar('Others'));
        if($others!='all'){
            $list = $list->filter(array(
                'Media.Others' => $others
            ));
        }		

        return $list;
    }
	*/
	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
	
	
	public function MediaSearchForm(){
		$form = new MediaSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search Media');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
	}

}
