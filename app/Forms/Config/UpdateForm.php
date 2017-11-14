<?php

namespace App\Forms\User;

use Kris\LaravelFormBuilder\Form;
use App\User;

class UpdateForm extends Form
{

    public function buildForm()
    {
        $this
            ->add('title','text',[
                'label' => '网站标题',
            ])
            ->add('description','textarea',[
                'label' => '网站介绍',
            ])
            ->add('keywords','textarea',[
                'label' => '关键字',
            ])
            ->add('author_name','text',[
                'label' => '作者名称',
            ])
            ->add('author_pic','text',[
                'label' => '作者头像',
            ])
            ->add('signature','textarea',[
                'label' => '作者签名',
            ])
            ->add('logo','textarea',[
                'label' => 'logo',
            ])
            ->add('submit', 'submit', [
                'label' => '更新',
                'attr' => [
                    'class'=>'btn btn-primary'
                ]
            ]);
    }
}
