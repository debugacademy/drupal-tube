<?php

namespace Drupal\dynamic_copyright_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Copyrightblock' block.
 *
 * @Block(
 *  id = "copyrightblock",
 *  admin_label = @Translation("Copyrightblock"),
 * )
 */
class Copyrightblock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
          ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['copyright_text_prefix'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Copyright text prefix'),
    '#description' => $this->t('Copyright@'),
      '#default_value' => $this->configuration['copyright_text_prefix'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['copyright_text_prefix'] = $form_state->getValue('copyright_text_prefix');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['copyrightblock_copyright_text_prefix']['#markup'] = '<p>' . $this->configuration['copyright_text_prefix'] . '</p>';

    return $build;
  }

}
