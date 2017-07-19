<?php
namespace Admin\Model;
use Think\Model;
class FileinformationModel extends Model 
{
	protected $insertFields = array('information_id','filename','filepath','createtime','status','remark');
	protected $updateFields = array('fileinformation_id','information_id','filename','filepath','createtime','status','remark');
	protected $_validate = array(
		array('information_id', 'number', '信息披露id必须是一个整数！', 2, 'regex', 3),
		array('filename', '1,64', '文件名称的值最长不能超过 64 个字符！', 2, 'length', 3),
		array('filepath', '1,128', '文件路径的值最长不能超过 128 个字符！', 2, 'length', 3),
		array('createtime', '1,25', '创建时间的值最长不能超过 25 个字符！', 2, 'length', 3),
		array('status', 'number', '状态必须是一个整数！', 2, 'regex', 3),
		array('remark', '1,255', '备注的值最长不能超过 255 个字符！', 2, 'length', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($information_id = I('get.information_id'))
			$where['information_id'] = array('eq', $information_id);
		if($filename = I('get.filename'))
			$where['filename'] = array('like', "%$filename%");
		if($filepath = I('get.filepath'))
			$where['filepath'] = array('like', "%$filepath%");
		if($createtime = I('get.createtime'))
			$where['createtime'] = array('like', "%$createtime%");
		if($status = I('get.status'))
			$where['status'] = array('eq', $status);
		if($remark = I('get.remark'))
			$where['remark'] = array('like', "%$remark%");
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->alias('a')->where($where)->group('a.fileinformation_id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{
        $data['createtime'] = time();
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
	}
	// 删除前
	protected function _before_delete($option)
	{
		if(is_array($option['where']['fileinformation_id']))
		{
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
	/************************************ 其他方法 ********************************************/
    public function getFileinformations($data,$page,$pageSize=10) {
    $data['status'] = array('neq',-1);
    $offset = ($page - 1) * $pageSize;
    $list = $this->_db->where($data)->order('createtime desc,fileinformation_id desc')->limit($offset,$pageSize)->select();
    return $list;
    }

    public function getFileinformationsCount($data= array()) {
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
        $model=D('Fileinformation');
        return $model->where('fileinformation_id='.$id)->save($data);
    }
}