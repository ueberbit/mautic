<?php
/**
 * File: mautic-drupal/Form/MauticSettingsForm.php
 */

namespace Drupal\mautic\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class MauticSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mautic_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return [
      'mautic.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('mautic.settings');

    $form['mautic_base_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Mautic URL'),
      '#default_value' => $config->get('base_url'),
      '#size' => 60,
      '#description' => t("Your mautic base url."),
      '#required' => TRUE,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('mautic.settings');

    $config->set('base_url', $form_state->getValue('mautic_base_url'))->save();

    parent::submitForm($form, $form_state);
  }
}
