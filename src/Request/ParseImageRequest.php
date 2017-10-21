<?php

namespace Demeyerthom\OcrSpace\Request;

/**
 * Class ParseImageRequest
 */
class ParseImageRequest implements RequestInterface
{
    /**
     * @var string
     */
    protected $fileName;

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
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language)
    {
        if (!in_array($language, static::LANGUAGES)) {
            throw new \InvalidArgumentException(sprintf('Invalid language provided: `%s`', $language));
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
    public function getFileName(): string
    {
        return $this->fileName;
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