<?php

/**
 * Implements hook_views_data().
 */
function movie_rating_views_data() {
  $data = [];

  // Our custom table definition.
  $data['movie_rating']['table'] = [
    'group' => t('Movie Rating'),
    'provider' => 'movie_rating',
    'join' => [
      // Join movie_rating.nid to node_field_data.nid
      'node_field_data' => [
        'left_field' => 'nid',
        'field' => 'nid',
        'type' => 'LEFT',
      ],
    ],
  ];

  // Relationship so we can connect nodes → ratings.
  $data['movie_rating']['node_rel'] = [
    'title' => t('Movie rating (relationship)'),
    'help' => t('Relates a movie node to its ratings.'),
    'relationship' => [
      'id' => 'standard',
      'base' => 'movie_rating',      // Table we’re relating to.
      'base field' => 'nid',         // Field in that table.
      'relationship field' => 'nid', // Field on this table.
      'label' => t('Movie rating'),
    ],
  ];

  // Expose rating value as field/filter/sort.
  $data['movie_rating']['rating'] = [
    'title' => t('Rating'),
    'help' => t('User submitted rating for movies.'),
    'field' => [
      'id' => 'numeric',
    ],
    'filter' => [
      'id' => 'numeric',
    ],
    'sort' => [
      'id' => 'standard',
    ],
  ];

  // Attach our custom field to nodes table.
  $data['node_field_data']['movie_rating_count'] = [
    'title' => t('Movie Rating Count'),
    'help' => t('Displays the number of ratings for this node.'),
    'field' => [
      'id' => 'movie_rating_count', 
    ],
    'filter' => [
      'id' => 'numeric',
    ],
    'sort' => [
      'id' => 'standard',
    ],
    
  ];

  return $data;
}
