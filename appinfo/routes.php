<?php
/**
 * This file is part of the CLNPRS App
 * and licensed under the AGPL.
 */

return [
    'routes'    => [
        ['name' => 'admin_settings#set', 'url' => '/settings/admin/set', 'verb' => 'POST'],
        ['name' => 'personal_settings#set', 'url' => '/settings/personal/set', 'verb' => 'POST'],
    ]
];