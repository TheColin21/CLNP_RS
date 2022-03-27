<?php
/**
 * This file is part of the CLNPRS App
 * and licensed under the AGPL.
 */

use OCA\CLNPRS\Settings\PersonalSettings;
use OCP\AppFramework\QueryException;

$app = new \OCA\CLNPRS\AppInfo\Application();
try {
    /** @var PersonalSettings $controller */
    $controller = $app->getContainer()->query(PersonalSettings::class);
    return $controller->getForm()->render();
} catch(QueryException $e) {
    return $e->getMessage();
}

