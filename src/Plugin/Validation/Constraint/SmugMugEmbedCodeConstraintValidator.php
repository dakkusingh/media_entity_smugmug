<?php

namespace Drupal\media_entity_smugmug\Plugin\Validation\Constraint;

use Drupal\media_entity\EmbedCodeValueTrait;
use Drupal\media_entity_smugmug\Plugin\MediaEntity\Type\SmugMug;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the SmugMugEmbedCode constraint.
 */
class SmugMugEmbedCodeConstraintValidator extends ConstraintValidator {

  use EmbedCodeValueTrait;

  /**
   * {@inheritdoc}
   */
  public function validate($value, Constraint $constraint) {
    $value = $this->getEmbedCode($value);

    if (!isset($value)) {
      return;
    }

    $post_url = SmugMug::parseSmugMugEmbedField($value);

    if ($post_url === FALSE) {
      $this->context->addViolation($constraint->message);
    }
  }

}
