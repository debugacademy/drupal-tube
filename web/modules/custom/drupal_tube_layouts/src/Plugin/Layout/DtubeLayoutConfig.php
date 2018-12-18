<?php

namespace Drupal\drupal_tube_layouts\Plugin\Layout;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Layout\LayoutDefault;
use Drupal\Core\Plugin\PluginFormInterface;

/**
 * Class DtubeLayoutConfig
 *
 * @package Drupal\drupal_tube_layouts\Plugin\Layout.
 */
class DtubeLayoutConfig extends LayoutDefault implements PluginFormInterface {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function build(array $regions) {
    $build = parent::build($regions);
    if (!empty($this->configuration['bgcolor'])) {
      $build['#attributes']['class'][] = $this->configuration['bgcolor'];
    }
    if (!empty($this->configuration['spacing'])) {
      foreach ($this->configuration['spacing'] as $spacing_class) {
        if (!empty($spacing_class)) {
          $build['#attributes']['class'][] = $spacing_class;
        }
      }
    }
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $bg_values = [
      'bg-primary' => t('Primary (White)'),
      'bg-secondary' => t('Secondary (Biege)'),
      'bg-featured' => t('Featured (Gray)'),
    ];
    $form['bgcolor'] = [
      '#type' => 'select',
      '#title' => 'Section Background color',
      '#options' => $bg_values,
      '#default_value' => $this->configuration['bgcolor'],
    ];
    $padding_options = [
      'space-top' => t('Space above content'),
      'space-bottom' => t('Space below content'),
      'space-between' => t('Space between content'),
      'space-beside' => t('Space beside section'),
    ];
    $form['spacing'] = [
      '#type' => 'checkboxes',
      '#title' => 'Section Padding',
      '#options' => $padding_options,
      '#default_value' => $this->configuration['spacing'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
    // Add any validations if required.
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration['bgcolor'] = $form_state->getValue('bgcolor');
    $spacing = $form_state->getValue('spacing');
    foreach ($spacing as $key => $value) {
      if (empty($spacing[$key])) {
        unset($spacing[$key]);
      }
    }
    $this->configuration['spacing'] = $spacing;
  }

}
