<?php

namespace App\Forms\Tag;

use Kris\LaravelFormBuilder\Form;

class AddForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this
            ->add('name','text',[
                'label'=>'标签名',
                'rules'=>'required|unique:tags,name'
            ])
            ->add('button','submit',[
                'label' => '添加',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ;
    }
}
