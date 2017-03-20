<?php
/**
 * Created by PhpStorm.
 * User: heqing
 * Date: 15/10/8
 * Time: 16:18
 */

namespace Common\Model;

use Think\Model;


class FileModel extends Model
{
    public function get($condition = array(), $relation = false)
    {
        $data = $this->where($condition);
        if ($relation) {
            $data = $data->relation($relation);
        }
        $data = $data->find();

        return $data;
    }

    public function getList($condition = array(), $relation = false, $order = "id desc", $p = 0, $num = 0, $limit = 0)
    {
        $data = $this->where($condition);
        if ($relation) {
            $data = $data->relation($relation);
        }
        if ($p && $num) {
            $data = $data->page($p . ',' . $num . '');
        }
        if ($limit) {
            $data = $data->limit($limit);
        }

        $data = $data->order($order)->select();

        return $data;
    }

    public function getMethod($condition = array(), $method, $args)
    {
        $field = isset($args) ? $args : '*';
        $data = $this->where($condition)->getField(strtoupper($method) . '(' . $field . ') AS tp_' . $method);
        return $data;
    }

    public function add($data)
    {
        if ($data["id"] == 0 || !isset($data["id"])) {
            $id = parent::add($data);
            return $id;
        } else {
            $this->save($data);
            return $data["id"];
        }
    }

    public function addAll($data)
    {
        parent::addAll($data);
    }

    public function save($data)
    {
        parent::save($data);
    }

    public function del($condition = array())
    {
        $this->where($condition)->delete();
    }

    public function uploadImage()
    {
        $files = $this->upload();
        $arrs = array();
        foreach ($files as $k => $v) {
            $arr = array();
            $arr['name'] = $v['name'];
            $arr['ext'] = $v['ext'];
            $arr['type'] = $v['type'];
            $arr['savename'] = $v['savename'];
            $arr['savepath'] = $v['savepath'];
            array_push($arrs, $arr);
        }

        $this->addAll($arrs);
    }

    public function upload()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        if (!$info) {// 上传错误提示错误信息
            return $upload->getError();
        } else {// 上传成功
            return $info;
        }
    }

//cui
    public function getFileList($condition = array(), $relation = false, $order = "id desc", $p = 0, $num = 0, $limit = 0)
    {
        $list = $this->where($condition);
        if ($relation) {
            $list = $list->relation(true);
        }
        if ($p && $num) {
            $list = $list->page($p . ',' . $num . '');
        }
        if ($limit) {
            $list = $list->limit($limit);
        }

        $list = $list->order($order)->select();

        return $list;
    }
//cui
    public function getFileListCount($condition = array())
    {
        $count = $this->where($condition)->count();
        return $count;
    }


}