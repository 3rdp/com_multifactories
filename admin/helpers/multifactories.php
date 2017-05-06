<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_multifactories
 *
 * @license     MIT
 */
defined('_JEXEC') or die;

/**
 * Multifactories component helper.
 *
 * @since  1.6
 */
class MultifactoriesHelper extends JHelperContent{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  The name of the active view.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	public static function addSubmenu($vName){
		JHtmlSidebar::addEntry(
			JText::_('COM_MULTIFACTORIES_SUBMENU_MULTIFACTORIES'),
			'index.php?option=com_multifactories&view=multifactories',
			$vName == 'multifactories'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_MULTIFACTORIES_SUBMENU_CRUDFACTORIES'),
			'index.php?option=com_multifactories&view=crudfactories',
			$vName == 'crudfactories'
		);
		/*--EOS EndOfSection: Dont't remove for future submenus generation--*/
	}
}
