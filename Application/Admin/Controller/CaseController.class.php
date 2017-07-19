<?php
namespace Admin\Controller;
use \Admin\Controller\IndexController;
class CaseController extends IndexController 
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('Admin/Case');
    		if($model->create(I('post.'), 1))
    		{
    			if($id = $model->add())
    			{
    				$this->success('添加成功！', U('index?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}

		$this->display();
    }
    public function edit()
    {
    	$case_id = I('get.case_id');
    	if(IS_POST)
    	{
    		$model = D('Admin/Case');
    		if($model->create(I('post.'), 2))
    		{
    			if($model->save() !== FALSE)
    			{
    				$this->success('修改成功！', U('index', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Case');
    	$data = $model->find($case_id);
    	$data = $model->find($case_id);
    	$this->assign('data', $data);

		$this->display();
    }
    public function delete()
    {
    	$model = D('Admin/Case');
    	if($model->delete(I('get.case_id', 0)) !== FALSE)
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
    	$model = D('Admin/Case');
    $pageSize = I('get.pageSize',10,'number_int');
    	$data = $model->search($pageSize == ""?10:$pageSize);
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
            'tpName' => Cases,
                       'navName' => 成功案例,
                	));
    	$this->display();
    }

    public function setStatus() {
    try {
    if ($_POST) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    if (!$id) {
    return show(0, 'ID不存在');
    }
    $res = D("Case")->updateStatusById($id, $status);
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