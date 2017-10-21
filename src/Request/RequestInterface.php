<?php

namespace Demeyerthom\OcrSpace\Request;

/**
 * Interface RequestInterface
 */
interface RequestInterface
{
    const LANGUAGE_ENGLISH = 'eng';
    const LANGUAGE_DUTCH = 'dut';

    const LANGUAGES = [
        self::LANGUAGE_ENGLISH,
        self::LANGUAGE_DUTCH
    ];

    const FILE_TYPE_JPG = 'jpg';
    const FILE_TYPE_PDF = 'pdf';
    const FILE_TYPE_PNG = 'png';
    const FILE_TYPE_GIF = 'gif';

    const FILE_TYPES = [
        self::FILE_TYPE_GIF,
        self::FILE_TYPE_JPG,
        self::FILE_TYPE_PDF,
        self::FILE_TYPE_PNG
    ];
}