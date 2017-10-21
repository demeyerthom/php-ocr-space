<?php

namespace Demeyerthom\OcrSpace\Response;

use JMS\Serializer\Annotation as JMS;

/**
 * Class ParseImageResponse
 */
class ParseImageResponse implements ResponseInterface
{
    /**
     * The OCR results for the image or for each page of PDF. For PDF: Each page has its own OCR result and error
     * message (if any)
     *
     * @JMS\SerializedName("ParsedResults")
     * @JMS\Type("array<Demeyerthom\OcrSpace\Response\ParsedResult>")
     *
     * @var ParsedResult[]
     */
    protected $parsedResults;

    /**
     * The exit code shows if OCR completed successfully, partially or failed with error
     *  1: Parsed Successfully (Image / All pages parsed successfully)
     *  2: Parsed Partially (Only few pages out of all the pages parsed successfully)
     *  3: Image / All the PDF pages failed parsing (This happens mainly because the OCR engine fails to parse an image)
     *  4: Error occurred when attempting to parse (This happens when a fatal error occurs during parsing )
     *
     * @JMS\SerializedName("OCRExistCode")
     * @JMS\Type("integer")
     *
     * @var integer
     */
    protected $ocrExitCode;

    /**
     *    If an error occurs when parsing the Image / PDF pages
     *
     * @JMS\SerializedName("IsErroredOnProcessing")
     * @JMS\Type("boolean")
     *
     * @var boolean
     */
    protected $erroredOnProcessing;

    /**
     * The error message of the error occurred when parsing the image
     *
     * @JMS\SerializedName("ErrorMessage")
     * @JMS\Type("array")
     *
     * @var array|null
     */
    protected $errorMessage;

    /**
     * Detailed error message
     *
     * @JMS\SerializedName("ErrorDetails")
     * @JMS\Type("string")
     *
     * @var string|null
     */
    protected $errorDetails;

    /**
     * See Searchable PDF (https://ocr.space/ocrapi#searchablepdf)
     *
     * @JMS\SerializedName("SearchablePDFUrl")
     * @JMS\Type("string")
     *
     * @var string|null
     */
    protected $searchablePDFURL;

    /**
     * Processing time of file in milliseconds
     *
     * @JMS\SerializedName("ProcessingTimeInMilliseconds")
     * @JMS\Type("integer")
     *
     * @var integer
     */
    protected $processingTimeInMilliseconds;

    /**
     * @return ParsedResult[]
     */
    public function getParsedResults(): array
    {
        return $this->parsedResults;
    }

    /**
     * @return int
     */
    public function getOcrExitCode(): int
    {
        return $this->ocrExitCode;
    }

    /**
     * @return bool
     */
    public function isErroredOnProcessing(): bool
    {
        return $this->erroredOnProcessing;
    }

    /**
     * @return null|array
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return null|string
     */
    public function getErrorDetails()
    {
        return $this->errorDetails;
    }

    /**
     * @return null|string
     */
    public function getSearchablePDFURL()
    {
        return $this->searchablePDFURL;
    }

    /**
     * @return int
     */
    public function getProcessingTimeInMilliseconds(): int
    {
        return $this->processingTimeInMilliseconds;
    }
}