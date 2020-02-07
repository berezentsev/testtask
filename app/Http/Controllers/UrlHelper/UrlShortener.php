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
     * Генерация короткой строки
     * @return string
     */
    public function getShortUrl(): string
    {
        return substr(str_shuffle(self::PERMITTED_CHARS), 0, 10);
    }

    /**
     * Сохранение в базу оригинального url и соответствующей ему короткой строки
     * @param string $urlShort
     * @param string $originalUrl
     */
    public function saveUrl($urlShort, $originalUrl)
    {
        $this->urlRepo->saveUrl($urlShort, $originalUrl);
    }

    /**
     * Возвращаем оригинальный url
     * @param $urlShort
     * @return string
     */
    public function getOriginalUrl($urlShort)
    {
        return $this->urlRepo->getOriginalUrl($urlShort);
    }
}