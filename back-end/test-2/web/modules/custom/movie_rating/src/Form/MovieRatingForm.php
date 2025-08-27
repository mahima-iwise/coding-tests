<?php

namespace Drupal\movie_rating\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MovieRatingForm extends FormBase {

  protected $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public static function create(ContainerInterface $container) {
    return new static($container->get('database'));
  }

  public function getFormId() {
    return 'movie_rating_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state, $nid = NULL) {
    $form['nid'] = ['#type' => 'hidden', '#value' => $nid];

    $form['rating'] = [
      '#type' => 'select',
      '#title' => $this->t('Rate this movie'),
      '#options' => [
        1 => '★☆☆☆☆ (1)',
        2 => '★★☆☆☆ (2)',
        3 => '★★★☆☆ (3)',
        4 => '★★★★☆ (4)',
        5 => '★★★★★ (5)',
      ],
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $nid = $form_state->getValue('nid');
    $rating = $form_state->getValue('rating');
    $ip = \Drupal::request()->getClientIp();

    
    // Flood control: allow 1 vote per IP per hour
    // $flood = \Drupal::flood();
    // if (!$flood->isAllowed('movie_rating_' . $nid, 1, 3600, $ip)) {
    //   $this->messenger()->addError($this->t('You can only vote once per hour.'));
    //   return;
    // }

    $this->database->insert('movie_rating')
      ->fields([
        'nid' => $nid,
        'rating' => $rating,
        'ip_address' => $ip,
        'created' => time(),
      ])->execute();

    //$flood->register('movie_rating_' . $nid, 3600, $ip);

    $this->messenger()->addMessage($this->t('Thank you for rating!'));
  }
}