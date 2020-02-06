<?php

namespace App\dburl\models;

/**
 * Class Url
 * @package App\dburl\models
 *
 * @property int $id
 * @property string $originalUrl
 * @property string $urlShort
 */
class Url extends BaseModel
{
	protected $table = 'urldata';
}