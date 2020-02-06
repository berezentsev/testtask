<?php

namespace App\Http\Controllers\UrlHelper;

use App\dburl\repositories\UrlRepo;

/**
 * Class UrlShortener
 * @package App\Http\Controllers\UrlHelper
 */
class UrlShortener
{
    const PERMITTED_CHARS = '0123456789abcdefghijklmnopqrstuvwxyz';

    /**
     * @var UrlRepo
     */
    public $urlRepo;

    /**
     * UrlShortener constructor.
     * @param UrlRepo $urlRepo
     */
    public function __construct(UrlRepo $urlRepo)
    {
        $this->urlRepo = $urlRepo;
    }

    /**
     * @return string
     */
    public function getShortUrl(): string
    {
        return substr(str_shuffle(self::PERMITTED_CHARS), 0, 10);
    }

    /**
     * @param string $urlShort
     * @param string $originalUrl
     */
    public function saveUrl($urlShort, $originalUrl)
    {
        $this->urlRepo->saveUrl($urlShort, $originalUrl);
    }

    /**
     * @param $urlShort
     * @return string
     */
    public function getOriginalUrl($urlShort)
    {
        return $this->urlRepo->getOriginalUrl($urlShort);
    }
}