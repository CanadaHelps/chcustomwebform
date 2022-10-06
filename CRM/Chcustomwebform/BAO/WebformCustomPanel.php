<?php
// phpcs:disable
use CRM_Chcustomwebform_ExtensionUtil as E;
// phpcs:enable

class CRM_Chcustomwebform_BAO_WebformCustomPanel extends CRM_Chcustomwebform_DAO_WebformCustomPanel {

  /**
   * Create a new WebformCustomPanel based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Chcustomwebform_DAO_WebformCustomPanel|NULL
   */
  /*
  public static function create($params) {
    $className = 'CRM_Chcustomwebform_DAO_WebformCustomPanel';
    $entityName = 'WebformCustomPanel';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  }
  */

}
