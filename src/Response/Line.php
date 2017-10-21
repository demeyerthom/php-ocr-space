<?php

namespace Demeyerthom\OcrSpace\Response;

use JMS\Serializer\Annotation as JMS;

/**
 * Class Line
 */
class Line
{
    /**
     * This contains the words with the specific details of a word like its text and position
     *
     * @JMS\Type("array<Demeyerthom\OcrSpace\Response\Word>")
     * @JMS\SerializedName("Words")
     *
     * @var Word[]
     */
    protected $words;

    /**
     * Contains the height (in px) of the line
     *
     * @JMS\Type("float")
     * @JMS\SerializedName("MaxHeight")
     *
     * @var float
     */
    protected $maxHeight;

    /**
     * Contains the distance (in px) of the line from the top edge in the original size of image
     *
     * @JMS\Type("float")
     * @JMS\SerializedName("MinTop")
     *
     * @var float
     */
    protected $minTop;

    /**
     * @return Word[]
     */
    public function getWords(): array
    {
        return $this->words;
    }

    /**
     * @return float
     */
    public function getMaxHeight(): float
    {
        return $this->maxHeight;
    }

    /**
     * @return float
     */
    public function getMinTop(): float
    {
        return $this->minTop;
    }
}