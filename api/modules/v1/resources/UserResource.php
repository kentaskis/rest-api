<?php
namespace api\modules\v1\resources;


use common\models\User;

class UserResource extends User
{

    public function fields() : array
    {
        return ['id','username','email','access_token','status','created_at','updated_at'];
    }
}