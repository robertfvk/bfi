<?php

namespace Drupal\articles\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;

/**
 * Class ArticlesController.
 */
class ArticlesController extends ControllerBase {



  /**
   * Articles.
   *
   * @return string
   * Return articles markup
   */
  public function content() {

    $items = [];

    // build query to pass to BFI endpoint
    $query =  ['page' => 1, 'size' => 10];
    if (isset($_GET['type'])) {
        $query['type'] = $_GET['type'];
    }
    if (isset($_GET['author'])) {
      $query['author'] = $_GET['author'];
    }

    // fetch all articles
    $articles = $this->fetch('api/articles', $query);

    // render each article item
    if (!empty($articles)) {
      foreach($articles as $article) {
        $item = [
          '#theme' => 'articles_item',
          '#title' => $article['title'],
          '#summary' => $article['summary'],
          '#article_type' => $article['type'],
          '#authors' => $article['authors'],
          '#image' => $article['primary_image']
        ];
        $items [] = \Drupal::service('renderer')->renderPlain($item);
      }
    }

    return [
      '#theme' => 'articles_page',
      '#types' => $this->fetch('api/types'),
      '#items' => $items,
      '#activeType' => isset($query['type']) ? $query['type'] : '',
      '#attached' => [
        'library' => [
          'articles/articles',
        ],
      ],
    ];
  }

  /**
   * Function to retrieve data from BFI endpoint
   *
   * @param string $url
   * @param array $query
   * @return array
   */
  public function fetch(string $url, array $query = []) : array
  {
    $client = \Drupal::service('http_client_factory')->fromOptions([
      'base_uri' => 'https://content-store.explore.bfi.digital/',
    ]);

    $response = $client->get($url, ['query' => $query]);

    // if successful return decoded response
    if ($response->getStatusCode() === 200) {
      $body = Json::decode($response->getBody());
      if($body['data']) {
        return $body['data'];
      }
    }
    else {
      \Drupal::logger('articles')->error("Error connecting to $url");
    }

    return [];
  }

}
