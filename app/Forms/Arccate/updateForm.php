<?php

namespace App\Forms\Arccate;

use App\Models\ArcCate;
use Kris\LaravelFormBuilder\Form;

class updateForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        //获取分类信息
        $choices = ArcCate::getCateByLevelForSelect();
        $this
            ->add('name', 'text', [
                'rules' => 'required',
                'label' => '分类名称',
                'error_messages' => [
                    'name.required' => '分类名称不能为空'
                ]
            ])
            ->add('_method','hidden', [
                'value' => 'put'
            ])
            ->add('pid', 'select',[
                'choices' => $choices,
                'label' => '父级分类',
                'attr' => [
                    'class' => 'form-control',
                    'disabled' => 'disabled'
                ]
            ])
            ->add('submit', 'submit', [
                'label' => '更新',
                'class' => 'btn',
                'attr' => [
                    'class'=>'btn btn-primary'
                ]
            ]);
    }
}
