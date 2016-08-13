<?php
/**
 * File: mautic-drupal/Form/MauticDrupalSettingsForm.php
 */

namespace Drupal\mautic_drupal\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class MauticDrupalSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mautic_drupal_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return [
      'mautic_drupal.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('mautic_drupal.settings');

    $form['mautic_base_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Mautic URL'),
      '#default_value' => $config->get('base_url'),
      '#size' => 60,
      '#description' => t("Your mautic base url."),
      '#required' => TRUE,
    );

    $form['mautic_load_form_js'] = array(
      '#type' => 'checkbox',
      '#title' => t('Use Mautic Forms'),
      '#default_value' => $config->get('load_form_js'),
      '#description' => t("If you want to embed a Mautic Form, it is necessary to load a JavaScript file."),
      '#required' => FALSE,
    );

    if ($config->get('load_form_js')) {
      $form['mautic_shortcode_example'] = array(
        '#type' => 'textfield',
        '#title' => t('Mautic Form Shortcode'),
        '#default_value' => '{mauticform id=1 width=300px height=300px}',
        '#description' => t("Insert the shortcode to your content. Mautic Form JavaScript will replace this code with iframe of Mautic form with ID 1. Change the ID to the ID of the for you want to load. You can change width and height as your for needs."),
        '#required' => FALSE,
        '#disabled' => TRUE
      );
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('mautic_drupal.settings');

    $config->set('base_url', $form_state->getValue('mautic_base_url'))->save();
    $config->set('load_form_js', $form_state->getValue('mautic_load_form_js'))->save();

    parent::submitForm($form, $form_state);
  }
}
