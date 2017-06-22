<?php

namespace Admin\Controller;

use Think\Controller;

class BaseController extends Controller {
	public function _initialize() {
		// 加入权限判断
		$this->checkLogin ();
	}

	private function checkLogin() {
		// 用户权限检查
        //session('adminname')
		if (C ( 'USER_AUTH_ON' ) && ! in_array ( MODULE_NAME, explode ( ',', C ( 'NOT_AUTH_MODULE' ) ) )) {
			$Rbac = new \Org\Util\Rbac ();
			if (!$Rbac->AccessDecision ()) {
				// 检查认证识别号
				if (! session ( C ( 'USER_AUTH_KEY' ) )) {
					// 跳转到认证网关
					redirect ( PHP_FILE . C ( 'USER_AUTH_GATEWAY' ) );
				}
				// 提示错误信息
				$this->error ( "对不起，您的权限不足！" );
			}
		}
	}
}
?>