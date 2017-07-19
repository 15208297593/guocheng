<?php
return array(
	'tableName' => 'cms_managed',    // 表名
	'tableCnName' => '旗下管理基金',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'managed_id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array('title','createtime','content','status','remark')",
	'updateFields' => "array('managed_id','title','createtime','content','status','remark')",
	'validate' => "
		array('title', '1,64', '标题的值最长不能超过 64 个字符！', 2, 'length', 3),
		array('createtime', '1,25', '创建时间的值最长不能超过 25 个字符！', 2, 'length', 3),
		array('status', 'number', '状态必须是一个整数！', 2, 'regex', 3),
		array('remark', '1,255', '备注的值最长不能超过 255 个字符！', 2, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'managed_id' => array(
			'text' => '旗下管理基金id',
			'type' => 'text',
			'default' => '',
		),
		'title' => array(
			'text' => '标题',
			'type' => 'text',
			'default' => '',
		),
		'createtime' => array(
			'text' => '创建时间',
			'type' => 'text',
			'default' => '',
		),
		'content' => array(
			'text' => '管理基金详情',
			'type' => 'html',
			'default' => '',
		),
		'status' => array(
			'text' => '状态',
			'type' => 'text',
			'default' => '1',
		),
		'remark' => array(
			'text' => '备注',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
'search' => array(
		array('title', 'normal', '', 'like', '标题'),
		array('createtime', 'normal', '', 'like', '创建时间'),
		array('content', 'normal', '', 'eq', '管理基金详情'),
		array('status', 'normal', '', 'eq', '状态'),
		array('remark', 'normal', '', 'like', '备注'),
	),
);