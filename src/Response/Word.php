<?php

namespace Demeyerthom\OcrSpace\Response;

use JMS\Serializer\Annotation as JMS;

/**
 * Class Word
 */
class Word
{
    /**
     * This contains the text of that specific word
     *
     * @JMS\SerializedName("WordText")
     * @JMS\Type("string")
     *
     * @var string
     */
    protected $text;

    /**
     * Contains the distance (in px) of the word from the left edge of the image
     *
     * @JMS\SerializedName("Left")
     * @JMS\Type("float")
     *
     * @var float
     */
    protected $left;

    /**
     * Contains the distance (in px) of the word from the top edge of the image
     *
     * @JMS\SerializedName("Top")
     * @JMS\Type("float")
     *
     * @var float
     */
    protected $top;

    /**
     * Contains the height (in px) of the word
     *
     * @JMS\SerializedName("Height")
     * @JMS\Type("float")
     *
     * @var float
     */
    protected $height;

    /**
     * Contains the width (in px) of the word
     *
     * @JMS\SerializedName("Width")
     * @JMS\Type("float")
     *
     * @var float
     */
    protected $width;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return float
     */
    public function getLeft(): float
    {
        return $this->left;
    }

    /**
     * @return float
     */
    public function getTop(): float
    {
        return $this->top;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }
}