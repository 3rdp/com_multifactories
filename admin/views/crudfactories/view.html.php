<?php
/**
 * @package     com_multifactories
 * @subpackage  crudfactories
 *
 */

defined('_JEXEC') or die;

/**
 * View class for a list of crudfactories.
 *
 */
class MultifactoriesViewCrudfactories extends JViewLegacy{
	/**
	* Current list items
	*
	* @var array
	*/
	protected $items;
	/**
	* JPagination Object
	*
	* @var JPagination
	*/
	protected $pagination;

	/**
	* States object
	*
	* @var JObject
	*/
	protected $state;

	/**
	 * Method to display the view.
	 *
	 * @param   string  $tpl  A template file to load. [optional]
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 *
	 */
	public function display($tpl = null){
		$this->items         = $this->get('Items');
		$this->pagination    = $this->get('Pagination');
		$this->state         = $this->get('State');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		MultifactoriesHelper::addSubmenu('crudfactories');

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 */
	protected function addToolbar(){

		$canDo = JHelperContent::getActions('com_multifactories', 'crudfactories', $this->state->get('filter.crudfactories_id'));
		$user = JFactory::getUser();

		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_MULTIFACTORIES_MANAGER_CRUDFACTORIES'), 'multifactories crudfactories');

		if ($user->authorise('com_multifactories', 'core.create')){
			JToolbarHelper::addNew('crudfactories.add');
		}

		if (($canDo->get('core.edit'))){
			JToolbarHelper::editList('crudfactories.edit');
		}

		if ($canDo->get('core.edit.state')){
			if ($this->state->get('filter.state') != 2){
				JToolbarHelper::publish('crudfactories.publish', 'JTOOLBAR_PUBLISH', true);
				JToolbarHelper::unpublish('crudfactories.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			}

			if ($this->state->get('filter.state') != -1){
				if ($this->state->get('filter.state') != 2){
					JToolbarHelper::archiveList('crudfactories.archive');
				}
				elseif ($this->state->get('filter.state') == 2){
					JToolbarHelper::unarchiveList('crudfactories.publish');
				}
			}
		}

		// if ($canDo->get('core.edit.state')){
		// 	JToolbarHelper::checkin('crudfactories.checkin');
		// }

		// Add a batch button
		if ($user->authorise('core.create', 'com_multifactories')
			&& $user->authorise('core.edit', 'com_multifactories')
			&& $user->authorise('core.edit.state', 'com_multifactories'))
		{
			$title = JText::_('JTOOLBAR_BATCH');

			// Instantiate a new JLayoutFile instance and render the batch button
			$layout = new JLayoutFile('joomla.toolbar.batch');

			$dhtml = $layout->render(array('title' => $title));
			$bar->appendButton('Custom', $dhtml, 'batch');
		}

		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete')){
			JToolbarHelper::deleteList('', 'crudfactories.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state')){
			JToolbarHelper::trash('crudfactories.trash');
		}

		if ($user->authorise('core.admin', 'com_multifactories') || $user->authorise('core.options', 'com_multifactories')){
			JToolbarHelper::preferences('com_multifactories');
		}

		JToolbarHelper::help('JHELP_COMPONENTS_COM_MULTIFACTORIES_CRUDFACTORIES');
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 *
	 * @since   3.0
	 */
	protected function getSortFields(){
		return [
			'name'=>JText::_('COM_MULTIFACTORIES_HEADING_NAME'),
			'alias'=>JText::_('COM_MULTIFACTORIES_HEADING_ALIAS'),
			
		];
	}
}
