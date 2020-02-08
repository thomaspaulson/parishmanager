<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/13/2016
 * Time: 12:57 PM
 */

class SiteController extends Controller
{

    private static $page_length = 50;

	protected $title;
	
    public function init()
    {
        parent::init();        
        //self::$page_length = 2;
		
		$this->title = 'Site';

        $member =Member::currentUser();
        if(!$member){
            return $this->redirect('Security/login?BackURL='.$this->RedirectURL());
        }

        //Requirements::css('themes/default/foundation-icons/foundation-icons.css');
    }

    public function MyParish(){
        $parish = null;

		$parish_id = Config::inst()->get('Parish', 'my_parish');
        
		$parish = Parish::get()
			->filter(array(
				'ID' => $parish_id
			))
			->first();
		return $parish;
		/*
        if(Cookie::get('myparishid')){
            $id = Cookie::get('myparishid');
            $parish = Parish::get()
                ->filter(array(
                    'ID' => $id
                ))
                ->first();
            return $parish;
        }

        if(Session::get('myparishid')){
            $id = Session::get('myparishid');
            $parish = Parish::get()
                        ->filter(array(
                            'ID' => $id
                        ))
                        ->first();
            return $parish;
        }
		
		$member = $this->getMember();
		$parishes = $member->Parishes();
		//Debug::show($parishes);
		if($parishes->exists()){
			$parish = $parishes->first();
			Session::set('myparishid',$parish->ID);
			return $parish;
		}
		
        return $parish;
        */ 
    }

    public function MyParishes($limit = 10){
        $list = Parish::get()->limit($limit);
        return $list;
    }

    // return request url with baseurl
    public function RedirectURL(){            
        return urlencode(Director::baseURL().$this->request->getURL(true));
    }
    
    public function RequestedURL($params = null){
    	return urlencode($this->request->getURL(true).$params);
    }
    
    public function GoBackURL(){    	
    	return urldecode($this->request->getVar('BackURL'));
    }
    
    // return pageLength
    public function getPageLength(){
        return self::$page_length;
    }
	
    public function getUrlParameters(){
        $vars = $this->request->getVars();
        if(isset($vars['url']))
            unset($vars['url']);
        if(count($vars)){
            return http_build_query($vars);
        }
        return null;
    }
	


	protected function canAccess($parish_id = null){
		
		$member = $this->getMember();
		
		if($member && $member->inGroup('Administrators')){
			return true;
		}
						
		if($member && $member->inGroup('Managers')){
			return true;
		}		
		return $this->isMemberOf($member, $parish_id);				
	}
	
	/**
	 * @param null|int|Member $member
	 *
	 * @return null|Member
	 */
	protected function getMember($member = null) {
		if(!$member) {
			$member = Member::currentUser();
		}

		if(is_numeric($member)) {
			$member = Member::get()->byID($member);
		}
		
		return $member;
	}
	
	protected function isMemberOf($member, $parish_id){
		$parishes = $member->Parishes();
		
		if(!$parishes->exists()){
			return false;
		}
		
		if($parishes instanceof ManyManyList) {
			return in_array($parish_id, $parishes->getIDList());
		}
		
		return $parishes->byID($parish_id) !== null;
		
	}
	
    /**
     * Creates custom error pages. This will look for a template with the 
     * name ErrorPage_$code (ie ErrorPage_404) or fall back to "ErrorPage".
     *
     * @param $code int
     * @param $message string
     *
     * @return SS_HTTPResponse
    **/
    public function httpError($code, $message = null) {
        // Check for theme with related error code template.
        if(SSViewer::hasTemplate("ErrorPage_" . $code)) {
            $this->template = "ErrorPage_" . $code;
        } else if(SSViewer::hasTemplate("ErrorPage")) {
            $this->template = "ErrorPage";
        }

        if($this->template) {
            $this->response->setBody($this->render(array(
                "Code" => $code,
                "Message" => $message,
            )));
            $message =& $this->response;
        }

        return parent::httpError($code, $message);
    }
	
}
