<?php

namespace App\Logger;

use Doctrine\DBAL\Logging\SQLLogger;
use function tempnam;

class Query implements SQLLogger
{
    private float $start = 0;
    private array $queries = [];
    private int $currentQuery = 0;
    private string $logFile;

    public function __construct()
    {
        $this->logFile = tempnam(sys_get_temp_dir(), "sql-log");
    }

    /**
     * @inheritDoc
     */
    public function startQuery($sql, ?array $params = null, ?array $types = null)
    {
        $this->start = microtime(true);

        $this->queries[++$this->currentQuery] = [
            'sql' => $sql,
            'params' => $params,
            'types' => $types,
            'executionMS' => 0,
        ];
    }

    /**
     * @inheritDoc
     */
    public function stopQuery()
    {
        $query = $this->queries[$this->currentQuery];
        $query['executionMS'] = microtime(true) - $this->start;
        $data = json_encode($query) . PHP_EOL;
        file_put_contents($this->logFile, $data, FILE_APPEND);
    }
}
