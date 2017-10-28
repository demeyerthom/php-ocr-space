<?php

namespace Demeyerthom\OcrSpace\Test\Handler;

use Demeyerthom\OcrSpace\Handler\ParseFileHandler;
use Demeyerthom\OcrSpace\Request\ParseFileRequest;
use Demeyerthom\OcrSpace\Response\ParseImageResponse;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

/**
 * Class ParseFileHandlerTest
 */
class ParseFileHandlerTest extends TestCase
{
    public function testSuccessfulRequest()
    {
        $client = $this->createMock(Client::class);
        $serializer = $this->createMock(Serializer::class);
        $logger = $this->createMock(LoggerInterface::class);

        $handler = new ParseFileHandler($client, $serializer, $logger);

        $request = new ParseFileRequest(__DIR__ .'/../examples/images/example.jpg');

        $response = $handler($request);

        static::assertInstanceOf(ParseImageResponse::class, $response);
    }

}