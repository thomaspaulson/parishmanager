<?php
class EditParishForm extends Form
{
	
	public function __construct($controller, $name){
        // Create fields          
        $fields = new FieldList(
            new TextField('Title', 'Title*'),
            new TextareaField('Address', 'Address*'),
            new TextField('Landline','Landline')
        );
            		
        $actions = new FieldList(
            new FormAction("SubmitForm",  'Save')
        );
 
        $validator = new RequiredFields(
            'Title',
            'Address'
        );
 
        parent::__construct($controller, $name, $fields, $actions, $validator);		
	}

	public function SubmitForm($data, $form, $request){
		$parish = $this->MyParish();
		if($parish){
			$form->saveInto($parish);
			$parish->write();
		}
        $this->getController()->redirect(
            $this->getController()->Link('?updated=1')
        );

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
		
		//$member = $this->getMember();
		$member = Member::currentUser()
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
	
}
