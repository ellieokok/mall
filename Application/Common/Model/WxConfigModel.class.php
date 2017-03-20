<?php
namespace Common\Model;

use Think\Model;

class WxConfigModel extends Model
{
    public function get()
    {
        $config = $this->find();
        return $config;
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

    public function getJsSign()
    {
        Vendor("Wechat.JSSDK#class");
        $wxConfig = $this->find();
        $jssdk = new \JSSDK($wxConfig["appid"], $wxConfig["appsecret"]);
        $result = $jssdk->getSignPackage();
        return $result;
    }

    public function getWeObj()
    {
        Vendor("Wechat.wechat#class");
        $config = $this->find();
        $options = array(
            'token' => $config ["token"], //填写你设定的key
            'encodingaeskey' => $config ["encodingaeskey"], //填写加密用的EncodingAESKey
            'appid' => $config ["appid"], //填写高级调用功能的app id
            'appsecret' => $config ["appsecret"] //填写高级调用功能的密钥
        );
        $weObj = new \Wechat ($options);
        return $weObj;
    }
}