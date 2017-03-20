<?php
namespace Addons\SystemInfo\Model;

use Think\Model\RelationModel;

class OrderModel extends RelationModel
{
    protected $_link = array(
        'Order_detail' => array(
            'mapping_type' => self::HAS_MANY,
            'mapping_name' => 'detail',
            'foreign_key' => 'order_id',//关联id
        ),
        'Contact' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'contact',
            'foreign_key' => 'contact_id',//关联id
        ),
    );
}