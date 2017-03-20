<?php
namespace App\Controller;

class UserController extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();

        $isLogin = $this->is_login();
        if (!$isLogin) {
            $this->ajaxReturn(array("info" => "error", "msg" => "未登陆", "status" => 0));
        }
    }

    public function getUser()
    {
        $user = D("User")->get(array("id" => session("userId")), true);
        if (I("get.getOrder")) {
            $user["order"] = D("Order")->getList(array("user_id" => session("userId"),"status" => array("gt", -1)), true);
        }

        if (I("get.getProvince")) {
            $user["province"] = D("LocProvince")->getList(array("shop_id"=>session("shop_id")), true);
        }

        $this->ajaxReturn($user);
    }

    public function getContactList()
    {
        $contact = D("Contact")->getList(array("user_id" => session("userId")));
        if (I("get.getProvince")) {
            $contact["province"] = D("LocProvince")->getList(array(), true);
        }

        $this->ajaxReturn($contact);
    }

    public function addContact()
    {
        $data = I("post.");
        $data["id"] = session("userId");
        D("Contact")->add($data);
    }

    public function delContact()
    {
        D("Contact")->del(array("id" => array("in", I("get.id"))));
    }

    public function getFavoritesList()
    {
        $list = D("UserFavorites")->getList(array("id" => session("userId")), true);
        $this->ajaxReturn($list);
    }

    public function addFavorites()
    {
        $data = array();
        $userFavorites = D("UserFavorites");
        if (strpos(I("get.product_id"), ',') != false) {
            $product_ids = explode(',', I("get.product_id"));
            foreach ($product_ids as $key => $value) {
                array_push($data, array("product_id" => $value, "user_id" => session("userId")));
            }
        } else {
            array_push($data, array("product_id" => I("get.product_id"), "user_id" => session("userId")));
        }

        foreach ($data as $key => $value) {
            $find = $userFavorites->get(array("user_id" => session("userId"), "product_id" => $value));
            if ($find) {
                unset($data[$key]);
            }
        }

        $userFavorites->addAll($data);
    }

    public function delFavorites()
    {
        D("UserFavorites")->del(array("id" => array("in", I("get.id"))));
    }
    // public function getShopList()
    // {
        // $lng = I("post.lng");
        // $lat = I("post.lat");

        // $lng = '113.875';
        // $lat = '34.0485';
        // $lngMin = returnSquarePoint($lng, $lat)["left-top"]["lng"];
        // $lngMax = returnSquarePoint($lng, $lat)["right-top"]["lng"];

        // $latMin = returnSquarePoint($lng, $lat)["left-top"]["lat"];
        // $latMax = returnSquarePoint($lng, $lat)["right-top"]["lat"];


        // $shop = D("Shop")->getShopList(array("status"=>I("post.status"),"lat" => array(array('gt', $latMin), array('lt', $latMax)), "lng" => array(array('gt', $lngMin), array('lt', $lngMax))),true,"id desc",$p,10,10);
        // $u_lat = '40.017349';
        // $u_lon = '116.407143,';
        // $p = I("post.lazyNum") ? I("post.lazyNum") : 1;
        // $shop = D("Shop")->getShopList(array("status"=>I("post.status")),true,"id desc",$p,10,10);
        // $this->ajaxReturn($shop);
    // }

    
    public function getShopList(){
        $lng = I("post.lng");
        $lat = I("post.lat");
        // $lat = '34.7913';
        // $lng = '113.673';
        $name=I('post.name');

        $range = 180 / pi() * 15 / 6372.797; //里面的 15 就代表搜索 15km 之内，单位km 
        $lngR = $range / cos($lat * pi() / 180);
        $maxLat = $lat + $range;//最大纬度
        $minLat = $lat - $range;//最小纬度 
        $maxLng = $lng + $lngR;//最大经度 
        $minLng = $lng - $lngR;//最小经度 


        $map['lng'] = array('between',array($minLng,$maxLng)); //经度值
        $map['lat'] = array('between',array($minLat,$maxLat)); //纬度值
        $map['name']=array('like',"%$name%");//搜索
        $map['status']=2;

        $list = D("Shop")->getShopList($map,true);
        $shop = $this->range($lat,$lng,$list);
        
        
        // $_shop = D("Shop")->getShopList(array("id" => 136), true);
        // array_push($shop, $_shop);
        
        $this->ajaxReturn($shop);
        
    }
    
	public function range($u_lat,$u_lng,$list)
    {
		/*
		*u_lat 用户纬度
		*u_lng 用户经度
		*list sql语句
		*/
		if(!empty($u_lat) && !empty($u_lng)){
			foreach ($list as $row) {
				$row['km'] = $this->nearby_distance($u_lat, $u_lng, $row['lat'], $row['lng']);
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
	public function nearby_distance($lat1, $lng1, $lat2, $lng2) 
    {
        $EARTH_RADIUS = 6378.137;
        $radLat1 = $this->rad($lat1);
        $radLat2 = $this->rad($lat2);
        $a = $radLat1 - $radLat2;
        $b = $this->rad($lng1) - $this->rad($lng2);
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