<?php
/**
 * @package     com_multifactories
 * @subpackage  crudfactories
 *
 */

defined('_JEXEC') or die;

/**
 * Crudfactories model.
 *
 */
class MultifactoriesModelCrudfactories extends JModelList{

  /**
   * Constructor.
   *
   * @param   array  $config  An optional associative array of configuration settings.
   *
   * @see     JController
   * @since   1.6
   */
  public function __construct($config=array()){
    if(empty($config['filter_fields'])){
      $config['filter_fields']=[
        'name'=>'a.name',
        'alias'=>'a.alias',
        
      ];
    }

    parent::__construct($config);
  }


  /**
   * Build an SQL query to load the list data.
   *
   * @return  JDatabaseQuery
   *
   * @since   1.6
   */
  protected function getListQuery(){
    $db=$this->getDbo();
    $query=$db->getQuery(true);
    $query->select([
      
      'a.name',
      'a.alias',
      
    ])->from('#__multifactories_crudfactories a');
    

    // Filter by search in title
    $search=$this->getState('filter.search');

    if(!empty($search)){
      $query->where('a.name LIKE '.$db->quote('%'.$search.'%').' OR '. 'a.alias LIKE '.$db->quote('%'.$search.'%'));
    }
    
    $orderCol=$this->state->get('list.ordering','ordering');
    $orderDirn=$this->state->get('list.direction','ASC');

    $query->order($db->escape($orderCol.' '.$orderDirn));

    return $query;
  }

  /**
   * Method to get a store id based on model configuration state.
   *
   * This is necessary because the model is used by the component and
   * different modules that might need different sets of data or different
   * ordering requirements.
   *
   * @param   string  $id  A prefix for the store id.
   *
   * @return  string  A store id.
   *
   * @since   1.6
   */
  protected function getStoreId($id=''){
    // Compile the store id.
    $id .= ':'.$this->getState('filter.search');
    
    
    return parent::getStoreId($id);
  }

  /**
   * Returns a reference to the a Table object, always creating it.
   *
   * @param   string  $type    The table type to instantiate
   * @param   string  $prefix  A prefix for the table class name. Optional.
   * @param   array   $config  Configuration array for model. Optional.
   *
   * @return  MultifactoriesTableCrudfactories A database object
   *
   * @since   1.6
   */
  public function getTable($type='Crudfactories',$prefix='MultifactoriesTable',$config=array()){
    return JTable::getInstance($type,$prefix,$config);
  }

  /**
   * Method to auto-populate the model state.
   *
   * Note. Calling getState in this method will result in recursion.
   *
   * @param   string  $ordering   An optional ordering field.
   * @param   string  $direction  An optional direction (asc|desc).
   *
   */
  protected function populateState($ordering=null,$direction=null){
    // Load the filter state.
    $search=$this->getUserStateFromRequest($this->context.'.filter.search','filter_search');
    $this->setState('filter.search',$search);
    
    
    // Load the parameters.
    $params=JComponentHelper::getParams('com_multifactories');
    $this->setState('params',$params);

    // List state information.
    parent::populateState('a.name','asc');
  }

}
