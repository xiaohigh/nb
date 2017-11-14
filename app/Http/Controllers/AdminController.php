<?php

/**
 * 后台管理控制器
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin');
    }
}
