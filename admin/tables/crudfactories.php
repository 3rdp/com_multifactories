<?php
/**
 * @package     com_multifactories
 * @subpackage  multifactories
 *
 */
defined('_JEXEC') or die;


/**
 * Multifactories Table
 *
 */
class MultifactoriesTableCrudfactories extends JTable{
  
  /**
  * Id
  *
  * @var string
  */
  public $id;
 

  /**
   * Constructor
   *
   * @param   JDatabaseDriver  &$_db  Database connector object
   *
   */
  public function __construct(&$_db){
    parent::__construct('#__multifactories_crudfactories','id',$_db);
  }

}