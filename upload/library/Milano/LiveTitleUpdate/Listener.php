<?php

class Milano_LiveTitleUpdate_Listener
{
	public static function templateCreate($templateName, array &$params, XenForo_Template_Abstract $template) 
    {
        if (XenForo_Visitor::getUserId())
        {
            switch ($templateName)
            {
                case 'PAGE_CONTAINER':
                    $template->preloadTemplate('LiveTitleUpdate_js');
                    break;
            }
        }
    }

	public static function templateHook($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template) 
    {
        if (XenForo_Visitor::getUserId())
        {           
            switch ($hookName)
            {
                case 'page_container_js_body':
                    $ourTemplate = $template->create('LiveTitleUpdate_js', $template->getParams());
                    $contents .= $ourTemplate->render();
                    break; 
                case 'page_container_head':
                    $template->addRequiredExternal('js', 'js/Milano/LiveTitleUpdate/LiveTitle.js');
                    break;    
            }
        }
    }
}