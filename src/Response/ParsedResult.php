<?php

namespace Demeyerthom\OcrSpace\Response;

use JMS\Serializer\Annotation as JMS;

/**
 * Class ParsedResult
 */
class ParsedResult
{
    /**
     * Overlay data for the text in the image/pdf. Only if 'isOverlayRequired' is set to 'True'
     *
     * @JMS\SerializedName("TextOverlay")
     * @JMS\Type("Demeyerthom\OcrSpace\Response\TextOverlay")
     *
     * @var TextOverlay
     */
    protected $textOverlay;

    /**
     * The exit code returned by the parsing engine
     *  0: File not found
     *  1: Success
     *  -10: OCR Engine Parse Error
     *  -20: Timeout
     *  -30: Validation Error
     *  -99: Unknown Error
     *
     * @JMS\SerializedName("FileParseExitCode")
     * @JMS\Type("integer")
     *
     * @var int
     */
    protected $fileParseExitCode;

    /**
     * The parsed text for an image
     *
     * @JMS\SerializedName("ParsedText")
     * @JMS\Type("string")
     *
     * @var string
     */
    protected $parsedText;

    /**
     * @return TextOverlay
     */
    public function getTextOverlay(): TextOverlay
    {
        return $this->textOverlay;
    }

    /**
     * @return int
     */
    public function getFileParseExitCode(): int
    {
        return $this->fileParseExitCode;
    }

    /**
     * @return string
     */
    public function getParsedText(): string
    {
        return $this->parsedText;
    }
}