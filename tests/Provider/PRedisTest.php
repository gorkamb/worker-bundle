<?php

namespace Riverline\WorkerBundle\Provider;

use PHPUnit\Framework\TestCase;
use Riverline\WorkerBundle\Queue\Queue;

/**
 * Class PRedisTest
 * @package Riverline\WorkerBundle\Provider
 */
class PRedisTest extends TestCase
{
    /**
     * @var Queue
     */
    private $queue;

    /**
     *
     */
    public function setUp()
    {
        // clean
        $this->queue = new Queue(
            'Test',
            new PRedis(
                [
                    'host' => "redis"
                ]
            )
        );

        $this->markTestSkipped("Tests should be fixed");
    }

    public function testPutArray(): void
    {
        $this->queue->put(['name' => 'Romain']);
    }

    public function testCount(): void
    {
        $count = $this->queue->count();

        self::assertEquals(1, $count);
    }

    public function testGetArray(): void
    {
        $workload = $this->queue->get();

        self::assertSame(['name' => 'Romain'], $workload);
    }

    public function testTimeout(): void
    {
        $tic = time();

        $this->queue->get(5);

        self::assertGreaterThan(5, time() - $tic);
    }

}
