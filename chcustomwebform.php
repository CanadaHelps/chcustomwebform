<?php

require_once 'chcustomwebform.civix.php';
// phpcs:disable
use CRM_Chcustomwebform_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function chcustomwebform_civicrm_config(&$config) {
  _chcustomwebform_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function chcustomwebform_civicrm_install(): void {
  _chcustomwebform_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function chcustomwebform_civicrm_postInstall(): void {
  _chcustomwebform_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function chcustomwebform_civicrm_uninstall(): void {
  _chcustomwebform_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function chcustomwebform_civicrm_enable(): void {
  _chcustomwebform_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function chcustomwebform_civicrm_disable(): void {
  _chcustomwebform_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function chcustomwebform_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _chcustomwebform_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function chcustomwebform_civicrm_entityTypes(&$entityTypes): void {
  _chcustomwebform_civix_civicrm_entityTypes($entityTypes);
}

function chcustomwebform_civicrm_buildForm($formName, &$form) {
  if($formName == 'CRM_UF_Form_Group') {
    $profileDataVals = $form->getVar('_defaultValues');
    $profileID = $profileDataVals['id'];
    $profileTitle = $profileDataVals['title'];
    $profileName = $profileDataVals['name'];
    if(($profileTitle === 'Collect Email Opt-In' && $profileName == 'Collect_Email_Opt_In_Template' )|| ($profileTitle === 'Volunteers form' && $profileName == 'Volunteers_form_Template' ))
    {
      global $user;
      $result = civicrm_api3('WebformCustomPanel', 'get', [
        'sequential' => 1,
        'profile_id' => $profileID,
      ]);
      $decode_values = unserialize($result['values'][0]['value']);
      $background_color = '#FFFFFF';
      $button_link_color = '#005c99';
      $titlebar_text_color = '#464354' ;
      $titlebar_background_color = '#bcecd1';
      if(isset($decode_values['profile_form_background_color']))
      $background_color = $decode_values['profile_form_background_color'];
      if(isset($decode_values['profile_form_button_link_color']))
      $button_link_color = $decode_values['profile_form_button_link_color'];
      if(isset($decode_values['profile_form_titlebar_text_color']))
      $titlebar_text_color = $decode_values['profile_form_titlebar_text_color'];
      if(isset($decode_values['profile_form_titlebar_background_color']))
      $titlebar_background_color = $decode_values['profile_form_titlebar_background_color'];
      CRM_Core_Resources::singleton()->addScript(
        "CRM.$(function($) {
        cj('.crm-accordion-body' ).find('div').find('table.form-layout').find('tbody').find('tr:last').after('<tr class=\"crm-uf-advancesetting-form-block-background-color\"><td class=\"label\"><label>Background Color</label></td><td><input class=\"crm-form-color crm-form-text\"  style=\"width:20px\" name=\"profile_form_background_color\" type=\"color\" value=\"$background_color\" id=\"profile_form_background_color\"></td></tr>');
        cj('.crm-accordion-body' ).find('div').find('table.form-layout').find('tbody').find('tr:last').after('<tr class=\"crm-uf-advancesetting-form-block-button_and_linnks-color\"><td class=\"label\"><label>Button & Links Color</label></td><td><input class=\"crm-form-color crm-form-text\" style=\"width:20px\" name=\"profile_form_button_link_color\" type=\"color\" value=\"$button_link_color\" id=\"profile_form_button_link_color\"></td></tr>');
        cj('.crm-accordion-body' ).find('div').find('table.form-layout').find('tbody').find('tr:last').after('<tr class=\"crm-uf-advancesetting-form-block-titlebar_text-color\"><td class=\"label\"><label>Title Bar Text</label></td><td><input class=\"crm-form-color crm-form-text\" style=\"width:20px\" name=\"profile_form_titlebar_text_color\" type=\"color\" value=\"$titlebar_text_color\" id=\"profile_form_titlebar_text_color\"></td></tr>');
        cj('.crm-accordion-body' ).find('div').find('table.form-layout').find('tbody').find('tr:last').after('<tr class=\"crm-uf-advancesetting-form-block-titlebar_background-color\"><td class=\"label\"><label>Title bar Background</label></td><td><input class=\"crm-form-color crm-form-text\" style=\"width:20px\" name=\"profile_form_titlebar_background_color\" type=\"color\" value=\"$titlebar_background_color\" id=\"profile_form_titlebar_background_color\"></td></tr>');
        });"
      );
    }
  }
}

function chcustomwebform_civicrm_postProcess($formName, &$form) {
  
  if($formName == 'CRM_UF_Form_Group') {
    global $user;
    $submitted = $form->getVar('_submitValues');
    $profileID = $form->getVar('_id');
    if(isset($submitted) &&!empty($submitted))
    {
      $customWebformData = $submitted;
      $customWebformData['ID'] = $profileID;
      unset($customWebformData['qfKey']);
      unset($customWebformData['_qf_default']);
      unset($customWebformData['_qf_Group_next']);
      $jsonEncodedData =  serialize($customWebformData);
      $result = civicrm_api3('WebformCustomPanel', 'get', [
        'sequential' => 1,
        'return' => ["id"],
        'profile_id' => $profileID,
      ]);
      if($result['values'])
      {
        civicrm_api3('WebformCustomPanel', 'create', [
          'profile_id' => $profileID,
          'value' => $jsonEncodedData,
          'created_date' => date('YmdHis'),
          'created_id' => $user->uid,
          'id' => $result['values'][0]['id']
        ]);
      }else{
        civicrm_api3('WebformCustomPanel', 'create', [
          'profile_id' => $profileID,
          'value' => $jsonEncodedData,
          'created_date' => date('YmdHis'),
          'created_id' => $user->uid,
        ]);
      }
    }
  }
}

function chcustomwebform_civicrm_alterContent( &$content, $context, $tplName, &$object ) {
  $templateVars = $object->get_template_vars();
  if ($tplName === 'CRM/UF/Page/Group.tpl' && isset($templateVars['profile'])) {
    $webformPanelResult = civicrm_api3('WebformCustomPanel', 'get', [
      'sequential' => 1,
      'return' => ["value"],
      'profile_id' => $templateVars['gid'],
    ]);
    if($webformPanelResult['values'])
    {
      $profile = html_entity_decode($templateVars['profile']);
      $profile = preg_replace(
        '/(<script.+?(?=<\/script>)<\/script>)/s',
        '<div style="display:none">${1}</div>',
        $profile
      );
      $profile = preg_replace(
        '/<button class=".+?(?=")"/s',
        '<button class="btn btn-primary"',
        $profile
      );

      $urlReplaceWith = 'dms/profile/create?gid=' . $templateVars['gid'] . '&reset=1';
      $profile = str_replace('dms/admin/uf/group', $urlReplaceWith, $profile);
      $profile = htmlentities($profile, ENT_NOQUOTES, 'UTF-8');
      
      $profileDataLog =  unserialize($webformPanelResult['values'][0]['value']);
      if(isset($profileDataLog['profile_form_background_color']))
      $background_color = $profileDataLog['profile_form_background_color'];
      if(isset($profileDataLog['profile_form_button_link_color']))
      $button_link_color = $profileDataLog['profile_form_button_link_color'];
      if(isset($profileDataLog['profile_form_titlebar_text_color']))
      $titlebar_text_color = $profileDataLog['profile_form_titlebar_text_color'];
      if(isset($profileDataLog['profile_form_titlebar_background_color']))
      $titlebar_background_color = $profileDataLog['profile_form_titlebar_background_color'];

      $profile = $profile."
      <style>
      .crm-container .help{background:$titlebar_background_color;color:$titlebar_text_color;}
      .crm-container .btn-primary.active, .crm-container .btn-primary:active, .crm-container .btn-primary:focus,.crm-container .btn-primary:hover{
        background-color:$button_link_color!important;
      }
      .crm-container .btn-primary{background-color:$button_link_color;}
      .crm-container {background:$background_color;}
      </style>";

      $content = preg_replace(
        '/(<textarea.+name="profile".+?>)(.+?)(?=<\/textarea>)(<\/textarea>)/s',
        '${1}'.$profile.'${3}',
        $content
      );
    }
  }
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function chcustomwebform_civicrm_preProcess($formName, &$form): void {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
//function chcustomwebform_civicrm_navigationMenu(&$menu): void {
//  _chcustomwebform_civix_insert_navigation_menu($menu, 'Mailings', [
//    'label' => E::ts('New subliminal message'),
//    'name' => 'mailing_subliminal_message',
//    'url' => 'civicrm/mailing/subliminal',
//    'permission' => 'access CiviMail',
//    'operator' => 'OR',
//    'separator' => 0,
//  ]);
//  _chcustomwebform_civix_navigationMenu($menu);
//}
