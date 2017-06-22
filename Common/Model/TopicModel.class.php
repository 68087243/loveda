<?php
namespace Common\Model;
use Think\Model;

class TopicModel extends Model
{

    const TYPE_TOPIC = 1;//帖子
    const TYPE_HUMOR = 2;//心情
    const TYPE_RICHKEPT = 3;//富豪包养
    const DEL = 2;//删除
    const NORMAL = 1;
    const KEY = 'LOVEHOU:TOPIC:';
    // 自动验证设置
    protected $_validate = array(
        array('cid', 'number', "请选择分类", Model::MUST_VALIDATE),
        array('title','require', "请填写标题", Model::MUST_VALIDATE),
        array('message','require', "请填写内容", Model::MUST_VALIDATE),
        array('uid','number', "请先登录", Model::MUST_VALIDATE),
    );


    /**
     * 添加
     * @param $data
     * @return bool
     */
    public static function addTopic($data){
        if(!empty($data)){
            if($id = M('topic')->add($data)){
                $key = self::KEY;
                S($key,null);
                return $id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function getTopicByid($tid){
        $con['tid'] = $tid;
        return M('topic')->where($con)->find();
    }

    public static function getTopicByTid($tid){
        if(regex($tid,'number')){
            $topic = self::getTopicByid($tid);
            if($topic['type'] == self::TYPE_TOPIC){
                if($topic['cid']){
                    $club = ClubModel::getClubById($topic['cid']);
                    $topic['clubname'] = $club['clubname'];
                }
                if($topic['uid']){
                    $club = UserModel::getUserById($topic['uid']);
                    $topic['avatar'] = $club['picture'];
                    $topic['level'] = $club['level'];
                    $topic['city'] = $club['city'];
                    $topic['priovce'] = $club['priovce'];
                }
               return $topic;
            }else{
                return $topic;
            }

        }else{
            return false;
        }
    }

    /**
     * 根据cid获取帖子
     * @param $cid
     * @param int $limit
     * @return bool|mixed
     */
    public static function getTopicByCid($cid,$limit=0){
        if(regex($cid,'number')){
            $con['t.type'] = self::TYPE_TOPIC;
            $con['t.cid'] = $cid;
            $order = 't.read desc,t.likeit desc,t.comments desc'; //阅读 点赞，评论
            $sql = M('topic')->alias('t')->join('t_member as m on t.uid = m.uid')
                ->where($con)->field('t.*,m.picture as avatar')->order($order);

            if($limit>0){
                return $sql->limit(0,$limit)->select();
            }else{
                return $sql->select();
            }
        }else{
            return false;
        }
    }

    /**
     * 根据cid获取帖子
     * @param $cid
     * @param int $limit
     * @return bool|mixed
     */
    public static function getTopic($order='id desc',$limit=0){
        $con['type'] = self::TYPE_TOPIC;
        $sql = M('topic')->where($con)->order($order);
        if($limit>0){
            return $sql->limit(0,$limit)->select();
        }else{
            return $sql->select();
        }

    }

    public static function delTopic($tid,$uid){
        if(regex($tid,'number')){
            $topic = self::getTopicByid($tid);
            if(!$topic){
                apiReturn(CodeModel::ERROR,'删除目标不存在！');
            }
            if($topic['uid'] !=$uid){
                apiReturn(CodeModel::ERROR,'该帖子不是你的，你无权操作');
            }
            $savedata['status'] = self::DEL;
            return self::modifyTopic($tid,$savedata);
        }else{
            return false;
        }
    }

    /**
     * 获取用户发表的帖子信息
     * @param $uid
     * @param int $type 1帖子 2心情
     * @param string $row 获取一个或全部
     * @return bool
     */
    public static function getTopicByUid($uid,$type=self::TYPE_TOPIC,$row='all'){
        if(regex($uid,'number')){
            $con['t.type'] = $type;
            $con['t.uid'] = $uid;
            $con['t.status'] = array('neq',self::DEL);
            if($row!='all'){
                return M('topic')->alias('t')->join('t_club as c on t.cid = c.cid')
                    ->where($con)->field('t.*,c.clubname')->order('tid desc')->find();
            }else{
                return M('topic')->alias('t')->join('t_club as c on t.cid = c.cid')
                    ->where($con)->field('t.*,c.clubname')->order('tid desc')->select();
            }
        }else{
            return false;
        }
    }

    public static function modifyTopic($tid,$data){
        if($tid && !empty($data)){
            $con['tid'] = $tid;
           return M('topic')->where($con)->save($data);
        }else{
            return false;
        }
    }

    public static function checkIfCanReply($tid){
        $topic= self::getTopicByTid($tid);
        if(empty($topic)){
            apiReturn(CodeModel::ERROR,"该帖子已被删除");
        }else{
            if($topic['status'] == self::DEL){
                apiReturn(CodeModel::ERROR,"该帖子已被关闭");
            }
            if($topic['cid']){
                $club = ClubModel::getClubById($topic['cid']);
                if(empty($club)){
                    apiReturn(CodeModel::ERROR,"该帖子所在分组已关闭");
                }
            }
        }
    }



}
