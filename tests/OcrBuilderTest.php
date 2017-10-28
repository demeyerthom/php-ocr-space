<?php

namespace Demeyerthom\OcrSpace\Test;

use Demeyerthom\OcrSpace\OcrApi;
use Demeyerthom\OcrSpace\OcrApiBuilder;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

/**
 * Class OcrBuilderTest
 */
class OcrBuilderTest extends TestCase
{
    public function testBuild()
    {
        $service = OcrApiBuilder::create(['key' => 'test'])
            ->setLogger($this->createMock(LoggerInterface::class))
            ->build();

        static::assertInstanceOf(OcrApi::class, $service);
        static::assertInstanceOf(CommandBus::class, $service->getCommandBus());
    }
}