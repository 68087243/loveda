<?php 
namespace Admin\Model;
use Think\Model;
 
class ChannelModel extends Model{

    protected $_validate = array(
        array('name', 'require', '栏目名称不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH), 
//    	array('name','','相同栏目名称已经存在！',self::EXISTS_VALIDATE,'unique', self::MODEL_BOTH),
    );

    protected $_auto = array(
//         array('model', 'arr2str', self::MODEL_BOTH, 'function'),
//         array('model', null, self::MODEL_BOTH, 'ignore'),
//         array('type', 'arr2str', self::MODEL_BOTH, 'function'),
//         array('type', null, self::MODEL_BOTH, 'ignore'),
//         array('reply_model', 'arr2str', self::MODEL_BOTH, 'function'),
//         array('reply_model', null, self::MODEL_BOTH, 'ignore'),
//         array('extend', 'json_encode', self::MODEL_BOTH, 'function'),
//         array('extend', null, self::MODEL_BOTH, 'ignore'),
//         array('create_time', NOW_TIME, self::MODEL_INSERT),
//         array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_INSERT),
        array('sorttype', '0', self::MODEL_INSERT),
    );


    public static function getChannel($rootid){
        $where['sortpath']= array('like','%,'.$rootid.',%');
        $where['status']= 1;
        $list = M ( "Channel" )->where($where)->order ( 'sort asc' )->select ();
        return list_to_tree ( $list );
    }
}
