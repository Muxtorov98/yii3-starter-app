<?php

namespace App\Repository;

use Closure;
use Throwable;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Query\Query;

abstract class BaseRepository
{
    public function __construct(
        protected ConnectionInterface $connection,
    ) {}

    protected function query(): Query
    {
        return new Query($this->connection);
    }

    /**
     * @throws Throwable
     */
    protected function transaction(Closure $callback): mixed
    {
        return $this->connection->transaction($callback);
    }
}
