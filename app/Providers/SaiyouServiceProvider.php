<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Mail\MailServiceProvider;
use App\Mail\Transport\SYTransport;

class SaiyouServiceProvider extends MailServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app['config']['mail.driver'] == 'sy') {
            $this->registerSYSwiftMailer();
        } else {
            parent::registerSwiftMailer();
        }
        $this->registerIlluminateMailer();
        $this->registerMarkdownRenderer();
    }

    private function registerSYSwiftMailer()
    {
        $this->app->singleton('swift.mailer', function ($app) {
            return new \Swift_Mailer(new SYTransport());
        });
    }
}
