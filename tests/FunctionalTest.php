<?php

namespace Demeyerthom\OcrSpace\Test;

use Demeyerthom\OcrSpace\Request\ParseImageRequest;
use Demeyerthom\OcrSpace\Response\ParseImageResponse;
use Demeyerthom\OcrSpace\ServiceBuilder;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

/**
 * Class FunctionalTest
 *
 * @group functional
 */
class FunctionalTest extends TestCase
{
    public function testFunctional()
    {
        $handler = new TestHandler();
        $logger = new Logger('test', [$handler]);

        $service = ServiceBuilder::create([
            'apiKey' => 'helloworld'
        ])->setLogger($logger)->build();

        $request = new ParseImageRequest(__DIR__ . '/resources/53.jpg');
        $request->setLanguage(ParseImageRequest::LANGUAGE_DUTCH);

        $response = $service->handle($request);

        static::assertInstanceOf(ParseImageResponse::class, $response);
    }
}