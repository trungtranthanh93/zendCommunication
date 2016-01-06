<?php
namespace Users\Form;

use Zend\InputFilter\InputFilter;

class RegisterFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'domain' => true,
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'name',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 140,
                        'message'=>array(
                            \Zend\Validator\StringLength::TOO_LONG=>'Name can not be more than 140 characters long.',
                            \Zend\Validator\StringLength::TOO_SHORT=>'Name is required.'
                        ),
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'password',
            'required' => true
        ));
        
        $this->add(array(
            'name' => 'confirm_password',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'password',
                        'messages' => array(
					\Zend\Validator\Identical::NOT_SAME => 'Please enter same password',
				),
                    )
                   
                )
            )
        ));
    }
}
