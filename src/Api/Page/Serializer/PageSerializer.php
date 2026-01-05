<?php

declare(strict_types=1);

namespace App\Api\Page\Serializer;

use App\Api\Page\Dto\PageDto;

final class PageSerializer
{
    public function toDtoFromRow(array $row): PageDto
    {
        return new PageDto(
            id: (string) $row['id'],
            title: (string) $row['title'],
            slug: (string) $row['slug'],
            text: (string) $row['text'],
            createdAt: (string) $row['created_at'],
        );
    }

    /**
     * @param array<int,array<string,mixed>> $rows
     * @return PageDto[]
     */
    public function toDtoListFromRows(array $rows): array
    {
        $result = [];
        foreach ($rows as $row) {
            $result[] = $this->toDtoFromRow($row);
        }
        return $result;
    }
}
