<?php

namespace Drupal\media_entity_smugmug\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\media_entity_smugmug\SmugMugMarkup;
use Drupal\media_entity_smugmug\Plugin\MediaEntity\Type\SmugMug;

/**
 * Plugin implementation of the 'smugmug_embed' formatter.
 *
 * @FieldFormatter(
 *   id = "smugmug_embed",
 *   label = @Translation("SmugMug embed"),
 *   field_types = {
 *     "link", "string", "string_long"
 *   }
 * )
 */
class SmugMugEmbedFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    /** @var \Drupal\media_entity\MediaInterface $media_entity */
    $media_entity = $items->getEntity();

    $element = [];
    if (($type = $media_entity->getType()) && $type instanceof SmugMug) {
      foreach ($items as $delta => $item) {
        $element[$delta] = [
          '#markup' => SmugMugMarkup::create($type->getField($media_entity, 'html')),
        ];
      }
    }

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(FieldDefinitionInterface $field_definition) {
    return $field_definition->getTargetEntityTypeId() === 'media';
  }

}
