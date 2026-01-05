<?php

declare(strict_types=1);

namespace App\Api\Page\Dto;

final readonly class PageDto
{
    public function __construct(
        public string $id,
        public string $title,
        public string $slug,
        public string $text,
        public string $createdAt,
    ) {}
}
