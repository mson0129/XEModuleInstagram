<?php
//Copyright (c) 2015 Studio2b
//InstagramModule
//InstagramView
//Studio2b(www.studio2b.kr)
//Michael Son(mson0129@gmail.com)
//09JUL2015(1.0.0.) - This module was newly created.
class instagramView extends instagram {
	public function init() {
		//xFacility2014 - including the part of frameworks
		require_once($this->module_path."XFCurl.class.php");
		require_once($this->module_path."XFInstagram.class.php");
		
		//Template
		$tplPath = sprintf("%sskins/%s/", $this->module_path, (!is_null($this->module_info->skin) && $this->module_info->skin!="" && is_dir(sprintf("%sskins/%s/", $this->module_path, $this->module_info->skin))) ? $this->module_info->skin : "default");
		$this->setTemplatePath($tplPath);
		$tplFile = strtolower(str_replace("dispInstagram", "", $this->act));
		$this->setTemplateFile($tplFile);
	}
	
	public function dispInstagramBrowse() {
		if(!empty($this->module_info->client_id)) {
			$clientId = $this->module_info->client_id;
			$instagram = new XFInstagram($clientId);
			//Convert Username to UserId
			if(empty($this->module_info->username)) {
				$username = "instagram"; //Instagram Official Account
			} else {
				$temp = json_decode($this->module_info->username, true);
				$username = $temp[0];
				unset($temp);
			}
			$temp = $this->getUserId($username);
			if($temp->bool) {
				$userId = $temp->data;
			} else {
				$finder = $instagram->users->browse($username);
				if($finder->bool) {
					foreach($finder->data as $key=>$val) {
						if($val[username]==$username) {
							$userId = $val[id];
							break;
						}
					}
				} else {
					$error = $finder->message;
				}
			}
			unset($temp);
			$userId = is_numeric($userId) ? $userId : "25025320"; //Instagram Official Account
			$result = $instagram->users->mediaRecent($userId);
			//$result->data[pagination][next_max_id];
			Context::set("data", $result->data[data]);
		} else {
			$error = "NO_CLIENT_ID";
		}
		
	}
	
	protected function getUserId($username) {
		//xFacility2014 - including the part of frameworks
		require_once($this->module_path."XFCurl.class.php");
		
		$return = new stdClass();
		$xFCurl = new XFCurl("GET", sprintf("https://instagram.com/%s", $username), NULL, NULL);
		$xFCurl->request();
		if($xFCurl->httpCode==200) {
			$result = preg_match('/\"owner\":\{\"id\":\"(\d+)"\}/', $xFCurl->body, $arr);
			if($result) {
				$return->data = $arr[1];
				$return->message = "OK";
				$return->bool = true;
			} else {
				$return->messgae = "NOT_FOUND";
				$return->bool = false;
			}
		} else {
			$return->message = "HTTP".$xFCurl->httpCode;
			$return->bool = false;
		}
		return $return;
	}
}
?>