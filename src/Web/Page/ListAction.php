<?php

declare(strict_types=1);

namespace App\Web\Page;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final readonly class ListAction
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private PageRepository $pageRepository,
    )
    {
    }

    public function __invoke(): ResponseInterface
    {
        return $this->viewRenderer->render(__DIR__ . '/list', [
            'pages' => $this->pageRepository->findAll(),
        ]);
    }
}
