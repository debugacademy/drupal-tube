<?php

namespace Drupal\drupal_tube_layouts\Plugin\Layout;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Layout\LayoutDefault;
use Drupal\Core\Plugin\PluginFormInterface;

/**
 * Class DtubeLayoutConfig
 */
class DtubeLayoutConfig extends LayoutDefault implements PluginFormInterface {
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
    
    return $form;
  }

  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
    
  }

  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    
  }
  



  
}