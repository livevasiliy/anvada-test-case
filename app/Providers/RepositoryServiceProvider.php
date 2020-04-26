<?php

namespace App\Providers;

use App\Contracts\DocumentContract;
use App\Repository\DocumentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        DocumentContract::class => DocumentRepository::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $contract => $repository)
        {
            $this->app->bind($contract, $repository);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
