<?php

namespace App\dburl\repositories;

use App\dburl\models\Url;

/**
 * Class UrlRepo
 * @package App\dburl\repositories
 */
class UrlRepo implements RepositoryInterface
{
    /**
     * Сохранение в базу оригинального url и соответствующей ему короткой строки
     * @param $urlShort
     * @param $originalUrl
     * @return bool
     */
    public function saveUrl($urlShort, $originalUrl)
	{
		$model = new Url();
		$model->originalUrl = urlencode($originalUrl);
		$model->urlShort = $urlShort;

		return $model->save();
	}

    /**Находим в базе url, соответствующий строке и возвращаем его
     * @param $urlShort
     * @return string
     */
    public function getOriginalUrl($urlShort)
	{
		$result = Url::where('urlShort', '=', $urlShort)->firstOrFail();

		return urldecode($result->originalUrl);
	}
}