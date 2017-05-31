<?php 
namespace Admin\Model;
use Think\Model;
 
class MemberModel extends Model{

    protected $_validate = array(
        array('nickname', 'require', '用户名不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('nickname', '', '用户名已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH)
    );

    protected $_auto = array( 
    		
    ); 

}
