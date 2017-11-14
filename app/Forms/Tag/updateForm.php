<?php

namespace App\Forms\Tag;

use Kris\LaravelFormBuilder\Form;

class updateForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this
            ->add('name','text',[
                'label'=>'标签名',
                'rules'=>'required'
            ])
            ->add('_method','hidden',[
                'value'=>'put'
            ])
            ->add('button','submit',[
                'label' => '更新',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }
}
