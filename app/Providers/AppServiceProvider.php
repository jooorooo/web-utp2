<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator as Validation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerImageUrlValidation();
    }

    protected function registerImageUrlValidation()
    {
        Validation::extendImplicit('imageUrl', function ($attribute, $value, $parameters, Validator $validator) {
            if(!$info = @getimagesize($value)) {
                $validator->setCustomMessages([
                    $attribute . '.imageUrl' => 'Url is not valid image',
                ]);
                return false;
            }

            $this->app['request']->request->set('width', $info[0]);
            $this->app['request']->request->set('height', $info[1]);

            return true;
        });
    }
}
