<?php

class api {

	public function __construct($token) {

		$verify = $this->request("users.get", ["access_token" => $token]);

		if (is_numeric(($verify["response"]["0"]["id"]))) {
			define("VERIFY", true);
			return true;
		} else {
			throw new Exception("Ошибка авторизации: access_token не валидный", 1);
		}

	}

	public function request($method, $params = array()) {
		$prm = http_build_query($params);
		$url = "https://api.vk.com/method/$method?$prm&v=5.68";
		$request = file_get_contents($url);
		$p_raw = json_decode($request, true);

		return $p_raw;
	}

	public function getUserInfo($user_id, $fields = array()) {
		$r = $this->request("users.get", ["fields" => implode(",", $fields), "user_ids" => $user_id]);

		return json_encode($r);
	} 

	public function getMultipleUsersInfo($user_ids = array(), $fields = array()) {
		$r = $this->request("users.get", ["fields" => implode(",", $fields), "user_ids" => implode(",", $user_ids)]);

		return json_encode($r);
	}

	public function getGroupInfo($group_id, $fields = array()) {
		$r = $this->request("groups.getById", ["fields" => implode(",", $fields), "group_id" => $group_id]);

		return json_encode($r);
	}

	public function getMultipleGroupsInfo($groups_ids, $fields = array()) {
		$r = $this->request("groups.getById", ["fields" => implode(",", $fields), "group_ids" => implode(",", $groups_ids)]);

		return json_encode($r);
	}

	public function dump($var) {
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
	}

}