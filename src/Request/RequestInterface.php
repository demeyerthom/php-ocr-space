<?php

namespace Demeyerthom\OcrSpace\Request;

/**
 * Interface RequestInterface
 */
interface RequestInterface
{
    const LANGUAGE_ARABIC = 'ara';
    const LANGUAGE_BULGARIAN = 'bul';
    const LANGUAGE_CHINESE_SIMPLE = 'chs';
    const LANGUAGE_CHINESE_TRADITIONAL = 'cht';
    const LANGUAGE_CROATIAN = 'hrv';
    const LANGUAGE_DANISH = 'dan';
    const LANGUAGE_DUTCH = 'dut';
    const LANGUAGE_ENGLISH = 'eng';
    const LANGUAGE_FINNISH = 'fin';
    const LANGUAGE_FRENCH = 'fre';
    const LANGUAGE_GERMAN = 'ger';
    const LANGUAGE_GREEK = 'gre';
    const LANGUAGE_HUNGARIAN = 'hun';
    const LANGUAGE_KOREAN = 'kor';
    const LANGUAGE_ITALIAN = 'ita';
    const LANGUAGE_JAPANESE = 'jpn';
    const LANGUAGE_NORWEGIAN = 'nor';
    const LANGUAGE_POLISH = 'pol';
    const LANGUAGE_PORTUGUESE = 'por';
    const LANGUAGE_RUSSIAN = 'rus';
    const LANGUAGE_SLOVENIAN = 'slv';
    const LANGUAGE_SPANISH = 'spa';
    const LANGUAGE_SWEDISH = 'swe';
    const LANGUAGE_TURKISH = 'tur';

    /**
     * Available languages:
     *
     * Arabic=ara
     * Bulgarian=bul
     * Chinese(Simplified)=chs
     * Chinese(Traditional)=cht
     * Croatian = hrv
     * Czech = cze
     * Danish = dan
     * Dutch = dut
     * English = eng
     * Finnish = fin
     * French = fre
     * German = ger
     * Greek = gre
     * Hungarian = hun
     * Korean = kor
     * Italian = ita
     * Japanese = jpn
     * Norwegian = nor
     * Polish = pol
     * Portuguese = por
     * Russian = rus
     * Slovenian = slv
     * Spanish = spa
     * Swedish = swe
     * Turkish = tur
     */
    const LANGUAGES = [
        self::LANGUAGE_ARABIC,
        self::LANGUAGE_BULGARIAN,
        self::LANGUAGE_CHINESE_SIMPLE,
        self::LANGUAGE_CHINESE_TRADITIONAL,
        self::LANGUAGE_CROATIAN,
        self::LANGUAGE_DANISH,
        self::LANGUAGE_DUTCH,
        self::LANGUAGE_ENGLISH,
        self::LANGUAGE_FINNISH,
        self::LANGUAGE_FRENCH,
        self::LANGUAGE_GERMAN,
        self::LANGUAGE_GREEK,
        self::LANGUAGE_HUNGARIAN,
        self::LANGUAGE_KOREAN,
        self::LANGUAGE_ITALIAN,
        self::LANGUAGE_JAPANESE,
        self::LANGUAGE_NORWEGIAN,
        self::LANGUAGE_POLISH,
        self::LANGUAGE_PORTUGUESE,
        self::LANGUAGE_RUSSIAN,
        self::LANGUAGE_SLOVENIAN,
        self::LANGUAGE_SPANISH,
        self::LANGUAGE_SWEDISH,
        self::LANGUAGE_TURKISH,
    ];

    const FILE_TYPE_JPG = 'jpg';
    const FILE_TYPE_PDF = 'pdf';
    const FILE_TYPE_PNG = 'png';
    const FILE_TYPE_GIF = 'gif';

    /**
     * File types allowed
     */
    const FILE_TYPES = [
        self::FILE_TYPE_GIF,
        self::FILE_TYPE_JPG,
        self::FILE_TYPE_PDF,
        self::FILE_TYPE_PNG
    ];
}