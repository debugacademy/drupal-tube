<?php

namespace Drupal\drupal_tube_layouts\Plugin\Layout;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Layout\LayoutDefault;
use Drupal\Core\Plugin\PluginFormInterface;

/**
 * Class DtubeLayoutConfig
 */
class DtubeLayoutConfig extends LayoutDefault implements PluginFormInterface {
  public function build(array $regions) {
    $build = parent::build($regions);
    $build['#attributes']['class'][] = $this->configuration['bgcolor'];
    if (!empty($this->configuration['spacing'])) {
      foreach ($this->configuration['spacing'] as $padding_prop) {
        $build['#attributes']['class'][] = $padding_prop;
      }
    }
    return $build;
  }
  
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $bg_values = [
      'lb-bg-primary' => t('Primary (White)'),
      'lb-bg-secondary' => t('Secondary (Biege)'),
      'lb-bg-featured' => t('Featured (Gray)'),
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

  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
    
  }

  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration['bgcolor'] = $form_state->getValue('bgcolor');
    
    $spacing_values = $form_state->getValue('spacing');
    foreach ($spacing_values as $index => $value) {
      if (empty($spacing_values[$index])) {
        unset($spacing_values[$index]);
      }
    }
    $this->configuration['spacing'] = $spacing_values;
  }

  
}