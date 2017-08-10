<?php
namespace Pc\Controller;
use \Pc\Controller\IndexController;
class IndexcaseController extends IndexController 
{
    public function setStatus() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                if (!$id) {
                    return show(0, 'ID不存在');
                }
                $res = D("Indexcase")->updateStatusById($id, $status);
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
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('Admin/Indexcase');
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
    	$indexcase_id = I('get.indexcase_id');
    	if(IS_POST)
    	{
    		$model = D('Admin/Indexcase');
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
    	$model = M('Indexcase');
    	$data = $model->find($indexcase_id);
    	$this->assign('data', $data);

		$this->display();
    }
    public function delete()
    {
    	$model = D('Admin/Indexcase');
    	if($model->delete(I('post.indexcase_id', 0)) !== FALSE)
    	{
//    		$this->success('删除成功！', U('index', array('p' => I('get.p', 1))));
            return show(1, '删除成功');
    	}
    	else 
    	{
//    		$this->error($model->getError());
            return show(0, '删除失败');
    	}
    }
    public function index()
    {
        include 'AccessControl.php';
    	$model = D('Admin/Indexcase');
    $pageSize = I('get.pageSize',10,'number_int');
    	$data = $model->search($pageSize == ""?10:$pageSize);
    	$result = (array(
    		'data' => $data['data'],
//    		'page' => $data['page'],
//            'tpName' => Indexcase,
//                       'navName' => 首页成功案例,
                	));
    	exit(json_encode($result));
//    	$this->display();
    }


}