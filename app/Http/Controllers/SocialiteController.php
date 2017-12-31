<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    /**
     * github Login
     */
    public function github(Request $request)
    {
    	//检测是否有code参数
    	if (!$request->has('code')) {
    		return \Socialite::with('github')->redirect();
    	}

    	// 获取用户信息
    	$github = \Socialite::driver('github')->user();

    	// 检测用户是否已经存在
    	$user = User::where('email', $github->email)->first();
    	if (empty($user)) {
    		//不存在 则创建一个用户
	    	$user = new User;
	    	$user -> email = $github -> email;
	    	$user -> password = 'X';
	    	$user -> profile = $github->avatar;
	    	$user -> auth_id = $github->id;
	    	$user -> activated = '1';
	    	$user -> is_admin = false;
	    	$user -> name = $github -> name;
	    	$user -> auth_type = 'github';

	    	$user->save();
    	}

    	Auth::login($user, true);
    	return redirect('/')->with('success','登录成功');
    }

    /**
     * google Login
     */
    public function google(Request $request)
    {
    	//检测是否有code参数
    	if (!$request->has('code')) {
    		return \Socialite::with('google')->redirect();
    	}

        $g = (\Socialite::with('google'));

        $g->setHttpClient(new Client([
            'proxy' => env('HTTP_PROXY')
        ]));

    	// 获取谷歌用户信息
    	$google = $g->user();

    	$user = User::where('email', $google->email)->first();

    	if (empty($user)) {
    		//不存在 则创建一个用户
	    	$user = new User;
	    	$user -> email = $google -> email;
	    	$user -> password = 'X';
	    	$user -> profile = $google->avatar_original;
	    	$user -> auth_id = $google->id;
	    	$user -> activated = '1';
	    	$user -> is_admin = false;
	    	$user -> name = $google -> name;
	    	$user -> auth_type = 'google';

	    	$user->save();
    	}

    	Auth::login($user, true);
    	return redirect('/')->with('success','登录成功');
    }

}
