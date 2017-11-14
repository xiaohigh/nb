<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArcCate extends Model
{
    //层级关系获取分类
    public static function getCateByLevelForSelect()
    {
        //获取分类数据
        $cates = self::getCateByLevelForList();
        //空数组
        $choices = [
            0 => '顶级分类'
        ];
        foreach($cates as $k=>$v) {
            //获取当前的层级
            $count = count(explode('_',$v->path)) - 1;
            $choices[$v->id] = str_repeat('|-----', $count).$v['name'];
        }
        return $choices;
    }


    /**
     * 层级关系获取 为列表显示
     */
    public static function getCateByLevelForList()
    {
        //获取分类数据
        $cates = ArcCate::select(DB::raw('id,name,pid,concat(path,"_",id) as paths'))
            ->orderBy('paths')
            ->get();
        //空数组
        $choices = [];
        foreach($cates as $k=>&$v) {
            //获取当前的层级
            $count = count(explode('_',$v->paths)) - 2;
            $v['name'] = str_repeat('|-----', $count).$v['name'];
        }
        return $cates;
    }

}
