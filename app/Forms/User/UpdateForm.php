<?php

namespace App\Forms\User;

use Kris\LaravelFormBuilder\Form;
use App\Models\User;

class UpdateForm extends Form
{

    public function buildForm()
    {
        $this
            ->add('email','email',[
                'label' => '邮箱',
                'rules' => 'required|email'
            ])
            ->add('id','hidden')
            ->add('_method','hidden',[
                'value' => 'put'
            ])
            ->add('submit', 'submit', [
                'label' => '更新',
                'attr' => [
                    'class'=>'btn btn-primary'
                ]
            ]);
    }
}
