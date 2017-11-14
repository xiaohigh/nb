<?php

namespace App\Forms\User;

use Kris\LaravelFormBuilder\Form;

class AddForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this
            ->add('email', 'text', [
                'rules' => 'required|email|unique:users,email',
                'label' => '邮箱',
                'error_messages' => [
                    'email.email' => '邮箱格式有误'
                ]
            ])
            ->add('password', 'password', [
                'rules' => 'required',
                'label' => '密码'
            ])
            ->add('repassword', 'password',[
                'rules' => 'same:password',
                'label' => '确认密码'
            ])
            ->add('submit', 'submit', [
                'label' => '添加',
                'class' => 'btn',
                'attr' => [
                    'class'=>'btn btn-primary'
                ]
            ]);
    }
}
