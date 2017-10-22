<?php

namespace Demeyerthom\OcrSpace\Test;

use Demeyerthom\OcrSpace\Request\ParseImageRequest;
use Demeyerthom\OcrSpace\Response\ParseImageResponse;
use Demeyerthom\OcrSpace\OcrBuilder;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

/**
 * Class OcrTest
 */
class OcrTest extends TestCase
{
    /**
     * @group functional
     */
    public function testFunctional()
    {
        $testImages = array_diff(scandir(__DIR__ . '/examples/images'), ['.', '..']);
        $handler = new TestHandler();
        $logger = new Logger('test', [$handler]);

        $service = OcrBuilder::create([
            'apiKey' => 'helloworld'
        ])->setLogger($logger)->build();

        foreach ($testImages as $image) {
            $request = new ParseImageRequest(__DIR__ . '/examples/images/' . $image);

            /** @var ParseImageResponse $response */
            $response = $service->handle($request);

            static::assertInstanceOf(ParseImageResponse::class, $response);
            static::assertInstanceOf(ParseImageResponse::class, $response->getParsedResults()[0]);
        }
    }
}