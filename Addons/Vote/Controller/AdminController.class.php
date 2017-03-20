<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Addons\Vote\Controller;

class AdminController extends InitController
{


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $config = M("AddonVoteConfig")->find();
        $this->assign("config", $config);

        $record = D('Addons://Vote/AddonVoteRecord'); // 实例化User对象
        $count = $record->count();// 查询满足要求的总记录数
        $Page =  new \Think\Page($count, 12);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('theme', "<div class='widget-content padded text-center'><ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul></div>");
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $record = $record->limit($Page->firstRow . ',' . $Page->listRows)->order("id desc")->relation(true)->select();

        $this->assign("record", $record);// 赋值数据集
        $this->assign('page', $show);// 赋值分页输出

        $this->display();
    }

    public function addConfig()
    {
        M("AddonVoteConfig")->where(array("id" => "1"))->save($_POST);
        $this->success('设置成功', 'Admin/Admin/index/addon/Vote');
    }
}
