<?php

namespace App\Forms\Arccate;

use App\Models\ArcCate;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\Form;

class addForm extends Form
{
    public function buildForm()
    {
        //获取分类信息
        $choices = ArcCate::getCateByLevelForSelect();
        $this->add('name', 'text', [
                'rules' => 'required',
                'label' => '分类名称',
                'error_messages' => [
                    'name.required' => '分类名称不能为空'
                ]
            ])
            ->add('pid', 'select',[
                'choices' => $choices,
                'label' => '父级分类'
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
