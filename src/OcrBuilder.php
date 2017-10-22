<?php

namespace Demeyerthom\OcrSpace;

use Namshi\Cuzzle\Middleware\CurlFormatterMiddleware;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Demeyerthom\OcrSpace\Handler\ParseImageHandler;
use Demeyerthom\OcrSpace\Request\ParseImageRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use JMS\Serializer\SerializerBuilder;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use League\Tactician\Logger\Formatter\ClassNameFormatter;
use League\Tactician\Logger\LoggerMiddleware;
use League\Tactician\Plugins\LockingMiddleware;


/**
 * Class OcrBuilder
 */
class OcrBuilder
{
    /**
     * @var array
     */
    protected static $defaults = [];

    /**
     * @var array
     */
    protected $options;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * ServiceBuilder constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param array $options
     *
     * @return OcrBuilder
     */
    public static function create(array $options): self
    {
        return new static($options);
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        if ($this->logger === null) {
            $this->logger = new NullLogger();
        }

        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return $this
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @return Client
     */
    protected function buildClient(): Client
    {
        $stack = HandlerStack::create();
        $stack->after('cookies', new CurlFormatterMiddleware($this->getLogger()));
        $stack->setHandler(new CurlHandler());
        $stack->push(Middleware::mapRequest(function (RequestInterface $request) {
            return $request->withHeader('apikey', $this->options['apiKey']);
        }));

        return new Client(
            [
                'base_uri' => 'http://api.ocr.space',
                'handler' => $stack,
                'http_errors ' => true,
                'debug' => true
            ]
        );
    }

    public function build(): Ocr
    {
        $serializer = SerializerBuilder::create()->build();

        $client = $this->buildClient();

        $handlers = [
            ParseImageRequest::class => new ParseImageHandler($client, $serializer, $this->getLogger())
        ];

        $commandHandlerMiddleware = new CommandHandlerMiddleware(new ClassNameExtractor(), new InMemoryLocator($handlers), new HandleInflector());
        $lockingMiddleware = new LockingMiddleware();
        $loggerMiddleware = new LoggerMiddleware(new ClassNameFormatter(), $this->getLogger());

        $commandBus = new CommandBus([
            $loggerMiddleware,
            $lockingMiddleware,
            $commandHandlerMiddleware
        ]);

        return new Ocr($commandBus);
    }
}