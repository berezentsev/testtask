<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UrlHelper\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class UrlController
 * @package App\Http\Controllers
 */
class UrlController extends Controller
{
    /**
     * @var UrlShortener
     */
    public $urlShortener;

    /**
     * UrlController constructor.
     * @param UrlShortener $urlShortener
     */
    public function __construct(UrlShortener $urlShortener)
    {
        $this->urlShortener = $urlShortener;
    }

    /**
     * Принимаем данные из запроса , генерируем строку для полученного url,
     * сохраняем в базу длинный и короткий url, возвращаем сформированный ответ, содержащий сгенерированную строку
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getShortUrl(Request $request)
	{
        $originalUrl = $request['originalUrl'];
        urlencode($originalUrl);
		if (!$originalUrl) {
			response()->json(['error'=>'Bad Request'], 400);
		}
		$urlShort = $this->urlShortener->getShortUrl();
		$this->urlShortener->saveUrl($urlShort, $originalUrl);

		$response = [
			'url' => url('/'.$urlShort)
		];

		return response()->json($response, 200, [], JSON_UNESCAPED_SLASHES);
	}

    /**
     * Редирект на оригинальный url, соответствующий полученной строке
     * @param $urlShort
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getOriginalUrl($urlShort)
	{
		$originalUrl = $this->urlShortener->getOriginalUrl($urlShort);

		return redirect($originalUrl);
	}
}