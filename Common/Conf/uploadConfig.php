<?php
return array(
    'topic' => array(
        'savepath'    => "/topic/",
        'allowExts'         =>  array("jpg","gif","png","jpeg"),
        'subType'           =>  'date',   // 子目录创建方式 可以使用hash date
        'dateFormat'        =>  'Ym',
       // 'fixedWidth' =>400,缩略图尺寸
        //'fixedHeight'=>300,
        'uploadReplace'     =>  true,     // 存在同名是否覆盖
        'saveRule'          =>  'uniqid', // 上传文件命名规则
    ),
    'avatar' => array(
        'savepath'    => "/avatar/",
        'allowExts'         =>  array("jpg","gif","png","jpeg"),
        'subType'           =>  'date',   // 子目录创建方式 可以使用hash date
        'dateFormat'        =>  'Ym',
        'uploadReplace'     =>  true,     // 存在同名是否覆盖
        'saveRule'          =>  'uniqid', // 上传文件命名规则
    ),
    'photo' => array(
        'savepath'    => "/photo/",
        'allowExts'         =>  array("jpg","gif","png","jpeg"),
        'subType'           =>  'date',   // 子目录创建方式 可以使用hash date
        'dateFormat'        =>  'Ym',
       // 'fixedWidth' =>400,//缩略图尺寸
        //'fixedHeight'=>500,
        'uploadReplace'     =>  true,     // 存在同名是否覆盖
        'saveRule'          =>  'uniqid', // 上传文件命名规则
    ),
    'pyplan' => array(
        'savepath'    => "/pyplan/",
        'allowExts'         =>  array("jpg","gif","png","jpeg"),
        'subType'           =>  'date',   // 子目录创建方式 可以使用hash date
        'dateFormat'        =>  'Ym',
        'uploadReplace'     =>  true,     // 存在同名是否覆盖
        'saveRule'          =>  'uniqid', // 上传文件命名规则
    ),
    'banner' => array(
        'savepath'    => "/pyplan/",
        'allowExts'         =>  array("jpg","gif","png","jpeg"),
        'subType'           =>  'date',   // 子目录创建方式 可以使用hash date
        'dateFormat'        =>  'Ym',
        'uploadReplace'     =>  true,     // 存在同名是否覆盖
        'saveRule'          =>  'uniqid', // 上传文件命名规则
    ),


);