<?php

declare(strict_types=1);

namespace App\Web\Page;

use DateTimeImmutable;
use Yiisoft\Strings\Inflector;

final readonly class Page
{
    private function __construct(
        public string $id,
        public string $title,
        public string $text,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $updatedAt,
    ) {}

    public static function create(
        string $id,
        string $title,
        string $text,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null,
    ): self {
        return new self(
            id: $id,
            title: $title,
            text: $text,
            createdAt: $createdAt ?? new DateTimeImmutable(),
            updatedAt: $updatedAt ?? new DateTimeImmutable(),
        );
    }

    public function getSlug(): string
    {
        return (new Inflector())->toSlug($this->title);
    }
}
