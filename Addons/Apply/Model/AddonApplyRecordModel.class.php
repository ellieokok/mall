<?php
namespace Addons\Apply\Model;

use Think\Model\RelationModel;

class AddonApplyRecordModel extends RelationModel
{
    protected $_link = array(
        'AddonApplyContact' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'addonapplycontact',
            'foreign_key' => 'contact_id',//关联id
        ),
    );
}