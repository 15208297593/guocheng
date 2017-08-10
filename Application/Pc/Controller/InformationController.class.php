<?php
namespace Pc\Controller;
use \Pc\Controller\IndexController;
class InformationController extends IndexController 
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('Admin/Information');
    		if($model->create(I('post.'), 1))
    		{
    			if($id = $model->add())
    			{
//    				$this->success('添加成功！', U('index?p='.I('get.p')));
                    return show(1,'添加成功');
                    exit;
    			}
    		}
//    		$this->error($model->getError());
            return show(0,$model->getError());
    	}

		$this->display();
    }
    public function edit()
    {
    	$information_id = I('get.information_id');
    	if(IS_POST)
    	{
    		$model = D('Admin/Information');
    		if($model->create(I('post.'), 2))
    		{
    			if($model->save() !== FALSE)
    			{
//    				$this->success('修改成功！', U('index', array('p' => I('get.p', 1))));
                    return show(1,'修改成功');
    				exit;
    			}
    		}
            return show(0,$model->getError());
//    		$this->error($model->getError());
    	}
    	$model = M('Information');
    	$fileModel = M('Fileinformation');
    	$files = $fileModel->where('information_id='.$information_id)->select();
    	$data = $model->find($information_id);
    	$data = $model->find($information_id);
    	$this->assign('data', $data);
    	$this->assign('files',$files);


		$this->display();
    }
    public function delete()
    {
    	$model = D('Admin/Information');
    	if($model->delete(I('get.information_id', 0)) !== FALSE)
    	{
    		$this->success('删除成功！', U('index', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else 
    	{
    		$this->error($model->getError());
    	}
    }
    public function index()
    {
        include 'AccessControl.php';
    	$model = D('Pc/Information');
    $pageSize = I('get.pageSize',10,'number_int');
    	$data = $model->search($pageSize == ""?10:$pageSize);
    	$fileModel = M('Fileinformation');
    	foreach ($data['data'] as $k=>$v){
            $files = $fileModel->where('information_id='.$v['information_id'])->select();
//            array_push($data['data'][$k], $files);
            $data['data'][$k]['files'] = $files;
        }
    	$result = (array(
    		'data' => $data['data'],
            'totalPage' => $data['totalPage'],
//    		'page' => $data['page'],
//            'tpName' => Information,
//                       'navName' => 信息披露,
                	));
    	exit(json_encode($result));
//    	$this->display();
    }
    public function informationContent(){
        include 'AccessControl.php';
        $informationId = I('get.information_id');
        $model = D('Pc/Information');
        $data = $model->where('information_id='.$informationId .' and status=1')->find();
        $fileModel = M('Fileinformation');
            $files = $fileModel->where('information_id='.$informationId . ' and status = 1')->select();
//            array_push($data['data'][$k], $files);
        if($files){
            $data['files'] = $files;
        }else{
            $data['files'] = '';
        }
        $result = (array(
            'data'=> $data,
        ));
        exit(json_encode($result));
    }
    public function setStatus() {
    try {
    if ($_POST) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    if (!$id) {
    return show(0, 'ID不存在');
    }
    $res = D("Information")->updateStatusById($id, $status);
    if ($res) {
    return show(1, '操作成功');
    } else {
    return show(0, '操作失败');
    }
    }
    return show(0, '没有提交的内容');
    }catch(Exception $e) {
    return show(0, $e->getMessage());
    }
    }
}