<?php
namespace Admin\Model;

use Think\Model;

class UserModel extends Model {
    const NORMAL = 1;

	public static function getUsers(){
        $con['status'] = self::NORMAL;
        return M('user')->where($con)->select();
    }
}
