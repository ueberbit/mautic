<?php
/**
 * File: mautic-drupal/Block/MauticDrupalFormEmbedBlock.php
 */

namespace Drupal\mautic_drupal\Plugin\Block;

use Drupal\Core\Block\BlockBase;


/**
 * Class TrackingCode
 * @package Drupal\mautic_drupal\Block
 *
 * @Block(
 *   id = "mautic_drupal_tracking_code_and_form_embed_block",
 *   admin_label = @Translation("Mautic Form Embed Block"),
 *   category = @Translation("System"),
 * )
 */
class MauticDrupalFormEmbedBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::service('config.factory')->get('mautic_drupal.settings');
    $mautic_base_url = $config->get('base_url');
    $form_js_config = $config->get('load_form_js');

    if ($form_js_config) {
      $form_js = '<script src="' . $mautic_base_url . '/media/js/mautic-form.js"></script>';
    } else {
      $form_js = '';
    }

    return array (
      '#type' => 'markup',
      '#markup' => $form_js
    );
  }
}
