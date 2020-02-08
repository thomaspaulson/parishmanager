<?php
//
class CatholicMagazineController extends SiteController{
	#code
	
    public static $allowed_actions = array(
        'index','search', 'printlist'
    );
	
	/**
	 * Family datalist
	 * @var DataList
	 *
	 */
	protected $list;
	
	public function init(){
		parent::init();
		$this->title = 'Catholic Magazine';
	}

	/**
	 * render agriculture index page
	 * @return string
	 */	
	public function index(){
		$this->title = 'Catholic Magazine';		
		return $this->renderWith(array('CatholicMagazine','App'));
	}

	public function search(){
		// show Unathorised page with user does not have access other parish
		$parishID = Convert::raw2sql($this->request->getVar('ParishID'));		
		if(!$this->canAccess($parishID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}
		
		
		$this->title = 'Search Catholic Magazine';
		$this->list = $this->Results();
		return $this->renderWith(array('CatholicMagazine_results','App'));
	}

	public function printlist(){
		// show Unathorised page with user does not have access other parish
		$parishID = Convert::raw2sql($this->request->getVar('ParishID'));		
		if(!$this->canAccess($parishID)){
			return $this->renderWith(array('Unathorised_access', 'App'));
		}
		
		$this->title = 'Catholic-Magazine list';		
		return $this->renderWith(array('CatholicMagazine_printresults','Print'));
	}
	
    public function Title() {
        return $this->title;
    }

    public function Link($slug = null) {
        if($slug){
            return Controller::join_links(Director::baseURL(), 'catholic-magazine', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'catholic-magazine');
        }
    }

    public function Results(){

        $list = Family::get()->leftJoin('CatholicMagazine','"Family"."ID" = "CatholicMagazine"."FamilyID"');
		

        $parishID = Convert::raw2sql($this->request->getVar('ParishID'));

        if($parishID){
            $list = $list->filter(array(
                'ParishID' => $parishID
            ));
        }

        $jeevadeepthi = Convert::raw2sql($this->request->getVar('Jeevadeepthi'));
        if($jeevadeepthi!='all'){
            $list = $list->filter(array(
                'CatholicMagazine.Jeevadeepthi' => $jeevadeepthi
            ));
        }
		
        $jeevanaadam = Convert::raw2sql($this->request->getVar('Jeevanaadam'));		
        if($jeevanaadam!='all'){
            $list = $list->filter(array(
                'CatholicMagazine.Jeevanaadam' => $jeevanaadam
            ));
        }
		
        $christain = Convert::raw2sql($this->request->getVar('Christain'));
        if($christain!='all'){
            $list = $list->filter(array(
                'CatholicMagazine.Christain' => $christain
            ));
        }
		
        $preshithaKeralam = Convert::raw2sql($this->request->getVar('PreshithaKeralam'));		
        if($preshithaKeralam!='all'){
            $list = $list->filter(array(
                'CatholicMagazine.PreshithaKeralam' => $preshithaKeralam
            ));
        }
		
        $shalom = Convert::raw2sql($this->request->getVar('Shalom'));
        if($shalom!='all'){
            $list = $list->filter(array(
                'CatholicMagazine.Shalom' => $shalom
            ));
        }
		
		
        $cherupushpam = Convert::raw2sql($this->request->getVar('Cherupushpam'));
        if($cherupushpam!='all'){
            $list = $list->filter(array(
                'CatholicMagazine.Cherupushpam' => $cherupushpam
            ));
        }
		
        $others = Convert::raw2sql($this->request->getVar('Others'));		
        if($others!='all'){
            $list = $list->filter(array(
                'CatholicMagazine.Others' => $others
            ));
        }
		

        //$list = $list->leftJoin('Contact', "\"Contact\".\"FamilyID\" = \"Family\".\"ID\"");
        //Debug::show($list);

        return $list;
    }
	
	public function PaginatedList(){
		$list = new PaginatedList($this->list, $this->request);
        $list->setPageLength($this->getPageLength());
		return $list;
	}
	
	
	public function CatholicMagazineSearchForm(){
		$form = new CatholicMagazineSearchForm($this,__FUNCTION__);
        $form->setFormMethod('get')
            ->setFormAction($this->link('search'));
        $form->setLegend('Search Catholic-Magazine');
        $form->disableSecurityToken();
        $form->loadDataFrom($this->request->getVars());
        return $form;
	}


}
