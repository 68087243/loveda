<?php

function getClubnameByCid($cid){
    if(is_number($cid)){
        $club = \Common\Model\ClubModel::getClubById($cid);
        if(!empty($club)){
            return $club['clubname'];
        }else{
            return false;
        }
    }else{
        return false;
    }
}

/**
 * 判断请求是否为空
 */
function isN($C_char = null) {
    if (isset ( $C_char )) {
        if (strlen ( $C_char ) > 0)
            return false; // 是否是字符串类型
    }
    if (empty ( $C_char ))
        return true; // 是否已设定
    if ($C_char == '')
        return true; // 是否为空
    return true;
}

/**
 * 是否为整数
 * @param int $number
 * @return boolean
 */
function is_number($number){
    if(preg_match('/^[-\+]?\d+$/',$number)){
        return true;
    }else{
        return false;
    }
}

/**
 * 获取角色权限
 *
 * @param string $node
 * @return multitype:string number |multitype:string multitype:
 */
function get_role($node = 'channel') {
    if (isN ( session ( $node . '_role' ) )) {
        return array (
            'gt',
            0
        );
    } else {
        return array (
            'in',
            str2arr ( session ( $node . '_role' ) )
        );
    }
}


/**
 * 把返回的数据集转换成Tree
 * access public
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * return array
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0) {
    // 创建Tree
    $tree = array ();
    if (is_array ( $list )) {
        // 创建基于主键的数组引用
        $refer = array ();
        foreach ( $list as $key => $data ) {
            $refer [$data [$pk]] = & $list [$key];
        }
        foreach ( $list as $key => $data ) {
            // 判断是否存在parent
            $parentId = $data [$pid];
            if ($root == $parentId) {
                $tree [] = & $list [$key];
            } else {
                if (isset ( $refer [$parentId] )) {
                    $parent = & $refer [$parentId];
                    $parent [$child] [] = & $list [$key];
                }
            }
        }
    }
    return $tree;
}

?>