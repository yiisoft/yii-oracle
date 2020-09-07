<?php

declare(strict_types=1);

namespace Yiisoft\Db\Oracle\Tests;

use Yiisoft\Db\Data\DataReaderProvider;
use Yiisoft\Db\TestUtility\TestDataReaderProviderTrait;

/**
 * @group oracle
 */
final class DataReaderProviderTest extends TestCase
{
    use TestDataReaderProviderTrait;

    public function testGetModels(): void
    {
        $dataProvider = (new DataReaderProvider())
            ->sql('SELECT * FROM {{customer}}')
            ->db($this->getConnection(true));

        $this->assertCount(3, $dataProvider->getModels());
    }

    public function testTotalCount(): void
    {
        $dataProvider = (new DataReaderProvider())
            ->sql('SELECT * FROM {{customer}}')
            ->db($this->getConnection());

        $this->assertEquals(3, $dataProvider->getTotalCount());
    }

    public function testTotalCountWithParams(): void
    {
        $dataProvider = (new DataReaderProvider())
            ->sql('SELECT * FROM {{customer}} WHERE [[id]] > :minimum')
            ->params([':minimum' => -1])
            ->db($this->getConnection());

        $this->assertEquals(3, $dataProvider->getTotalCount());
    }
}