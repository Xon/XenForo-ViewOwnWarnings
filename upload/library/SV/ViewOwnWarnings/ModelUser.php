<?php
class SV_ViewOwnWarnings_ModelUser extends XFCP_SV_ViewOwnWarnings_ModelUser
{
	public function canViewWarnings(&$errorPhraseKey = '', array $viewingUser = null)
	{
		$this->standardizeViewingUserReference($viewingUser);
        
		if (preg_match('/members\/.*?\.(\d+)\//i', $_SERVER['REQUEST_URI'], $matches))
		{
			if ($matches[1]==$viewingUser['user_id'])
			{
				return true;
			}
		}
		
		return parent::canViewWarnings($errorPhraseKey, $viewingUser);
	}
}





