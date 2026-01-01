<?php
declare(strict_types=1);

use App\Api;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;

return Group::create('/api')
    ->namePrefix('api/')
    ->routes(
        Route::get('/say[/{message}]')
            ->action(Api\Echo\Action::class)
            ->name('echo/say'),
    );
