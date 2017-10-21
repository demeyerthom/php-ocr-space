<?php

namespace Demeyerthom\OcrSpace\Handler;

use Demeyerthom\OcrSpace\Exception\ClientException;
use Demeyerthom\OcrSpace\Exception\ParseException;
use Demeyerthom\OcrSpace\Request\ParseImageRequest;
use Demeyerthom\OcrSpace\Response\ParseImageResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use JMS\Serializer\Serializer;
use Psr\Log\LoggerInterface;

/**
 * Class ParseImageHandler
 */
class ParseImageHandler
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
     * @param ParseImageRequest $request
     *
     * @return ParseImageResponse
     */
    public function handle(ParseImageRequest $request): ParseImageResponse
    {
        $multipart[] = [
            'name' => 'file',
            'contents' => fopen($request->getFileName(), 'r'),
            'filename' => basename($request->getFileName())
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
            $response = $this->client->post(static::URI, [
                'multipart' => $multipart
            ]);
        } catch
        (TransferException $e) {
            throw new ClientException(sprintf('An exception occurred: %s', $e->getMessage()), 0, $e);
        }

        $response = $this->serializer->deserialize($response->getBody()->getContents(), ParseImageResponse::class, 'json');

        /** @var ParseImageResponse $response */
        if ($response->isErroredOnProcessing()) {
            throw new ParseException(sprintf("An exception occurred during parsing: %s", $response->getErrorMessage()[0]));
        }

        return $response;
    }

}