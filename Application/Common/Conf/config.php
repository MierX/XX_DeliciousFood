<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'df', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '123456', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE,
    'UPLOAD_IMG' => array(
        'maxSize' => 553145728,
        'rootPath' => IMAGES_PATH,
        'savePath' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR,
        'saveName' => array('time', 'YmdHis'),
        'autoSub' => false,
        'replace' => true,
        'exts' => array('jpg', 'gif', 'png', 'jpeg', 'mp4', 'avi', 'wmv', 'm4v'),
    ),
);