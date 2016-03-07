<?php
//Copyright (c) 2015 Studio2b
//InstagramModule
//InstagramAdminModel
//Studio2b(www.studio2b.kr)
//Michael Son(mson0129@gmail.com)
//09JUL2015(1.0.0.) - This module was newly created.
class instagramAdminModel extends instagram {
	public function getInstagramAdminUpdateBasic($moduleSrl, $setupUrl) {
		if (!$moduleSrl)
			return;
		//Module
		$oModuleModel = getModel("module");
		$moduleInfo = $oModuleModel->getModuleInfoByModuleSrl($moduleSrl);
		
		if(!$moduleInfo)
			return;
		$moduleInfo->username = json_decode($moduleInfo->username, true);
		Context::set("module_info", $moduleInfo);
		//Config
		$config = $oModuleModel->getModulePartConfig("instagram", $moduleSrl);
		Context::set("config", $config);
	
		$oTemplate = TemplateHandler::getInstance();
		$html = $oTemplate->compile($this->module_path . "tpl/", "updatebasic");
	
		return $html;
	}
}
?>