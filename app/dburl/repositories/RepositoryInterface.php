<?php

namespace App\dburl\repositories;

/**
 * Interface RepositoryInterface
 * @package App\dburl\repositories
 */
interface RepositoryInterface
{
    /**
     * @return bool
     */
    public function saveUrl($urlShort, $originalUrl);

    /**
     * @return string
     */
    public  function getOriginalUrl($urlShort);
}