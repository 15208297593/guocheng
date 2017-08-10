<?php
/**
 * 后台Index相关
 */
namespace Pc\Controller;
use Think\Controller;
class IndexController{
    
    public function index(){

//        $news = D('News')->maxcount();
//        $newscount = D('News')->getNewsCount(array('status'=>1));
//        $positionCount = D('Position')->getCount(array('status'=>1));
//        $adminCount = D("Admin")->getLastLoginUsers();
//
//        $this->assign('news', $news);
//        $this->assign('newscount', $newscount);
//        $this->assign('positioncount', $positionCount);
//        $this->assign('admincount', $adminCount);
//        $this->display();
        $result = array(
            'status' => 1,
            'message' => '获取接口数据成功',
            'data' => '',
        );
        exit(json_encode($result));
    }

}