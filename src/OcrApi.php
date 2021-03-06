<?php

namespace Demeyerthom\OcrSpace;

use Demeyerthom\OcrSpace\Request\RequestInterface;
use Demeyerthom\OcrSpace\Response\ResponseInterface;
use League\Tactician\CommandBus;

/**
 * Class OcrApi
 */
class OcrApi
{
    /**
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * OcrApi constructor.
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param RequestInterface $request
     *
     * @return mixed
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        return $this->commandBus->handle($request);
    }

    /**
     * @return CommandBus
     */
    public function getCommandBus(): CommandBus
    {
        return $this->commandBus;
    }
}