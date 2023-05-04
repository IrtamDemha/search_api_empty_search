<?php

namespace Drupal\search_api_empty_search\EventSubscriber;


use Drupal\search_api\Event\ProcessingResultsEvent;
use Drupal\search_api\Event\SearchApiEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class SearchEventSubScriber.
 *
 * @package Drupal\search_api_empty_search
 */
class SearchEventSubScriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[SearchApiEvents::PROCESSING_RESULTS][] = [
      'onProcessingResult',
      800,
    ];
    return $events;
  }

  /**
   * @param ProcessingResultsEvent $event
   */
  public function onProcessingResult(ProcessingResultsEvent $event) {
    //    Check the landing view and the result count  = 0.
    if ($event->getResults()
        ->getQuery()
        ->getSearchId() == 'views_block_landing:search__block_landing' && $event->getResults()
        ->getResultCount() == 0) {
      $query = \Drupal::database()
        ->query("INSERT INTO empty_search (term, count,changed) VALUES ('" . $event->getResults()
            ->getQuery()
            ->getOriginalKeys() . "', 1," . time() . ") ON DUPLICATE KEY UPDATE count = count+1, changed = " . time() . "");
    }
  }

}
