<?php
namespace Pc\Model;
use Think\Model;
class HireModel extends Model 
{
	protected $insertFields = array('job','duty','requirement','createtime','status','remark');
	protected $updateFields = array('hire_id','job','duty','requirement','createtime','status','remark');
	protected $_validate = array(
		array('job', '1,32', '职位的值最长不能超过 32 个字符！', 2, 'length', 3),
		array('createtime', '1,25', '创建时间的值最长不能超过 25 个字符！', 2, 'length', 3),
		array('status', 'number', '状态必须是一个整数！', 2, 'regex', 3),
		array('remark', '1,255', '备注的值最长不能超过 255 个字符！', 2, 'length', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($job = I('get.job'))
			$where['job'] = array('like', "%$job%");
		if($duty = I('get.duty'))
			$where['duty'] = array('eq', $duty);
		if($requirement = I('get.requirement'))
			$where['requirement'] = array('eq', $requirement);
		if($createtime = I('get.createtime'))
			$where['createtime'] = array('like', "%$createtime%");
//		if($status = I('get.status'))
			$where['status'] = array('eq', 1);
		if($remark = I('get.remark'))
			$where['remark'] = array('like', "%$remark%");
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$totalPage = ceil($count/$pageSize);
		$page = new \Think\Page($count, $pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->alias('a')->where($where)->group('a.hire_id')->limit($page->firstRow.','.$page->listRows)->select();
		$data['totalPage'] = $totalPage;
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{
        $data['createtime'] = time();
		if(isset($_FILES['pic']) && $_FILES['pic']['error'] == 0)
		{
			$ret = uploadOne('pic', 'Admin', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['pic'] = $ret['images'][0];
				$data['big_pic'] = $ret['images'][1];
				$data['mid_pic'] = $ret['images'][2];
				$data['sm_pic'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
		}
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
		if(isset($_FILES['pic']) && $_FILES['pic']['error'] == 0)
		{
			$ret = uploadOne('pic', 'Admin', array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			));
			if($ret['ok'] == 1)
			{
				$data['pic'] = $ret['images'][0];
				$data['big_pic'] = $ret['images'][1];
				$data['mid_pic'] = $ret['images'][2];
				$data['sm_pic'] = $ret['images'][3];
			}
			else 
			{
				$this->error = $ret['error'];
				return FALSE;
			}
			deleteImage(array(
				I('post.old_pic'),
				I('post.old_big_pic'),
				I('post.old_mid_pic'),
				I('post.old_sm_pic'),
	
			));
		}
	}
	// 删除前
	protected function _before_delete($option)
	{
		if(is_array($option['where']['hire_id']))
		{
			$this->error = '不支持批量删除';
			return FALSE;
		}
		$images = $this->field('pic,big_pic,mid_pic,sm_pic')->find($option['where']['hire_id']);
		deleteImage($images);
	}
	/************************************ 其他方法 ********************************************/
    public function getHires($data,$page,$pageSize=10) {
    $data['status'] = array('neq',-1);
    $offset = ($page - 1) * $pageSize;
    $list = $this->_db->where($data)->order('createtime desc,hire_id desc')->limit($offset,$pageSize)->select();
    return $list;
    }

    public function getHiresCount($data= array()) {
    $data['status'] = array('neq',-1);
    return $this->_db->where($data)->count();
    }

    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
        throw_exception('status不能为非数字');
        }
        if(!$id || !is_numeric($id)) {
        throw_exception('id不合法');
        }
        $data['status'] = $status;
        $model=D('Hire');
        return $model->where('hire_id='.$id)->save($data);
    }
}