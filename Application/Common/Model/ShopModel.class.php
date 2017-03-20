<?php
namespace Common\Model;

use Think\Model\RelationModel;

class ShopModel extends RelationModel
{
    protected $_link = array(
        'File' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'file',
            'foreign_key' => 'file_id',//关联id
            'as_fields' => 'savename:savename,savepath:savepath',
        ),
        'User' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'user',
            'foreign_key' => 'user_id',//关联id
        ),
    );

    // public function add(){
    //     if ($data["id"] == 0 || !isset($data["id"])) {
    //         $id = parent::add($data);
    //         return $id;
    //     } else {
    //         $this->save($data);
    //         return $data["id"];
    //     }
    // }

    public function getShop($condition = array(), $relation = false)
    {
        $data = $this->where($condition);
        if ($relation) {
            $data = $data->relation(true);
        }
        $data = $data->find();

        return $data;
    }

    public function getShopList($condition = array(), $relation = false, $order = "id desc", $p = 0, $num = 0, $limit = 0)
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

    public function getShopListCount($condition = array())
    {
        $count = $this->where($condition)->count();
        return $count;
    }


    public function addShop($data)
    {
        if ($data["id"]) {
            $this->save($data);
        } else {
            $this->add($data);

            D("Analysis")->addAnalysis(0, 0, 1, 0, 1);
        }
    }

    public function saveShop($data)
    {
        $this->save($data);
    }


    public function delShop($ids)
    {
        $this->where(array("id" => array("in", $ids)))->delete();
    }
    

    //店铺远近排序   
    public function range($u_lat,$u_lon,$list)
    {
        /*
        *u_lat 用户纬度
        *u_lon 用户经度
        *list sql语句
        */
        if(!empty($u_lat) && !empty($u_lon)){
            foreach ($list as $row) {
                $row['km'] = $this->nearby_distance($u_lat, $u_lon, $row['lat'], $row['lon']);
                $row['km'] = round($row['km'], 1);
                $res[] = $row;
            }
            if (!empty($res)) {
                foreach ($res as $user) {
                    $ages[] = $user['km'];
                }
                array_multisort($ages, SORT_ASC, $res);
                return $res;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
        
    //计算经纬度两点之间的距离
    public function nearby_distance($lat1, $lon1, $lat2, $lon2) 
    {
        $EARTH_RADIUS = 6378.137;
        $radLat1 = $this->rad($lat1);
        $radLat2 = $this->rad($lat2);
        $a = $radLat1 - $radLat2;
        $b = $this->rad($lon1) - $this->rad($lon2);
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s1 = $s * $EARTH_RADIUS;
        $s2 = round($s1 * 10000) / 10000;
        return $s2;
        //print_r($s2);
    }

    private function rad($d) {
        return $d * 3.1415926535898 / 180.0;
    } 

}