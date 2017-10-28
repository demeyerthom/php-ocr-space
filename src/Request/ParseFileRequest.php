<?php

namespace Demeyerthom\OcrSpace\Request;

use Demeyerthom\OcrSpace\Exception\InvalidArgumentException;

/**
 * Class ParseFileRequest
 */
class ParseFileRequest implements RequestInterface
{
    /**
     * @var string
     */
    protected $fileLocation;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $fileExtension;

    /**
     * @var string
     */
    protected $language = self::LANGUAGE_ENGLISH;

    /**
     * @var boolean
     */
    protected $overlayRequired = false;

    /**
     * @var boolean
     */
    protected $createSearchablePdf = false;

    /**
     * @var boolean
     */
    protected $searchablePdfHideTextLayer = false;

    /**
     * ParseImageRequest constructor.
     *
     * @param string $fileLocation
     */
    public function __construct(string $fileLocation)
    {
        $this->fileLocation = $fileLocation;
        $parts = pathinfo($fileLocation);
        if(!isset($parts['filename']) || !isset($parts['extension'])){
            throw new InvalidArgumentException('Mo or invalid filename provided');
        }
        $this->fileName = $parts['filename'];
        $this->setFileExtension($parts['extension']);
    }

    /**
     * @param string $fileExtension
     */
    public function setFileExtension(string $fileExtension)
    {
        if (!in_array($fileExtension, static::FILE_TYPES)) {
            throw new InvalidArgumentException(sprintf('Invalid file type provided: `%s`', $fileExtension));
        }
        $this->fileExtension = $fileExtension;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language)
    {
        if (!in_array($language, static::LANGUAGES)) {
            throw new InvalidArgumentException(sprintf('Invalid language provided: `%s`', $language));
        }
        $this->language = $language;
    }

    /**
     * @param bool $overlayRequired
     */
    public function setOverlayRequired(bool $overlayRequired)
    {
        $this->overlayRequired = $overlayRequired;
    }

    /**
     * @param bool $createSearchablePdf
     */
    public function setCreateSearchablePdf(bool $createSearchablePdf)
    {
        $this->createSearchablePdf = $createSearchablePdf;
    }

    /**
     * @param bool $searchablePdfHideTextLayer
     */
    public function setSearchablePdfHideTextLayer(bool $searchablePdfHideTextLayer)
    {
        $this->searchablePdfHideTextLayer = $searchablePdfHideTextLayer;
    }

    /**
     * @return string
     */
    public function getFileLocation(): string
    {
        return $this->fileLocation;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getFileExtension(): string
    {
        return $this->fileExtension;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return bool
     */
    public function isOverlayRequired(): bool
    {
        return $this->overlayRequired;
    }

    /**
     * @return bool
     */
    public function isCreateSearchablePdf(): bool
    {
        return $this->createSearchablePdf;
    }

    /**
     * @return bool
     */
    public function isSearchablePdfHideTextLayer(): bool
    {
        return $this->searchablePdfHideTextLayer;
    }
}