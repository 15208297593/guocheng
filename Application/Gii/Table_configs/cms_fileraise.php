<?php
return array(
	'tableName' => 'cms_fileraise',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'fileraise_id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array('raise_id','filename','filepath','createtime','status','remark')",
	'updateFields' => "array('fileraise_id','raise_id','filename','filepath','createtime','status','remark')",
	'validate' => "
		array('raise_id', 'number', '募集基金id必须是一个整数！', 2, 'regex', 3),
		array('filename', '1,64', '文件名称的值最长不能超过 64 个字符！', 2, 'length', 3),
		array('filepath', '1,128', '文件路径的值最长不能超过 128 个字符！', 2, 'length', 3),
		array('createtime', '1,25', '创建时间的值最长不能超过 25 个字符！', 2, 'length', 3),
		array('status', 'number', '状态必须是一个整数！', 2, 'regex', 3),
		array('remark', '1,255', '备注的值最长不能超过 255 个字符！', 2, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'fileraise_id' => array(
			'text' => '募集基金文件id',
			'type' => 'text',
			'default' => '',
		),
		'raise_id' => array(
			'text' => '募集基金id',
			'type' => 'text',
			'default' => '',
		),
		'filename' => array(
			'text' => '文件名称',
			'type' => 'text',
			'default' => '',
		),
		'filepath' => array(
			'text' => '文件路径',
			'type' => 'text',
			'default' => '',
		),
		'createtime' => array(
			'text' => '创建时间',
			'type' => 'text',
			'default' => '',
		),
		'status' => array(
			'text' => '状态',
			'type' => 'text',
			'default' => '',
		),
		'remark' => array(
			'text' => '备注',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
'search' => array(
		array('raise_id', 'normal', '', 'eq', '募集基金id'),
		array('filename', 'normal', '', 'like', '文件名称'),
		array('filepath', 'normal', '', 'like', '文件路径'),
		array('createtime', 'normal', '', 'like', '创建时间'),
		array('status', 'normal', '', 'eq', '状态'),
		array('remark', 'normal', '', 'like', '备注'),
	),
);