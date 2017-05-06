<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_multifactories
 *
 * @license     MIT
 */
defined('_JEXEC') or die;
if(file_exists(JPATH_COMPONENT.'/vendor/autoload.php')){
  include JPATH_COMPONENT.'/vendor/autoload.php';
}

if(!JFactory::getUser()->authorise('core.manage','com_multifactories')){
  return JError::raiseWarning(404,JText::_('JERROR_ALERTNOAUTHOR'));
}
if(file_exists(JPATH_COMPONENT.'/helpers/multifactories.php')){
  JLoader::register('MultifactoriesHelper', JPATH_COMPONENT . '/helpers/multifactories.php');
}

// Execute the task.
$controller=JControllerLegacy::getInstance('Multifactories');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
