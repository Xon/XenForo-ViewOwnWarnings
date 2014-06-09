<?php
class SV_ViewOwnWarnings_ControllerPublic_Warning extends XFCP_SV_ViewOwnWarnings_ControllerPublic_Warning
{
	public function actionIndex()
	{
		$warningId = $this->_input->filterSingle('warning_id', XenForo_Input::UINT);
		$warning = $this->_getWarningOrError($warningId);
        
        $canViewWarningDetails = $this->_getUserModel()->canViewWarnings();
        $visitor = XenForo_Visitor::getInstance();
		if ($warning['user_id'] != $visitor['user_id'] && !$canViewWarningDetails)
		{
			return $this->responseNoPermission();
		}

		$user = $this->_getUserModel()->getUserById($warning['user_id']);
		if (!$user)
		{
			return $this->responseError(new XenForo_Phrase('user_who_received_this_warning_no_longer_exists'));
		}

		$handler = $this->_getWarningModel()->getWarningHandler($warning['content_type']);
		$contentUrl = '';
		$canViewContent = false;
		if ($handler)
		{
			$content = $handler->getContent($warning['content_id']);
			if ($content)
			{
				$contentUrl = $handler->getContentUrl($content);
				$canViewContent = $handler->canView($content);
			}
		}

		$viewParams = array(
			'warning' => $warning,
			'user' => $user,
			'contentUrl' => $contentUrl,
			'canViewContent' => $canViewContent,
            'canViewWarningDetails' => $canViewWarningDetails,
			'canDeleteWarning' => $this->_getWarningModel()->canDeleteWarning($warning),
			'canExpireWarning' => $this->_getWarningModel()->canUpdateWarningExpiration($warning),
			'redirect' => $this->getDynamicRedirect()
		);
		return $this->responseView('XenForo_ViewPublic_Warning_Info', 'warning_info', $viewParams);
	}	 
}





