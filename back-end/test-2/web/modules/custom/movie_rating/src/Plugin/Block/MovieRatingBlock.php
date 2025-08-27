<?php

namespace Drupal\movie_rating\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides a 'Movie Rating Block'.
 *
 * @Block(
 *   id = "movie_rating_block",
 *   admin_label = @Translation("Movie Rating Block")
 * )
 */
class MovieRatingBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $formBuilder;
  protected $database;

  /**
   * Constructs a MovieRatingBlock object.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $formBuilder, Connection $database) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $formBuilder;
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder'),
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node && $node->getType() === 'movies') {
      $nid = $node->id();

      // Calculate average rating.
      $query = $this->database->select('movie_rating', 'm')
        ->fields('m', ['rating'])
        ->condition('nid', $nid);
      $ratings = $query->execute()->fetchCol();
      $avg = $ratings ? round(array_sum($ratings) / count($ratings), 1) : 0;

      return [
        '#markup' => '<div class="movie-rating">⭐ Average Rating: ' . $avg . ' / 5</div>',
        'form' => $this->formBuilder->getForm('Drupal\movie_rating\Form\MovieRatingForm', $nid),
        '#attached' => [
          'library' => ['movie_rating/rating'],
        ],
      ];
    }
    return [];
  }

}
