<?php

namespace Drupal\movie_rating\Plugin\views\field;

use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;
use Drupal\Core\Database\Database;

/**
 * Provides a field to show the count of ratings for each movie node.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("movie_rating_count")
 */
class RatingCount extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function usesGroupBy() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Prevent Views from trying to add this field to the SQL query.
    $this->field_alias = 'movie_rating_count';
  }

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    $nid = $values->_entity->id();

    $connection = \Drupal::database();
    $count = $connection->select('movie_rating', 'mr')
      ->condition('mr.nid', $nid)
      ->countQuery()
      ->execute()
      ->fetchField();

    return (string) ($count ?: 0);
  }

}
