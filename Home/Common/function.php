<?php
function getTopicByCid($cid,$limit=0){
    if(regex($cid,'number')){
        return \Common\Model\TopicModel::getTopicByCid($cid,$limit);
    }
    return false;
}

function getTopicByHot($limit=0){
    $order ='`rank` desc,`read` desc,`likeit` desc,`comments` desc '; //后台排序，阅读 点赞，评论
    return \Common\Model\TopicModel::getTopic($order,$limit);
}
//获取用户体型
function getUserShape($shape){
    switch($shape){
        case 1 : return '苗条';break;
        case 2 : return '匀称';break;
        case 3 : return '肌肉发达';break;
        case 4 : return '中等';break;
        case 5 : return '结实有型';break;
        case 6 : return '微胖';break;
        case 7 : return '魁梧';break;
        case 8 : return '丰满(性感/曲线动人)';break;
        default:return false;
    }
}

//获取用户体型
function getcontact($mainwink){
    switch($mainwink){
        case 1 : return '请查看我的个人简介，看看是否感兴趣联络我。如果您感兴趣请给我一个"传情"，我将会主动联络你！';break;
        case 2 : return '请在你的个人简介里贴上一张相片。或者授予金匙给我浏览私人相簿中的相片。谢谢。';break;
        case 3 : return '我收到你的讯息，我将会在升级会员套餐後尽快与你联络。';break;
        case 4 : return '你真正打动我的是...';break;
        case 5 : return '我迫不及待地想告诉你...';break;
        default:return false;
    }
}

//根据出生日期获取年龄
function getAge($birthday) {
    $age = 0;
    $year = $month = $day = 0;
    if (is_array($birthday)) {
        extract($birthday);
    } else {
        if (strpos($birthday, '-') !== false) {
            list($year, $month, $day) = explode('-', $birthday);
            $day = substr($day, 0, 2);
        }
    }
    $age = date('Y') - $year;
    if (date('m') < $month || (date('m') == $month && date('d') < $day)) $age--;
    return $age;
}

//根据年龄获取出生日期
function getBirthday($age) {
    return date('Y-m',strtotime("- $age year")).'-00';
}

//根据出生日期获取星座
function get_constellation($birthday){
    //判断的时候，为避免出现1和true的疑惑，或是判断语句始终为真的问题，这里统一处理成字符串形式
    list($birth_year,$birth_month,$birth_date) = explode('-',$birthday);
    $birth_month = strval($birth_month);
    $constellation_name = array(
        '水瓶座','双鱼座','白羊座','金牛座','双子座','巨蟹座',
        '狮子座','处女座','天秤座','天蝎座)','射手座','摩羯座'
    );
    if ($birth_date <= 22){
        if ('1' !== $birth_month){
            $constellation = $constellation_name[$birth_month-2];
        }else{
            $constellation = $constellation_name[11];
        }
    } else{
        $constellation = $constellation_name[$birth_month-1];
    }
    return $constellation;
}

function getUsername($uid){
    $user = \Common\Model\UserModel::getUserById($uid);
    if($user){
        return $user['nickname'];
    }else{
        return false;
    }
}
?>