<?php

declare(strict_types=1);

namespace App\Web\Echo;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\FormModel\FormHydrator;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final readonly class Action
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private FormHydrator $formHydrator,
    ) {}

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $form = new Form();

        $this->formHydrator->populateFromPostAndValidate($form, $request);

        return $this->viewRenderer->render(__DIR__ . '/template', [
            'form' => $form,
        ]);
    }
}
