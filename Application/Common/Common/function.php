<?php

/**
 * 公用的方法
 */

function  show($status, $message,$data=array()) {
    $result = array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
    );
    exit(json_encode($result));
}
function getMd5Password($password) {
    return md5($password . C('MD5_PRE'));
}
function getMenuType($type) {
    return $type == 1 ? '后台菜单' : '前端导航';
}
function status($status) {
    if($status == 0) {
        $str = '关闭';
    }elseif($status == 1) {
        $str = '正常';
    }elseif($status == -1) {
        $str = '删除';
    }
    return $str;
}
function getAdminMenuUrl($nav) {
    $url = '/admin.php?c='.$nav['c'].'&a='.$nav['a'];
    if($nav['f']=='index') {
        $url = '/admin.php?c='.$nav['c'];
    }
    return $url;
}
function getActive($navc){
    $c = strtolower(CONTROLLER_NAME);
    if(strtolower($navc) == $c) {
        return 'class="active"';
    }
    return '';
}
function showKind($status,$data) {
    header('Content-type:application/json;charset=UTF-8');
    if($status==0) {
        exit(json_encode(array('error'=>0,'url'=>$data)));
    }
    exit(json_encode(array('error'=>1,'message'=>'上传失败')));
}
function getLoginUsername() {
    return $_SESSION['adminUser']['username'] ? $_SESSION['adminUser']['username']: '';
}
function getCatName($navs, $id) {
    foreach($navs as $nav) {
        $navList[$nav['menu_id']] = $nav['name'];
    }
    return isset($navList[$id]) ? $navList[$id] : '';
}
function getCopyFromById($id) {
    $copyFrom = C("COPY_FROM");
    return $copyFrom[$id] ? $copyFrom[$id] : '';
}
function isThumb($thumb) {
    if($thumb) {
        return '<span style="color:red">有</span>';
    }
    return '无';
}

/**
+----------------------------------------------------------
 * 字符串截取，支持中文和其他编码
+----------------------------------------------------------
 * @static
 * @access public
+----------------------------------------------------------
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
+----------------------------------------------------------
 * @return string
+----------------------------------------------------------
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
{
    $len = substr($str);
    if(function_exists("mb_substr")){
        if($suffix)
            return mb_substr($str, $start, $length, $charset)."...";
        else
            return mb_substr($str, $start, $length, $charset);
    }
    elseif(function_exists('iconv_substr')) {
        if($suffix && $len>$length)
            return iconv_substr($str,$start,$length,$charset)."...";
        else
            return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."…";
    return $slice;
}

// 显示图片
function showImage($url, $width='', $height='')
{$rp=C('IMG_ROOTPATH1');
    $url =$rp.$url;
    if($width)
        $width = "width='$width'";
    if($height)
        $height = "height='$height'";
    echo "<img src='$url' $width $width />";
}

// 删除图片：参数：一维数组：所有要删除的图片的路径
function deleteImage($images)
{
    // 先取出图片所在目录
    $rp = C('IMG_ROOTPATH');
    foreach ($images as $v)
    {
        // @错误抵制符：忽略掉错误,一般在删除文件时都添加上这个
        @unlink($rp . $v);
    }
}

// 删除文件：参数：一维数组：所有要删除的图片的路径
function deleteFiles($files)
{
    foreach ($files as $v)
    {
//        $file = $v;
//        if(!file_exists($file)){
//            die('文件不存在');
//        }
        // @错误抵制符：忽略掉错误,一般在删除文件时都添加上这个
        @unlink($v);
    }
}

//压缩图片
function cut($rootName,$name,$hight,$width){
    $r=$name;
    $in=getimagesize($rootName);
    $type=image_type_to_extension($in[2],false);
// 3、在内存中创建一个一样的图像
    $fun="imagecreatefrom{$type}";
    $image=$fun($rootName);
// 操作图片
    $ithum=imagecreatetruecolor($width, $hight);
    imagecopyresampled($ithum, $image, 0, 0, 0, 0, $width, $hight, $in[0], $in[1]);
    imagedestroy($image);
    header("Content-type:image/{$type}");
    $func="image{$type}";
//$func($ithum);
    $func($ithum,'Public/Uploads/'.$r);
    imagedestroy($ithum);
}

function downloads($name,$realName){
    $name_tmp = explode("_",$name);
    $type = $name_tmp[0];
    $file_time = explode(".",$name_tmp[0]);
    $file_time = time();
    $file_date = date("Y/m/d",$file_time);
    $file_dir = "";
    if (!file_exists($file_dir.$name)){
        // print_r($file_dir.$name);
        header("Content-type: text/html; charset=utf-8");
        echo "File not found!";
        exit;
    } else {
        $file = fopen($file_dir.$name,"r");
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: ".filesize($file_dir . $name));
        Header("Content-Disposition: attachment; filename=".$realName);
        echo fread($file, filesize($file_dir.$name));
        fclose($file);
    }
}






