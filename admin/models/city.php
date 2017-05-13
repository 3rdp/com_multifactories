<?php
/**
 * @package     com_multifactories
 * @subpackage  city
 *
 */

defined('_JEXEC') or die;

/**
 * City model.
 *
 */
class MultifactoriesModelCity extends JModelAdmin{

  /**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 */
	public function __construct($config = array()){
		parent::__construct($config);
	}

  /**
   * Method to get a single record.
   *
   * @param   integer  $pk  The id of the primary key.
   * @return  mixed    Object on success, false on failure.
   */
  public function getItem($pk = null){
    return parent::getItem($pk);
  }

  /**
   * Method to test whether a record can be deleted.
   *
   * @param object $record A record object.
   * @return boolean True if allowed to delete the record. Defaults to the permission set in the component.
   */
  protected function canDelete($record){
    return parent::canDelete($record);
    /*
    if(!empty($record->id)){
      if($record->state != -2){
        return;
      }

      $user=JFactory::getUser();

      if(!empty($record->catid)){
        return $user->authorise('core.delete','com_multifactories.city.'.(int)$record->catid);
      }else{
        return parent::canDelete($record);
      }
    }
    */
  }


  /**
   * Returns a  object, always creating it.
   *
   * @param   string  $type    The table type to instantiate. [optional]
   * @param   string  $prefix  A prefix for the table class name. [optional]
   * @param   array   $config  Configuration array for model. [optional]
   *
   * @return  MultifactoriesTableCity  A database object
   *
   */
  public function getTable($type='City',$prefix='MultifactoriesTable',$config=array()){
    return JTable::getInstance($type,$prefix,$config);
  }

  /**
   * Method to get the record form.
   *
   * @param   array    $data      Data for the form. [optional]
   * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not. [optional]
   *
   * @return  mixed  A JForm object on success, false on failure
   *
   */
  public function getForm($data=array(),$loadData=true){
    // Get the form.
    $form=$this->loadForm('com_multifactories.city','city',array('control'=>'jform','load_data'=>$loadData));

    if(empty($form)){
      return false;
    }

    return $form;
  }

  /**
   * Method to get the data that should be injected in the form.
   *
   * @return  mixed  The data for the form.
   *
   */
  protected function loadFormData(){
    // Check the session for previously entered form data.
    $app=JFactory::getApplication();
    $data=$app->getUserState('com_multifactories.edit.city.data',array());

    if(empty($data)){
      $data=$this->getItem();
    }

    $this->preprocessData('com_multifactories.city',$data);

    return $data;
  }

  /**
   * Prepare and sanitise the table prior to saving.
   *
   * @param   JTable  $table  A JTable object.
   *
   * @return  void
   *
   */
  protected function prepareTable($table){
    $date=JFactory::getDate();
    $user=JFactory::getUser();
    /*
    if(empty($table->id)){
      // Set the values
      $table->created=$date->toSql();
      $table->created_by=$user->id;
    }else{
      // Set the values
      $table->modified=$date->toSql();
      $table->modified_by=$user->get('id');
    }
    // Increment the content version number.
    $table->version++;
    */
  }

  /**
   * Method to save the form data.
   *
   * @param   array  $data  The form data.
   *
   * @return  boolean  True on success.
   *
   */
  public function save($data){
    $input=JFactory::getApplication()->input;

    // Alter the unique data for save as copy
    if($input->get('task') == 'save2copy'){
    }

    if(parent::save($data)){
      return true;
    }

    return false;
  }

}
