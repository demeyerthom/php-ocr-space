<?php

namespace Demeyerthom\OcrSpace;

use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use Namshi\Cuzzle\Middleware\CurlFormatterMiddleware;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Demeyerthom\OcrSpace\Handler\ParseFileHandler;
use Demeyerthom\OcrSpace\Request\ParseFileRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use JMS\Serializer\SerializerBuilder;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Logger\Formatter\ClassNameFormatter;
use League\Tactician\Logger\LoggerMiddleware;
use League\Tactician\Plugins\LockingMiddleware;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class OcrApiBuilder
 */
class OcrApiBuilder
{
    const URL = 'http://api.ocr.space';

    /**
     * @var array
     */
    protected static $defaults = [
        'debug' => false
    ];

    /**
     * @var array
     */
    protected $settings;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * OcrApiBuilder constructor.
     *
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = $this->resolve($settings);
    }

    /**
     * @param $settings
     *
     * @return array
     */
    protected function resolve($settings): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults(static::$defaults);
        $resolver->setRequired('key');

        return $resolver->resolve($settings);
    }

    /**
     * @param array $settings
     *
     * @return OcrApiBuilder
     */
    public static function create(array $settings): self
    {
        return new static($settings);
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
        $stack->setHandler(new CurlHandler());
        $stack->push(Middleware::mapRequest(function (RequestInterface $request) {
            return $request->withHeader('apikey', $this->settings['key']);
        }));

        return new Client(
            [
                'base_uri' => static::URL,
                'handler' => $stack,
                'http_errors ' => true,
                'debug' => $this->settings['debug']
            ]
        );
    }

    public function build(): OcrApi
    {
        $serializer = SerializerBuilder::create()->build();
        $client = $this->buildClient();

        $handlers = [
            ParseFileRequest::class => new ParseFileHandler($client, $serializer, $this->getLogger())
        ];

        $commandHandlerMiddleware = new CommandHandlerMiddleware(
            new ClassNameExtractor(),
            new InMemoryLocator($handlers),
            new InvokeInflector()
        );
        $lockingMiddleware = new LockingMiddleware();
        $loggerMiddleware = new LoggerMiddleware(new ClassNameFormatter(), $this->getLogger());

        $commandBus = new CommandBus([
            $loggerMiddleware,
            $lockingMiddleware,
            $commandHandlerMiddleware
        ]);

        return new OcrApi($commandBus);
    }
}