<?php
/**
 * @package     com_multifactories
 * @subpackage  city
 *
 */
defined('_JEXEC') or die;


/**
 * Multifactories Table
 *
 */
class MultifactoriesTableCity extends JTable{
  
  /**
  * Subdomain name
  *
  * @var string
  */
  public $subdomain_name;
 
  /**
  * Factory
  *
  * @var integer
  */
  public $factory_id;
 

  /**
   * Constructor
   *
   * @param   JDatabaseDriver  &$_db  Database connector object
   *
   */
  public function __construct(&$_db){
    parent::__construct('#__multifactories_city','id',$_db);
  }

}
