<?php

declare(strict_types=1);

namespace App\Web\Page;

use App\Repository\BaseRepository;
use DateTimeImmutable;
use Exception;
use Throwable;

final class PageRepository extends BaseRepository
{
    private const TABLE = '{{%page}}';

    /**
     * Insert yoki Update
     */
    public function save(Page $page): void
    {
        $now = new DateTimeImmutable();

        $data = [
            'id'         => $page->id,
            'title'      => $page->title,
            'slug'       => $page->getSlug(),
            'text'       => $page->text,
            'created_at' => $page->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s'),
        ];

        if ($this->exists($page->id)) {
            $this->connection
                ->createCommand()
                ->update(self::TABLE, $data, ['id' => $page->id])
                ->execute();
        } else {
            $this->connection
                ->createCommand()
                ->insert(self::TABLE, $data)
                ->execute();
        }
    }

    /**
     * @throws Throwable
     */
    public function transactionalSave(Page $page): void
    {
        $this->transaction(function () use ($page) {
            $this->save($page);

            // kelajakda:
            // $this->logHistory($page);
            // $this->syncSearchIndex($page);
        });
    }

    /**
     * Slug orqali bitta page olish
     */
    public function findOneBySlug(string $slug): ?Page
    {
        return $this->hydrate(
            $this->query()
                ->from(self::TABLE)
                ->where(['slug' => $slug])
                ->one()
        );
    }

    /**
     * Barcha sahifalar
     *
     * @return iterable<Page>
     */
    public function findAll(): iterable
    {
        $rows = $this->query()
            ->from(self::TABLE)
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        foreach ($rows as $row) {
            yield $this->hydrate($row);
        }
    }

    /**
     * Pagination uchun
     *
     * @return array<int, array<string, mixed>>
     */
    public function findPage(int $limit, int $offset): array
    {
        return $this->query()
            ->from(self::TABLE)
            ->orderBy(['created_at' => SORT_DESC])
            ->limit($limit)
            ->offset($offset)
            ->all();
    }

    public function countAll(): int
    {
        return (int) $this->query()
            ->from(self::TABLE)
            ->count();
    }

    /**
     * Slug orqali o‘chirish
     */
    public function deleteBySlug(string $slug): void
    {
        $this->connection
            ->createCommand()
            ->delete(self::TABLE, ['slug' => $slug])
            ->execute();
    }

    /**
     * Page mavjudligini tekshirish
     */
    public function exists(string $id): bool
    {
        return $this->query()
            ->from(self::TABLE)
            ->where(['id' => $id])
            ->exists();
    }

    /**
     * DB row → Page Entity
     *
     * @throws Exception
     */
    private function hydrate(?array $row): ?Page
    {
        if ($row === null) {
            return null;
        }

        return Page::create(
            id: (string) $row['id'],
            title: (string) $row['title'],
            text: (string) $row['text'],
            createdAt: new DateTimeImmutable($row['created_at']),
            updatedAt: new DateTimeImmutable($row['updated_at']),
        );
    }
}
