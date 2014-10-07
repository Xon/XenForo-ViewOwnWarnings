<?php

class SV_ViewOwnWarnings_Listener
{
	public static function loadClassModel($class, &$extend)
	{
		switch($class)
        {
            case 'XenForo_Model_User':		
                $extend[] = 'SV_ViewOwnWarnings_XenForo_Model_User';
                break;
		}
	}
    
	public static function loadClass($class, &$extend)
	{    
		switch($class)
        {
            case 'XenForo_ControllerPublic_Warning':		
                $extend[] = 'SV_ViewOwnWarnings_XenForo_ControllerPublic_Warning';
                break;
		}
	}
}
