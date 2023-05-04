<?php


namespace Drupal\search_api_empty_search\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Empty Search entity.
 *
 * @ingroup empty_search
 *
 * @ContentEntityType(
 *   id = "empty_search",
 *   label = @Translation("Empty Search"),
 *   base_table = "empty_search",
 *   persistent_cache = FALSE,
 *   handlers = {
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "storage_schema" =
 *   "Drupal\search_api_empty_search\EmptySearchStorageSchema",
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "term" = "term",
 *     "count" = "count",
 *     "changed" = "changed",
 *   },
 * )
 */
class EmptySearch extends ContentEntityBase implements ContentEntityInterface {


  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID.'))
      ->setReadOnly(TRUE);


    $fields['term'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Keyword'))
      ->setDescription(t('The keyword.'));


    $fields['count'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Count'))
      ->setDescription(t('The number of occurrence.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('changed'))
      ->setDescription(t('Last update.'));


    return $fields;
  }

}
