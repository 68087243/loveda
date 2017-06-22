<?php
namespace Common\Model;

use Think\Model;

class GuestbookModel extends Model
{
	 const GUESTBOOK_MSG=1;//留言消息
	 const MOOD_MSG=2;//心情消息

    public static function addMsg($data){
        return D('guestbook')->add($data);
    }


}
