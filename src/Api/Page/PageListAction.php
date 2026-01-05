<?php

declare(strict_types=1);

namespace App\Api\Page;

use App\Api\Common\Dto\PaginationDto;
use App\Api\Page\Serializer\PageSerializer;
use App\Web\Page\PageRepository;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\Formatter\JsonDataResponseFormatter;
use Yiisoft\Router\HydratorAttribute\RouteArgument;

final readonly class PageListAction
{
    public function __construct(
        private PageRepository $pageRepository,
        private PageSerializer $serializer,
        private DataResponseFactoryInterface $dataResponseFactory,
    ) {}

    public function __invoke(
        #[RouteArgument('page')] int $page = 1,
        #[RouteArgument('perPage')] int $perPage = 10,
    ): ResponseInterface {

        $page = max(1, $page);
        $perPage = min(50, max(1, $perPage));
        $offset = ($page - 1) * $perPage;

        $rows  = $this->pageRepository->findPage($perPage, $offset);
        $total = $this->pageRepository->countAll();

        $data = [
            'items' => $this->serializer->toDtoListFromRows($rows),
            'pagination' => new PaginationDto(
                page: $page,
                perPage: $perPage,
                total: $total,
                pages: (int) ceil($total / $perPage),
            ),
        ];

        return $this->dataResponseFactory
            ->createResponse($data)
            ->withResponseFormatter(new JsonDataResponseFormatter());
    }
}
