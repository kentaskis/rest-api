<?php
namespace api\modules\v1\resources;

use common\models\Currency;


class CurrencyResource extends Currency
{
    public function fields() : array
    {
        return [
            'id',
            'name',
            'rate' => static function (Currency $model) {
                return round( $model->nominal ? $model->rate / $model->nominal : $model->rate, 8);
            }
        ];
    }
}