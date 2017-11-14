<?php

namespace App\Providers;

use App\Models\ArcCate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Tag;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        //共享数据 标签
        view()->share('tags', Tag::all());
        //共享数据 分类
        view()->share('cates', ArcCate::all());
        //共享
        view()->share('request', $request);

        //安装bug解决
        Schema::defaultStringLength(191);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
