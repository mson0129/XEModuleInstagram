<?php
//Copyright (c) 2015 Studio2b
//InstagramModule
//InstagramAdminView
//Studio2b(www.studio2b.kr)
//Michael Son(mson0129@gmail.com)
//09JUL2015(1.0.0.) - This module was newly created.
class instagramAdminView extends instagram {
	function init() {
		$this->setTemplatePath(sprintf("%stpl/", $this->module_path));
		$tplFile = strtolower(str_replace("dispInstagramAdmin", "", $this->act));
		$this->setTemplateFile($tplFile);
	}
	
	function dispYoutubeAdminBrowse() {
	
	}
	
	function dispYoutubeAdminUpdate() {
		
	}
	
	function dispYoutubeAdminUpdateAuthority() {
		$oModuleAdminModel = getAdminModel('module');
		$authority = $oModuleAdminModel->getModuleGrantHTML($this->module_info->module_srl, $this->xml_info->grant);
		Context::set('authority', $authority);
	}
	
	public function dispYoutubeAdminDelete() {
		
	}
}
?>