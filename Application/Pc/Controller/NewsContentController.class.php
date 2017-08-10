<?php
/**
 * 后台Index相关
 */
namespace Pc\Controller;
use Think\Controller;
use Think\Exception;

/**
 * 文章内容管理
 */
class NewsContentController {

    public function index() {
        include 'AccessControl.php';
        $news_id = I('get.news_id');
        $newsModel = M('News');
        $newsContentModel = M('NewsContent');
        $news = $newsModel->where('news_id='.$news_id)->find();
        $newsContent = $newsContentModel->where('news_id='.$news_id)->find();
        $data = array(
            'news_id' => $news['news_id'],
            'title' => $news['title'],
            'create_time' => $news['update_time'],
            'newsContent' => $newsContent['content'],
        );
        $result = array(
            'data' => $data,
        );
        exit(json_encode($result));
    }
}