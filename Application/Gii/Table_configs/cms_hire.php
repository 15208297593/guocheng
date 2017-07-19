<?php
return array(
	'tableName' => 'cms_hire',    // 表名
	'tableCnName' => '招贤纳士',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'hire_id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	'insertFields' => "array('job','duty','requirement','createtime','status','remark')",
	'updateFields' => "array('hire_id','job','duty','requirement','createtime','status','remark')",
	'validate' => "
		array('job', '1,32', '职位的值最长不能超过 32 个字符！', 2, 'length', 3),
		array('createtime', '1,25', '创建时间的值最长不能超过 25 个字符！', 2, 'length', 3),
		array('status', 'number', '状态必须是一个整数！', 2, 'regex', 3),
		array('remark', '1,255', '备注的值最长不能超过 255 个字符！', 2, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'hire_id' => array(
			'text' => '招聘id',
			'type' => 'text',
			'default' => '',
		),
		'job' => array(
			'text' => '职位',
			'type' => 'text',
			'default' => '',
		),
		'duty' => array(
			'text' => '岗位职责',
			'type' => 'html',
			'default' => '',
		),
		'requirement' => array(
			'text' => '岗位要求',
			'type' => 'html',
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
		array('job', 'normal', '', 'like', '职位'),
		array('duty', 'normal', '', 'eq', '岗位职责'),
		array('requirement', 'normal', '', 'eq', '岗位要求'),
		array('createtime', 'normal', '', 'like', '创建时间'),
		array('status', 'normal', '', 'eq', '状态'),
		array('remark', 'normal', '', 'like', '备注'),
	),
);