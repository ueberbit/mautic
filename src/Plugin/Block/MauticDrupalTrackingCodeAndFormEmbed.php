<?php
/**
 * File: mautic-drupal/Block/MauticDrupalTrackingCodeAndFormEmbed.php
 */

namespace Drupal\mautic_drupal\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Class TrackingCode
 * @package Drupal\mautic_drupal\Block
 *
 * @Block(
 *   id = "mautic_drupal_tracking_code_and_form_embed_block",
 *   admin_label = @Translation("Mautic Tracking Code and Form Embed"),
 *   category = @Translation("System"),
 * )
 */
class MauticDrupalTrackingCodeAndFormEmbed extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = \Drupal::request()->attributes->get('node');

    if ($node) {
      $current_path = \Drupal::service('path.current')->getPath(); // Unsure if this is the best way to get the current path

      $attributes = [
        'title' => $node->getTitle(),
        'type' => $node->getType(),
        'language' => \Drupal::languageManager()->getCurrentLanguage()->getId(), // get name: \Drupal::languageManager()->getCurrentLanguage()->getName()
        'referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $current_path,
        'url' => $current_path
      ];

      $encoded_attributes = urlencode(base64_encode(serialize($attributes)));
    } else {
      $encoded_attributes = '';
    }

    $config = \Drupal::service('config.factory')->get('mautic_drupal.settings');
    $mautic_base_url = trim($config->get('base_url'), ' \t\n\r\0\x0B/');
    $form_js_config = $config->get('load_form_js');

    if ($form_js_config) {
      $form_js = '<script src="' . $mautic_base_url . '/media/js/mautic-form.js"></script>';
    } else {
      $form_js = '';
    }

    return array (
      '#type' => 'markup',
      '#markup' => '<img style="display:none" src="' . $mautic_base_url . '/mtracking.gif?d=' . $encoded_attributes . '" />' . $form_js
    );
  }
}
