<?php
namespace Common\Model;
use Think\Model;

/**
 * 上传图片类
 * @author  singwa
 */
class UploadImageModel extends Model {
    private $_uploadObj = '';
    private $_uploadImageData = '';

    const UPLOAD = '/Public/Uploads';

    public function __construct() {
        $this->_uploadObj = new  \Think\Upload();
        $this->_uploadObj->maxSize   =     3145728 ;// 设置附件上传大小
        $this->_uploadObj->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $this->_uploadObj->savePath  =     ''; // 设置附件上传（子）目录
        $this->_uploadObj->rootPath = '.'.self::UPLOAD.'/';
        $this->_uploadObj->subName = date(Y) . '/' . date(m) .'/' . date(d);
    }

    public function upload() {

        $res = $this->_uploadObj->upload();

        if($res) {
            return '/' .self::UPLOAD . '/' . $res['imgFile']['savepath'] . $res['imgFile']['savename'];
        }else{
            return false;
        }
    }

    public function imageUpload() {
        $res = $this->_uploadObj->upload();

        if($res) {
            return '/' .self::UPLOAD . '/' . $res['file']['savepath'] . $res['file']['savename'];
        }else{
            return false;
        }
    }
}
