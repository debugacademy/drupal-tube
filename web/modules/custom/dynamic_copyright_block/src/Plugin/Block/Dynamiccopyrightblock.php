<?php

namespace Drupal\dynamic_copyright_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'DynamicCopyrightBlock' block.
 *
 * @Block(
 *  id = "dynamic_copyright_block",
 *  admin_label = @Translation("Dynamic copyright block"),
 * )
 */
class DynamicCopyrightBlock extends BlockBase {

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
    '#description' => $this->t('Text before the copyright year'),
      '#default_value' => $this->configuration['copyright_text_prefix'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '4',
    ];
    $form['copyright_year'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Copyright year'),
      '#description' => $this->t('Copyright year. Leave blank for current year.'),
      '#default_value' => $this->configuration['copyright_year'],
      '#maxlength' => 12,
      '#size' => 12,
      '#weight' => '5',
    ];
    $form['copyright_text_suffix'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Copyright text suffix'),
    '#description' => $this->t('Text after the copyright year'),
      '#default_value' => $this->configuration['copyright_text_suffix'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '6',
    ];
    $form['copyright_color'] = [
      '#type' => 'color',
      '#title' => $this
        ->t('Copyright text color'),
      '#default_value' => $this->configuration['copyright_color'],
      '#weight' => '7',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['copyright_text_prefix'] = $form_state->getValue('copyright_text_prefix');
    $this->configuration['copyright_year'] = $form_state->getValue('copyright_year');
    $this->configuration['copyright_text_suffix'] = $form_state->getValue('copyright_text_suffix');
    $this->configuration['copyright_color'] = $form_state->getValue('copyright_color');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];

    $prefix = $this->configuration['copyright_text_prefix'];
    if (empty($this->configuration['copyright_year'])) {
      $year = date('Y');
    }
    else {
      $year = $this->configuration['copyright_year'];
    }
    $suffix = $this->configuration['copyright_text_suffix'];
    $color = $this->configuration['copyright_color'];

    $build['dc_block']['#markup'] = "<p>{$prefix}{$year}{$suffix}</p>";

    return $build;
  }

}