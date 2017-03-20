<?php
namespace Common\Model;

use Think\Model\RelationModel;

class ProductModel extends RelationModel
{
    protected $_link = array(
        'Menu' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'menu',
            'foreign_key' => 'menu_id',//关联id
            'as_fields' => 'name:menu_name',
        ),
        'File' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'file',
            'foreign_key' => 'file_id',//关联id
            'as_fields' => 'savename:savename,savepath:savepath',
        ),
        'Comment' => array(
            'mapping_type' => self::HAS_MANY,
            'mapping_name' => 'comment',
            'foreign_key' => 'product_id',//关联id
        ),
        'ProductSku' => array(
            'mapping_type' => self::HAS_MANY,
            'mapping_name' => 'sku',
            'foreign_key' => 'product_id',//关联id
        ),
        'Shop' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'shop',
            'foreign_key' => 'shop_id',//关联id
//            'mapping_fields' => 'remark',
        ),
    );

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
//崔
    public function getProductList($condition = array(), $relation = false, $order = "id desc", $p = 0, $num = 0, $limit = 0, $userId)
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

        if ($relation) {
            $favorites = D("UserFavorites")->getFavoritesList(array("user_id" => $userId));
            foreach ($list as $k => $v) {
                foreach ($favorites as $key => $value) {
                    if ($v["id"] == $value["product_id"]) {
                        $list[$k]["favorites"] = true;
                    }
                }

                $attrs = json_decode($v["attrs"], true);
                $list[$k]["attrs"] = $attrs ? $attrs : "";

                $albums = json_decode($v["albums"], true);
                $list[$k]["albums"] = $albums ? D("File")->getFileList(array("id" => array("in", $albums))) : "";

                $user = D("User");
                foreach ($v["comment"] as $key => $value) {
                    $userInfo = $user->get(array("id" => $value["user_id"]));
                    $list[$k]["comment"][$key]["username"] = $userInfo["username"];
                }
            }
        }

        return $list;
    }

    public function getProductListCount($condition = array())
    {
        $count = $this->where($condition)->count();
        return $count;
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
    
    
    
    
    
    public function getProduct($condition = array(), $relation = false, $isAnalysis = false)
    {
        $data = $this->where($condition);
        if ($relation) {
            $data = $data->relation($relation);
        }
        $data = $data->find();

        if ($id = $condition["id"] && $isAnalysis) {
            $this->where(array("id" => $id))->setInc("visiter");
        }

        $attrs = json_decode($data["attrs"], true);
        $data["attrs"] = $attrs ? $attrs : "";

        $albums = json_decode($data["albums"], true);
        $data["albums"] = $albums ? D("File")->getFileList(array("id" => array("in", $albums))) : "";

        if ($data["comment"]) {
            // $commentModel = D("Comment");
            // foreach ($data["comment"] as $key => $value) {
            //     $data["comment"] = $commentModel->getComment(array("product_id" => $value["product_id"]));
            // }

            $user = D("User");
            foreach ($data["comment"] as $key => $value) {
                $userInfo = $user->get(array("id" => $value["user_id"]));
                $data["comment"][$key]["username"] = $userInfo["username"];
            }
        }

        return $data;
    }
//
//    public function getProductList($condition = array(), $relation = false, $order = "id desc", $p = 0, $num = 0, $limit = 0, $userId)
//    {
//        $list = $this->where($condition);
//        if ($relation) {
//            $list = $list->relation($relation);
//        }
//        if ($p && $num) {
//            $list = $list->page($p . ',' . $num . '');
//        }
//        if ($limit) {
//            $list = $list->limit($limit);
//        }
//
//        $list = $list->order($order)->select();
//
//        if ($relation) {
//            $favorites = D("UserFavorites")->getFavoritesList(array("user_id" => $userId));
//            foreach ($list as $k => $v) {
//                foreach ($favorites as $key => $value) {
//                    if ($v["id"] == $value["product_id"]) {
//                        $list[$k]["favorites"] = true;
//                    }
//                }
//            }
//        }
//
//        return $list;
//    }
//
//    public function getProductListCount($condition = array())
//    {
//        $count = $this->where($condition)->count();
//        return $count;
//    }
//
    public function addProduct($data, $attrs, $albums)
    {
        $data['attrs'] = $attrs;
        $data['albums'] = $albums;

        if ($data["id"] == 0 || !isset($data["id"])) {
            $this->add($data);
        } else {
            $this->save($data);
        }
    }

    public function updateProduct($ids, $data)
    {
        $this->where(array("id" => array("in", $ids)))->save($data);
    }

    public function delProduct($ids)
    {
        $this->where(array("id" => array("in", $ids)))->delete();
    }

}