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
      'class' => '',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function build(array $regions) {
    $build = parent::build($regions);
    if (!empty($this->configuration['class'])) {
      $build['#attributes']['class'][] = $this->configuration['class'];
    }
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $bg_values = [
      'layout-bg-grey' => t('Grey'),
    ];
    $form['bgcolor'] = [
      '#type' => 'select',
      '#title' => 'Background overlay color',
      '#options' => $bg_values,
      '#default_value' => $this->configuration['bgcolor'],
    ];
    // $form['media'] = [
    //   '#title' => $this->t('Background image'),
    //   '#type' => 'entity_autocomplete',
    //   '#target_type' => 'media',
    //   '#selection_handler' => 'default',
    //   '#selection_settings' => [
    //     'target_bundles' => ['image'],
    //   ],
    // ];
    // if (!empty($this->configuration['media'])) {
    //   $form['media']['#default_value'] = \Drupal::entityTypeManager()->getStorage('media')->load($this->configuration['media']);
    // }
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
    // $this->configuration['media'] = $form_state->getValue('media');
  }

}
