<?php

namespace Drupal\Tests\demo_umami_content\Functional;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Tests\BrowserTestBase;

/**
 * Tests that uninstalling default content removes created content.
 *
 * @group purencool_content
 */
class PurencoolContentTest extends BrowserTestBase {

	/**
   * {@inheritdoc}
   */
  protected $profile = 'purencool';

}
