<?php

namespace Drupal\devportal_repo_sync\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * The config form for the UUID and secret key.
 */
class RepoSyncConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'devportal_repo_sync.config',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'devportal_repo_sync_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('devportal_repo_sync.config');
    $form['uuid'] = [
      '#type' => 'textfield',
      '#title' => $this->t('UUID'),
      '#description' => $this->t('The UUID of your account'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('uuid'),
      '#required' => TRUE,
    ];
    $form['secret'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Secret'),
      '#description' => $this->t('The secret key of your account'),
      '#default_value' => $config->get('secret'),
      '#required' => TRUE,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('devportal_repo_sync.config')
      ->set('uuid', $form_state->getValue('uuid'))
      ->set('secret', $form_state->getValue('secret'))
      ->save();
  }

}