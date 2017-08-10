<?php
/**
 * AccessControl.php
 * Created by oo
 * Created on 2017/7/21 9:49
 */
//==============================================================================================================
// 返回JSON数据格式到客户端 包含状态信息
    header('Content-Type:application/json; charset=utf-8');
    header('Access-Control-Allow-Origin:*');
// 响应类型
    header('Access-Control-Allow-Methods:*');
// 响应头设置
    header('Access-Control-Allow-Headers:Origin, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');