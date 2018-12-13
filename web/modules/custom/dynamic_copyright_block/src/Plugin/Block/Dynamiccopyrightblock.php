<?php

namespace Drupal\dynamic_copyright_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Dynamiccopyrightblock' block.
 *
 * @Block(
 *  id = "dynamiccopyrightblock",
 *  admin_label = @Translation("Dynamiccopyrightblock"),
 * )
 */
class Dynamiccopyrightblock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
            'copyright_text_prefix' => 'Copyright ©',
          ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['copyright_text_prefix'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Copyright text prefix'),
    '#description' => $this->t('Text before the copyright year.'),
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
    $build['dynamiccopyrightblock_copyright_text_prefix']['#markup'] = '<p>' . $this->configuration['copyright_text_prefix'] . '</p>';

    return $build;
  }

}
