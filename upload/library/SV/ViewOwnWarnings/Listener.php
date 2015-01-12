<?php

class SV_ViewOwnWarnings_Listener
{
    const AddonNameSpace = 'SV_ViewOwnWarnings';

    public static function load_class($class, &$extend)
    {
        switch($class)
        {
            case 'XenForo_ControllerPublic_Warning':
            case 'XenForo_Model_User':
                $extend[] = self::AddonNameSpace . '_'. $class;
                break;
        }
    }
}
