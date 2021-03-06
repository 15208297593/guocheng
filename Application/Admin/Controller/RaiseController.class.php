<?php
namespace Admin\Controller;
use \Admin\Controller\IndexController;
class RaiseController extends IndexController 
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('Admin/Raise');
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
    	$raise_id = I('get.raise_id');
    	if(IS_POST)
    	{
    		$model = D('Admin/Raise');
    		if($model->create(I('post.'), 2))
    		{
    			if($model->save() !== FALSE)
    			{
//    				$this->success('修改成功！', U('index', array('p' => I('get.p', 1))));
                    return show(1,'修改成功');
                    exit;
    			}
    		}
//    		$this->error($model->getError());
            return show(0,$model->getError());
    	}
    	$model = M('Raise');
        $fileModel = M('Fileraise');
        $files = $fileModel->where('raise_id='.$raise_id)->select();
    	$data = $model->find($raise_id);
    	$data = $model->find($raise_id);
    	$this->assign('data', $data);
    	$this->assign('files',$files);

		$this->display();
    }
    public function delete()
    {
    	$model = D('Admin/Raise');
    	if($model->delete(I('get.raise_id', 0)) !== FALSE)
    	{
//    		$this->success('删除成功！', U('index', array('p' => I('get.p', 1))));
            return show(1,'删除成功');
            exit;
    	}
    	else 
    	{
//    		$this->error($model->getError());
            return show(0,$model->getError());
    	}
    }
    public function index()
    {
    	$model = D('Admin/Raise');
    $pageSize = I('get.pageSize',10,'number_int');
    	$data = $model->search($pageSize == ""?10:$pageSize);
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
            'tpName' => Raise,
                       'navName' => 募集中基金,
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
    $res = D("Raise")->updateStatusById($id, $status);
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