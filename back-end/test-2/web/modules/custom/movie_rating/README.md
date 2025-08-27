# Movie Rating

The **Movie Rating** module provides a way for users to rate movies and integrates those ratings with Drupal Views for filtering, sorting, and display.

## Features

- Stores user-submitted ratings for each Movie node.
- Exposes ratings to **Views**:
  - As a field
  - As a filter
  - As a sort criterion
- Can be extended with custom Views plugins (e.g., to calculate total votes).

## Requirements

- Drupal 10.x (tested with 10.x)
- PHP 8.1+
- A **Directors** & **Actors** Content Type
- A **Category** vocabulary
- And finally A **Movie** content type

## Installation

1. Enable Module by running drush cim or drush en movie_rating.

## Usage

1. Go to /movies to see the list of movies with their ratings. The page also contains 2 blocks namely: Popular Movies and Highly Rated Movies.
2. You can click on any movie from the list of movies or from content to show details of movie and you can rate the movie from that node page as well.
3. Flood Control logic is given in MovieRatingForm.php but is commented for now, so that a single user can do the testing with multiple submits.