<?php

/**
 * Author:	Muslim Raza
 * Email:	fairsit.m@gmail.com
 * Website:	https://www.linkedin.com/in/muslim-raza-70105228/
 * Component:Report Incidents
 * Version:	3.0.0
 * Date:		12/01/2021
 * copyright	Copyright (C) 2021 https://www.linkedin.com/in/muslim-raza-70105228/. All Rights Reserved.
 **/
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class ReportIncidentsController extends JControllerLegacy
{

	function __construct()
	{
		parent::__construct();

		JLoader::import('DropdownHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR);
		JLoader::import('UtilHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR);
	}


	public function display($cachable = false, $urlparams = false)
	{
		JRequest::setVar('view', 'default'); // force it to be the search view


		$incidents_list_html = $this->incidents_list("html");


		$document = JFactory::getDocument();
		$view = $this->getView('default', 'html');
		$view->document = $document;
		$view->incidents_list_html = $incidents_list_html;


		#$view->document->addScriptDeclaration('var backup_$ = $; $ = jQuery;');

		$assets = UtilHelper::load_assets();
		$view->document->addScriptDeclaration($assets["inline_js"]);

		/*
		if (@$_SERVER['HTTP_HOST'] == 'localhost') {
			foreach ($assets["css"] as $css) {
				$view->document->addStyleSheet($css);
			}

			foreach ($assets["js"] as $js) {
				$view->document->addScript($js);
			}
		}
		*/

		$view->display();
	}

	public function get_incidents()
	{

		$view = $this->getView('get_incidents', 'raw');
		$view->abc = "1223";

		$view->display();
	}

	public function get_videos()
	{
		$view = $this->getView('get_videos', 'raw');
		$view->display();
	}

	public function get_guilty_video()
	{
		$view = $this->getView('get_guilty_video', 'raw');
		$view->display();
	}

	public function get_juez()
	{
		$view = $this->getView('get_juez', 'raw');
		$view->display();
	}

	public function table_pdf()
	{
		$view = $this->getView('table_pdf', 'raw');
		$view->display();
	}

	public function incidents_list($type = '')
	{
		if ($type == "") {
			if (array_key_exists("format", $_REQUEST)) {
				$type = $_REQUEST['format'];
			}
		}


		$incidents_list_html = $this->getView('incidents_list', $type);

		if ($type == "html") {
			$incidents_list_html->isAjax = false;
			return $incidents_list_html;
		} else {
			$incidents_list_html->isAjax = true;
			$incidents_list_html->display();
		}
	}

	public function set_resolucion()
	{
		$view = $this->getView('set_resolucion', 'raw');
		$view->display();
	}

	public function set_juez()
	{
		$view = $this->getView('set_juez', 'raw');
		$view->display();
	}
}
