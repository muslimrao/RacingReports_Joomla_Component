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

jimport('joomla.application.component.view');

class ReportIncidentsViewDefault extends JViewLegacy
{

	protected $params;

	public function display($tpl = null)
	{
		/*
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('parc_ferme');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();
		*/


		$app	= JFactory::getApplication();
		$params = $app->getParams();

		$menus	= $app->getMenu();
		$menu	= $menus->getActive();
		#$params->set("muslimraza", "abnbas");
		if ($menu) {
			$params->set('page_heading', $params->get('page_title', $menu->title));
		} else {
			$params->set('page_title',	JText::_('Report Incidents'));
		}

		$title = $params->get('page_title');
		if ($app->getCfg('sitename_pagetitles', 0)) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		$this->document->setTitle($title);

		if ($params->get('menu-meta_description')) {
			$this->document->setDescription($params->get('menu-meta_description'));
		}

		if ($params->get('menu-meta_keywords')) {
			$this->document->setMetadata('keywords', $params->get('menu-meta_keywords'));
		}

		if ($params->get('robots')) {
			$this->document->setMetadata('robots', $params->get('robots'));
		}


		$this->assignRef('params',		$params);





		parent::display($tpl);
	}
}
