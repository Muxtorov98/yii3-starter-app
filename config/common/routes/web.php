<?php
declare(strict_types=1);

use App\Web;
use Yiisoft\Http\Method;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;

return Group::create()
    ->routes(
        Route::get('/')
            ->action(Web\HomePage\Action::class)
            ->name('home'),

        Route::methods([Method::GET, Method::POST], '/say')
            ->action(Web\Echo\Action::class)
            ->name('web/echo/say'),
    );
