<?php

namespace Demeyerthom\OcrSpace\Test;

use Demeyerthom\OcrSpace\Ocr;
use Demeyerthom\OcrSpace\OcrBuilder;
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
        $service = OcrBuilder::create(['apiKey' => 'test'])->setLogger($this->createMock(LoggerInterface::class))->build();

        static::assertInstanceOf(Ocr::class, $service);
        static::assertInstanceOf(CommandBus::class, $service->getCommandBus());
    }
}