<?php

namespace common\models;

use common\models\queries\CurrencyQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $rate
 * @property int|null $nominal
 * @property int|null $code
 */
class Currency extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName() : string
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() : array
    {
        return [
            [['rate'], 'number'],
            [['nominal', 'code'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() : array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'rate' => 'Rate',
            'nominal' => 'Nominal',
            'code' => 'Code',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CurrencyQuery the active query used by this AR class.
     */
    public static function find() : CurrencyQuery
    {
        return new CurrencyQuery(static::class);
    }
}
