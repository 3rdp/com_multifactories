<?php
/**
 * @package     com_multifactories
 * @subpackage  city
 *
 */
defined('_JEXEC') or die;

/**
 * View to edit a city.
 *
 */
class MultifactoriesViewCity extends JViewLegacy{
	/**
	* Form
	*
	* @var JForm
	*/
	protected $form;

	/**
	* Current Row
	*
	* @var Array
	*/
	protected $item;

	/**
	* Saved status
	*
	* @var JObject
	*/
	protected $state;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null){
		// Initialiase variables.
		$this->form  = $this->get('Form');
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolbar(){

		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user       = JFactory::getUser();
		$userId     = $user->get('id');
		$isNew      = ($this->item->id == 0);
		$checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

		// Since we don't track these assets at the item level, use the city id.
		$canDo = JHelperContent::getActions('com_multifactories', 'city', $this->item->id);

		JToolbarHelper::title($isNew ? JText::_('COM_MULTIFACTORIES_MANAGER_CITY_NEW') : JText::_('COM_MULTIFACTORIES_MANAGER_CITY_EDIT'), 'icon multifactories city');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit') || $user->authorise('com_multifactories', 'core.create'))){
			JToolbarHelper::apply('city.apply');
			JToolbarHelper::save('city.save');

			if ($canDo->get('core.create')){
				JToolbarHelper::save2new('city.save2new');
			}
		}

		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create')){
			JToolbarHelper::save2copy('city.save2copy');
		}

		if (empty($this->item->id)){
			JToolbarHelper::cancel('city.cancel');
		}
		else{
			if ($this->state->params->get('save_history', 0) && $user->authorise('core.edit')){
				JToolbarHelper::versions('com_multifactories.city', $this->item->id);
			}

			JToolbarHelper::cancel('city.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolbarHelper::divider();
		//JToolbarHelper::help('JHELP_COMPONENTS_MULTIFACTORIES_MULTIFACTORIES_EDIT');
	}
}
