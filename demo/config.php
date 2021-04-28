<?php

/* 数据库连接配置 */
$com = new mysqli('8.131.224.91', 'blog', 'Gfy7758258', 'test');
    if ($com->connect_errno) {
        die('数据库连接失败');
    };
$com->query("set names utf8");
