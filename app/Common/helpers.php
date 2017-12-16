<?php
/**
 * 执行成功或者失败之后的提醒跳转 操作
 */
function rt($status, $msg, $url) {
    $tmp = !empty($url) ? redirect($url) : back();
    //返回
    return $tmp->with([
        'status' => $status,
        'msg' => $msg
    ]);
}

/**
 * 返回json数据
 */
function rjson($status, $msg='', $data=[]) {
    return json_encode([
        'status'=>$status,
        'msg' => $msg,
        'data' => $data
    ]);
}

/**
 * 自定义配置
 */
function C($key)
{
    static $configs = null;
    //如果配置数组为空
    if(!$configs) {
        $configs = \App\Models\Config::find(1);
    }
    return $configs->$key ? : '';
}

/**
 * 获取顶部菜单
 * @return mixed
 */
function getTopMenu()
{
    return \App\Models\ArcCate::get();
}

/**
 * 解析字符串
 * @param String $str
 */
function handleTags(String $str=null)
{
    return $str ? explode('_', trim($str,'_')) : [];
}

function formatSeconds($seconds)
{
    $minutes = $seconds / 60;
    if($minutes > 0) {
        return sprintf('%d分%d秒', $minutes, $seconds % 60);
    }else{
        return sprintf('%d秒', $seconds);
    }
}

