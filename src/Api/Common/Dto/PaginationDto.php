<?php

declare(strict_types=1);

namespace App\Api\Common\Dto;

final readonly class PaginationDto
{
    public function __construct(
        public int $page,
        public int $perPage,
        public int $total,
        public int $pages,
    ) {}
}
