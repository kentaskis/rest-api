<?php
namespace api\modules\v1\models\forms;

use api\modules\v1\resources\UserResource as User;
use Yii;
use yii\base\Exception;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public string $username;
    public string $password;
    public bool $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules() : array
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     */
    public function validatePassword($attribute) : void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     * @throws Exception
     */
    public function login() : bool
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if($user && Yii::$app->user->login($user)) {
                $user->generateAuthKey();
                $user->generateAccessToken();
                $user->save();
                return true;
            }
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser() : ?User
    {

        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
