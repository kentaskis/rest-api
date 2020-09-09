<?php

namespace common\models\queries;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\Currency]].
 *
 * @see \common\models\Currency
 */
class CurrencyQuery extends ActiveQuery
{

    public function byCode(int $code): CurrencyQuery
    {
        return $this->andWhere(['code' => $code]);
    }

}
