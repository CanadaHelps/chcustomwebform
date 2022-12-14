<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from chcustomwebform/xml/schema/CRM/Chcustomwebform/WebformCustomPanel.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:3cff4e9051e171cc7ad6db4cfe30cc6b)
 */
use CRM_Chcustomwebform_ExtensionUtil as E;

/**
 * Database access object for the WebformCustomPanel entity.
 */
class CRM_Chcustomwebform_DAO_WebformCustomPanel extends CRM_Core_DAO {
  const EXT = E::LONG_NAME;
  const TABLE_ADDED = '';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_webform_custom_panel';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = TRUE;

  /**
   * Unique WebformCustomPanel ID
   *
   * @var int
   */
  public $id;

  /**
   * FK to UF Group
   *
   * @var int
   */
  public $profile_id;

  /**
   * @var text
   */
  public $value;

  /**
   *  When was the setting created
   *
   * @var datetime
   */
  public $created_date;

  /**
   * who created this setting
   *
   * @var int
   */
  public $created_id;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_webform_custom_panel';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? E::ts('Webform Custom Panels') : E::ts('Webform Custom Panel');
  }

  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  public static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'profile_id', 'civicrm_uf_group', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }

  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  public static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = [
        'id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => E::ts('Unique WebformCustomPanel ID'),
          'required' => TRUE,
          'where' => 'civicrm_webform_custom_panel.id',
          'table_name' => 'civicrm_webform_custom_panel',
          'entity' => 'WebformCustomPanel',
          'bao' => 'CRM_Chcustomwebform_DAO_WebformCustomPanel',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => NULL,
        ],
        'profile_id' => [
          'name' => 'profile_id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => E::ts('FK to UF Group'),
          'where' => 'civicrm_webform_custom_panel.profile_id',
          'table_name' => 'civicrm_webform_custom_panel',
          'entity' => 'WebformCustomPanel',
          'bao' => 'CRM_Chcustomwebform_DAO_WebformCustomPanel',
          'localizable' => 0,
          'FKClassName' => 'CRM_Core_DAO_UFGroup',
          'add' => '5.18',
        ],
        'value' => [
          'name' => 'value',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => E::ts('Value of UF Group data'),
          'import' => TRUE,
          'where' => 'civicrm_webform_custom_panel.value',
          'export' => TRUE,
          'table_name' => 'civicrm_webform_custom_panel',
          'entity' => 'WebformCustomPanel',
          'bao' => 'CRM_Chcustomwebform_DAO_WebformCustomPanel',
          'localizable' => 0,
          'add' => '5.18',
        ],
        'created_date' => [
          'name' => 'created_date',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => E::ts('Created Date'),
          'description' => E::ts(' When was the setting created '),
          'where' => 'civicrm_webform_custom_panel.created_date',
          'table_name' => 'civicrm_webform_custom_panel',
          'entity' => 'WebformCustomPanel',
          'bao' => 'CRM_Chcustomwebform_DAO_WebformCustomPanel',
          'localizable' => 0,
          'add' => '5.18',
        ],
        'created_id' => [
          'name' => 'created_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => E::ts('Created ID'),
          'description' => E::ts('who created this setting '),
          'import' => TRUE,
          'where' => 'civicrm_webform_custom_panel.created_id',
          'export' => TRUE,
          'table_name' => 'civicrm_webform_custom_panel',
          'entity' => 'WebformCustomPanel',
          'bao' => 'CRM_Chcustomwebform_DAO_WebformCustomPanel',
          'localizable' => 0,
          'add' => '5.18',
        ],
      ];
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }

  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  public static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }

  /**
   * Returns the names of this table
   *
   * @return string
   */
  public static function getTableName() {
    return self::$_tableName;
  }

  /**
   * Returns if this table needs to be logged
   *
   * @return bool
   */
  public function getLog() {
    return self::$_log;
  }

  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &import($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'webform_custom_panel', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &export($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'webform_custom_panel', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of indices
   *
   * @param bool $localize
   *
   * @return array
   */
  public static function indices($localize = TRUE) {
    $indices = [];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
