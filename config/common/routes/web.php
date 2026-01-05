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

        Group::create('/pages')->routes(
            Route::get('')
                ->action(Web\Page\ListAction::class)
                ->name('page/list'),
            Route::get('/{slug}')
                ->action(Web\Page\ViewAction::class)
                ->name('page/view'),
            Route::methods([Method::GET, Method::POST], '/{slug}/edit')
                ->action(Web\Page\EditAction::class)
                ->name('page/edit'),
            Route::post('/{slug}/delete')
                ->action(Web\Page\DeleteAction::class)
                ->name('page/delete'),
        ),
    );
