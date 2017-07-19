<?php
return array(
	'tableName' => 'cms_indexcase',    // 表名
	'tableCnName' => '首页成功案例',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'indexcase_id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array('title','createtime','content','status')",
	'updateFields' => "array('indexcase_id','title','createtime','content','status')",
	'validate' => "
		array('title', '1,64', '首页成功案例标题的值最长不能超过 64 个字符！', 2, 'length', 3),
		array('createtime', '1,25', '成功案例创建时间的值最长不能超过 25 个字符！', 2, 'length', 3),
		array('status', 'number', '状态必须是一个整数！', 2, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'indexcase_id' => array(
			'text' => '首页id',
			'type' => 'text',
			'default' => '',
		),
		'title' => array(
			'text' => '首页成功案例标题',
			'type' => 'text',
			'default' => '',
		),
		'createtime' => array(
			'text' => '成功案例创建时间',
			'type' => 'text',
			'default' => '',
		),
		'content' => array(
			'text' => '内容',
			'type' => 'html',
			'default' => '',
		),
		'pic' => array(
			'text' => '图片路径',
			'type' => 'file',
			'thumbs' => array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			),
			'save_fields' => array('pic'),
			'default' => '',
		),
		'status' => array(
			'text' => '状态',
			'type' => 'text',
			'default' => '1',
		),
	),
	/**************** 搜索字段的配置 **********************/
'search' => array(
		array('title', 'normal', '', 'like', '首页成功案例标题'),
		array('createtime', 'normal', '', 'like', '成功案例创建时间'),
		array('content', 'normal', '', 'eq', '内容'),
		array('status', 'normal', '', 'eq', '状态'),
	),
);