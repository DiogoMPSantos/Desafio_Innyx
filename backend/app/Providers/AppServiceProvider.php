<?php

namespace App\Providers;

use App\Interfaces\CategoriaRepositoryInterface;
use App\Interfaces\ProdutoRepositoryInterface;
use App\Repositories\CategoriaRepository;
use App\Repositories\ProdutoRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoriaRepositoryInterface::class, CategoriaRepository::class);
        $this->app->bind(ProdutoRepositoryInterface::class, ProdutoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
