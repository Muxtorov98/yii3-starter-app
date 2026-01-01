<?php

declare(strict_types=1);

namespace App\Migration;

use Yiisoft\Db\Exception\InvalidConfigException;
use Yiisoft\Db\Exception\NotSupportedException;
use Yiisoft\Db\Migration\MigrationBuilder;
use Yiisoft\Db\Migration\RevertibleMigrationInterface;

final class M260101182339Page implements RevertibleMigrationInterface
{
    /**
     * @throws InvalidConfigException
     * @throws NotSupportedException
     */
    public function up(MigrationBuilder $b): void
    {
        $b->createTable('page',
            [
                'id' => $b->uuidPrimaryKey(),
                'title' => $b->string(255)->notNull(),
                'slug' => $b->string(255)->notNull(),
                'text' => $b->text()->notNull(),
                'created_at' => $b->timestamp()->notNull(),
                'updated_at' => $b->timestamp()->notNull(),
            ],
        );
    }

    /**
     * @throws InvalidConfigException
     * @throws NotSupportedException
     */
    public function down(MigrationBuilder $b): void
    {
        $b->dropTable('page');
    }
}
