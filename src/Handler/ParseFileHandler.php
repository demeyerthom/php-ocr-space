<?php

namespace Demeyerthom\OcrSpace\Handler;

use Demeyerthom\OcrSpace\Exception\ClientException;
use Demeyerthom\OcrSpace\Exception\ParseException;
use Demeyerthom\OcrSpace\Request\ParseFileRequest;
use Demeyerthom\OcrSpace\Response\ParseImageResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use JMS\Serializer\Serializer;
use Psr\Log\LoggerInterface;

/**
 * Class ParseFileHandler
 */
class ParseFileHandler
{
    const URI = '/parse/image';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * ParseImageHandler constructor.
     *
     * @param Client $client
     * @param Serializer $serializer
     * @param LoggerInterface $logger
     */
    public function __construct(Client $client, Serializer $serializer, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    /**
     * @param ParseFileRequest $request
     *
     * @return ParseImageResponse
     */
    public function __invoke(ParseFileRequest $request): ParseImageResponse
    {
        $multipart[] = [
            'name' => 'file',
            'contents' => fopen($request->getFileLocation(), 'r'),
            'filename' => $request->getFileName()
        ];
        $multipart[] = [
            'name' => 'filetype',
            'contents' => $request->getFileExtension()
        ];
        $multipart[] = [
            'name' => 'language',
            'contents' => $request->getLanguage()
        ];
        $multipart[] = [
            'name' => 'isOverlayRequired',
            'contents' => $request->isOverlayRequired() ? 'true' : 'false'
        ];
        $multipart[] = [
            'name' => 'isCreateSearchablePdf',
            'contents' => $request->isCreateSearchablePdf() ? 'true' : 'false'
        ];
        $multipart[] = [
            'name' => 'isSearchablePdfHideTextLayer',
            'contents' => $request->isSearchablePdfHideTextLayer() ? 'true' : 'false'
        ];

        try {
            $response = $this->client->post(static::URI, ['multipart' => $multipart]);
        } catch (TransferException $e) {
            $exception = new ClientException(sprintf('A client exception occurred: %s', $e->getMessage()), 0, $e);
            $this->logger->error($exception->getMessage(), ['exception' => $exception, 'params' => $multipart]);
            throw $exception;
        }

        $response = $this->serializer->deserialize($response->getBody()->getContents(), ParseImageResponse::class, 'json');

        /** @var ParseImageResponse $response */
        if ($response->isErroredOnProcessing()) {
            $exception = new ParseException(sprintf("A parsing exception occurred: %s", $response->getErrorMessage()[0]));
            $this->logger->error($exception->getMessage(), ['exception' => $exception, 'params' => $multipart]);
            throw $exception;
        }

        return $response;
    }
}