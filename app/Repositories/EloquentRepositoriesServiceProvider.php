<?php
namespace App\Repositories;

use App\Repositories\Validate\JobOrdersRepository;
use App\Repositories\Validate\QuestionsRepository;
use App\Repositories\Validate\RateesRepository;
use Illuminate\Support\ServiceProvider;

class EloquentRepositoriesServiceProvider extends ServiceProvider {
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register Validate Job Order Repository
        $this->app->singleton(JobOrdersRepository::class, function($app) {
            return new JobOrdersRepository;
        });

        // Register Validate Questions Repository
        $this->app->singleton(QuestionsRepository::class, function($app) {
            return new QuestionsRepository;
        });

        // Register Validate Ratees Repository
        $this->app->singleton(RateesRepository::class, function($app) {
            return new RateesRepository;
        });
    }
}