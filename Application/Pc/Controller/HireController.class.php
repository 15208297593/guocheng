<?php
namespace Pc\Controller;
use \Pc\Controller\IndexController;
class HireController extends IndexController 
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('Admin/Hire');
    		if($model->create(I('post.'), 1))
    		{
    			if($id = $model->add())
    			{
//    				$this->success('添加成功！', U('index?p='.I('get.p')));
                    return show(1,'添加成功');
    				exit;
    			}
    		}
            return show(0,$model->getError());
//    		$this->error($model->getError());
    	}

		$this->display();
    }
    public function edit()
    {
    	$hire_id = I('get.hire_id');
    	if(IS_POST)
    	{
    		$model = D('Admin/Hire');
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
    	$model = M('Hire');
    	$data = $model->find($hire_id);
    	$data = $model->find($hire_id);
    	$this->assign('data', $data);

		$this->display();
    }
    public function delete()
    {
    	$model = D('Admin/Hire');
    	if($model->delete(I('get.hire_id', 0)) !== FALSE)
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
    	$model = D('Pc/Hire');
    $pageSize = I('get.pageSize',10,'number_int');
    	$data = $model->search($pageSize == ""?10:$pageSize);
    	$result = (array(
    		'data' => $data['data'],
    		'totalPage' => $data['totalPage'],
//            'tpName' => Hire,
//                       'navName' => 招贤纳士,
                	));
    	exit(json_encode($result));
//    	$this->display();
    }

    public function setStatus() {
    try {
    if ($_POST) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    if (!$id) {
    return show(0, 'ID不存在');
    }
    $res = D("Hire")->updateStatusById($id, $status);
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