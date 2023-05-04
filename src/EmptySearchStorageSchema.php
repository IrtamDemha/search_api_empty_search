<?php

namespace Drupal\search_api_empty_search;

use Drupal\Core\Entity\ContentEntityTypeInterface;
use Drupal\Core\Entity\Sql\SqlContentEntityStorageSchema;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Field\RequiredFieldStorageDefinitionInterface;

/**
 * Defines the comment schema handler.
 */
class EmptySearchStorageSchema extends SqlContentEntityStorageSchema {

  /**
   * {@inheritdoc}
   */
  protected function getEntitySchema(ContentEntityTypeInterface $entity_type, $reset = FALSE) {
    $schema = parent::getEntitySchema($entity_type, $reset);
    //   Set unique index.
    $schema['empty_search']['unique keys'] = ['empty_search__unique' => ['term']];
    return $schema;
  }


}
