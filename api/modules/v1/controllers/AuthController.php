<?php
namespace api\modules\v1\controllers;


use api\modules\v1\models\forms\LoginForm;
use common\models\User;
use yii\base\Exception;
use yii\rest\Controller;

class AuthController extends Controller
{

    /**
     * @return User
     * @throws Exception
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        $model->setAttributes(\Yii::$app->request->bodyParams);
        if ($token = $model->login()) {
            return $model->getUser();
        }
        return $model;
    }

}