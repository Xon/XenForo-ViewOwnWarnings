<?php

class SV_ViewOwnWarnings_Listener
{
	public static function loadClassModel($class, &$extend)
	{
		if ($class=='XenForo_Model_User')
		{
			$extend[] = 'SV_ViewOwnWarnings_ModelUser';
		}      
	}
    
	public static function loadClass($class, &$extend)
	{    
		if ($class=='XenForo_ControllerPublic_Warning')
		{
			$extend[] = 'SV_ViewOwnWarnings_ControllerPublic_Warning'; 
		}       
	}    
    
	
	public static function templateHook($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template)
	{
		if ($hookName=='account_wrapper_sidebar_your_account')
		{
			$visitor=XenForo_Visitor::getInstance();
			$warningCount = XenForo_Model::create('XenForo_Model_Warning')->countWarningsByUser($visitor['user_id']);
			
			if ($warningCount>0)
			{				
				$url=XenForo_Link::buildPublicLink('members', $visitor).'#warnings';
				$contents.=sprintf('<li><a class="primaryContent" href="%s">%s</a></li>', $url, new XenForo_Phrase('warnings_youve_received'));
			}
		}
	}
}
