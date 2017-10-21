<?php

namespace Demeyerthom\OcrSpace\Response;

use JMS\Serializer\Annotation as JMS;

/**
 * Class TextOverlay
 */
class TextOverlay
{
    /**
     * This contains an array of all the lines. Each line will contain an array of words
     *
     * @JMS\SerializedName("Lines")
     * @JMS\Type("array<Demeyerthom\OcrSpace\Response\Line>")
     *
     * @var Line[]
     */
    protected $lines;

    /**
     * @JMS\SerializedName("HasOverlay")
     * @JMS\Type("boolean")
     *
     * @var boolean
     */
    protected $overlay;

    /**
     * @JMS\SerializedName("Message")
     * @JMS\Type("string")
     *
     * @var string
     */
    protected $message;

    /**
     * @return Line[]
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * @return bool
     */
    public function isOverlay(): bool
    {
        return $this->overlay;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}