<?php

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 1/12/2016
 * Time: 2:08 PM
 */
class ParishController extends Controller
{

    public static $allowed_actions = array(
        'search', 'myparish'
    );

    public function init(){
        parent::init();
    }

    public function search(){

        $term = Convert::raw2sql(trim($this->request->getVar('term')));

        $data = Parish::get()->filterAny(array(
											'Title:PartialMatch'=>$term,
											'Location:PartialMatch'=>$term));
        //$f1 = new JSONDataFormatter();
        //return $f1->convertDataObjectSet($data,array('ID','Title'));
        if($data){
            $return_arr = array();
            foreach($data as $p){
                $array['id'] = $p->ID;
                $array['title'] = ucwords(strtolower($p->Title));
                $array['location'] = $p->Location;

                array_push($return_arr,$array);
            }
            return json_encode($return_arr);
        }
    }


    public function myparish(){
        $id = Convert::raw2sql($this->getRequest()->param('ID'));

        if($id){
            Session::set('myparishid', $id);
            Cookie::set('myparishid', $id);
            $backURL = urldecode($this->getRequest()->getVar('BackURL')) ;
            //echo $backURL;  exit();
            return $this->redirect($backURL);
        }
    }

    public function Title() {
        return 'Parish';
    }

    public function Link($slug = null ) {
        if($slug){
            return Controller::join_links(Director::baseURL(), 'parish', $slug);
        } else {
            return Controller::join_links(Director::baseURL(), 'parish');
        }

    }


}