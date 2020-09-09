<?php

namespace api\modules\v1\controllers;

use api\modules\v1\resources\CurrencyResource;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\rest\Serializer;

/**
 * Currency Controller API
 *
 */
class CurrencyController extends ActiveController
{

    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items',
    ];

    public $modelClass = CurrencyResource::class;

    public function behaviors() : array
    {
        return [
            'authenticator' => ['class' => HttpBearerAuth::class]
        ];
    }
}


