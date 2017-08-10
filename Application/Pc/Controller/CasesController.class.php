<?php
namespace Pc\Controller;
use \Pc\Controller\IndexController;
class CasesController extends IndexController 
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('Admin/Cases');
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
    	$cases_id = I('get.cases_id');
    	if(IS_POST)
    	{
    		$model = D('Admin/Cases');
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
    	$model = M('Cases');
    	$data = $model->find($cases_id);
    	$data = $model->find($cases_id);
    	$this->assign('data', $data);

		$this->display();
    }
    public function delete()
    {
    	$model = D('Admin/Cases');
    	if($model->delete(I('get.cases_id', 0)) !== FALSE)
    	{
//    		$this->success('删除成功！', U('index', array('p' => I('get.p', 1))));
            return show(1,'删除成功');
            exit;
    	}
    	else 
    	{
            return show(0,$model->getError());
//    			$this->error($model->getError());
    	}
    }
    public function index()
    {
        include 'AccessControl.php';
    	$model = D('Pc/Cases');
    $pageSize = I('get.pageSize',10,'number_int');
    	$data = $model->search($pageSize == ""?10:$pageSize);
    	$result = (array(
    		'data' => $data['data'],
            'totalPage' => $data['totalPage'],
//    		'page' => $data['page'],
//            'tpName' => Cases,
//                       'navName' => 成功案例,
                	));
    	exit(json_encode($result));
//    	$this->display();
    }
    public function casesContent(){
        include 'AccessControl.php';
        $casesId = I('get.cases_id');
        $model = D('Pc/Cases');
        $data = $model->where('cases_id='.$casesId .' and status = 1')->find();
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
    $res = D("Cases")->updateStatusById($id, $status);
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