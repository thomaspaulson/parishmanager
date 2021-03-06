<?php
class EditMarriageForm extends BaseForm{

    public function __construct(
            $controller,
            $name,
            FieldList $fields = null,
            FieldList $actions = null,
            $validator = null
        ){
        parent::__construct($controller, $name, $fields, $actions, $validator);
        $this->addExtraClass('js-places-search-form');	       

    }



    public function getFormFields() {

        $fields = parent::getFormFields();		
        $fields->push(TextField::create('Year','Year'));
        $fields->push(TextField::create('RegNO','Reg NO'));
        $fields->push(TextField::create('PageNO','Page NO'));

        
        $fields->push(TextField::create('GroomName','Name')->setAttribute('placeholder', 'Groom'));
        $fields->push(TextField::create('GroomFather','Father')->setAttribute('placeholder', 'Father')); 		        
        $fields->push(TextField::create('GroomMother','Mother')->setAttribute('placeholder', 'Mother'));
        $fields->push(TextField::create('GroomParish','Parish name'));
        $fields->push(TextField::create('GroomBornAt','at')->setAttribute('placeholder', 'Born at'));
        $fields->push(TextField::create('GroomDOB','Date of Birth')->setAttribute('placeholder', 'dd-mm-yyyy'));        
        $fields->push(TextField::create('GroomBaptisedAt','at')->setAttribute('placeholder', 'Baptised at'));
        $fields->push(TextField::create('GroomBaptised','Baptised')->setAttribute('placeholder', 'dd-mm-yyyy'));
        
        
	    $fields->push(TextField::create('BrideName','Name')->setAttribute('placeholder', 'Bride')); 
	    $fields->push(TextField::create('BrideFather','Father')->setAttribute('placeholder', 'Father')); 		        
        $fields->push(TextField::create('BrideMother','Mother')->setAttribute('placeholder', 'Mother'));
        $fields->push(TextField::create('BrideParish','Parish name'));
        $fields->push(TextField::create('BrideBornAt','at')->setAttribute('placeholder', 'Born at'));
        $fields->push(TextField::create('BrideDOB','Date of Birth')->setAttribute('placeholder', 'dd-mm-yyyy'));
        $fields->push(TextField::create('BrideBaptisedAt','at')->setAttribute('placeholder', 'Baptised at'));
        $fields->push(TextField::create('BrideBaptised','Baptised')->setAttribute('placeholder', 'dd-mm-yyyy'));
        
        $fields->push(TextField::create('AtParish','At'));
        $fields->push(TextField::create('DOMarriage','Date of Marriage')->setAttribute('placeholder', 'dd-mm-yyyy'));
        $fields->push(TextField::create('Priest','Priest')->setAttribute('placeholder', 'Priest'));        
        
        $fields->push(TextField::create('Witness1','Name'));
        $fields->push(TextField::create('Witness1Parish','Parish'));
        $fields->push(TextField::create('Witness2','Name'));
        $fields->push(TextField::create('Witness2Parish','Parish'));
        $fields->push(TextField::create('Remarks','Remarks'));
	    $fields->push(HiddenField::create('ID','ID'));		
        
        $fields->push(TextField::create('Place','Place'));
        $fields->push(TextField::create('Date','Date')->setAttribute('placeholder', 'dd-mm-yyyy'));
        $fields->push(TextField::create('ParishPriest','Priest Name'));							

        $fields->push(HiddenField::create('ParishID','ParishID'));
        $fields->push(HiddenField::create('RedirectURL','RedirectURL'));		

        return $fields;
    }
 
    public function getFormActions() {
        $actions = parent::getFormActions();
        $actions->first()->setTitle('Edit');
        $cancel = FormAction::create('doCancel', 'Cancel')->setUseButtonTag(true);
        $cancel->addExtraClass('secondary');
        $actions->push($cancel);
        
        return $actions;
    }

    public function getFormValidator() {
        return null;
        //return RequiredFields::create(array('Status','Type'));
    }

    /**
     * @param $data array Data from request vars
     * @param $form ContactForm The form instance handling the request
     * @param $request SS_HTTPRequest The HTTP Request object
     */
    public function doSubmit($data, $form, $request) {
        
    	$id = (int)$data['ID'];
    	$marriageCertificate = MarriageCertificate::get()->byID($id);    	
    	$form->saveInto($marriageCertificate);
		
    	$marriageCertificate->write();

        $redirectUrl = urldecode($data['RedirectURL']);
        if($redirectUrl){
            return $this->getController()->redirect(
                            $redirectUrl
            );
        }

        if($link = $marriageCertificate->getLink('view')){
                return $this->controller->redirect($link);
        }		
    }	        

}

