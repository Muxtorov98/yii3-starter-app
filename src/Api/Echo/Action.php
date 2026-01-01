<?php

declare(strict_types=1);

namespace App\Api\Echo;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\Html\Html;
use Yiisoft\Router\HydratorAttribute\RouteArgument;

final readonly class Action
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
    ) {}

    public function __invoke(
        #[RouteArgument('message')]
        string $message = 'Hello!'
    ): ResponseInterface
    {
        $response = $this->responseFactory->createResponse();
        $response->getBody()->write('The message is: ' . Html::encode($message));
        return $response;
    }
}
