<?php
//Copyright (c) 2015 Studio2b
//InstagramModule
//InstagramAdminController
//Studio2b(www.studio2b.kr)
//Michael Son(mson0129@gmail.com)
//09JUL2015(1.0.0.) - This module was newly created.
class instagramAdminController extends instagram {
	public function procInstagramAdminUpdateBasic() {
		//$args = $this->module_info;
		$args = Context::getRequestVars();
		$args->module = "instagram";
		if($args->cache_time==0) $args->cache_time='-0';
		$args->username = json_encode($args->username);
		
		//moduleController->updateModule Default Values
		$args->skin = $this->module_info->skin;
		$args->is_skin_fix = $this->module_info->is_skin_fix;
		$args->mskin = $this->module_info->mskin;
		$args->is_mskin_fix = $this->module_info->is_mskin_fix;
		
		//fwrite($log = fopen(__DIR__."/log.txt", "a"), print_r($this, true)."\r\n".print_r($args, true));
		//fclose($log);
		$oModuleController = getController("module");
		$output = $oModuleController->updateModule($args);
	}
	
	public function checkUpdate() {
		$oModuleModel = getModel("module");
		foreach($this->triggers as $trigger) {
			$res = $oModuleModel->getTrigger($trigger[name], $trigger[module], $trigger[type], $trigger[func], $trigger[position]);
			if(!$res)
				return true;
		}
	
		return false;
	}
	
	public function procInstagramAdminUpdate() {
		
	}
	
	public function procInstagramAdminDelete() {
	
	}
}
?>