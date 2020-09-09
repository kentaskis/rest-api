<?php

namespace console\controllers;

use common\models\Currency;
use yii\console\Controller;

class CurrencyController extends Controller
{
    public function actionUpdate() : void
    {
        $curses = simplexml_load_string(file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp'));

        foreach ($curses->Valute as $valute) {
            if(!$currency = Currency::find()->byCode((int)$valute->NumCode)->one()) {
                $currency = new Currency();
            }
            $currency->code = (int)$valute->NumCode;
            $currency->nominal = (int)$valute->Nominal;
            $currency->rate = (float)str_replace(',','.',$valute->Value);
            $currency->name = (string) $valute->Name;
            $currency->save();
            unset($currency);
        }
    }
}