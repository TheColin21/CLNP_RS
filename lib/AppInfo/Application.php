<?php
/**
 * This file is part of the CLNPRS App
 * and licensed under the AGPL.
 */

namespace OCA\CLNPRS\AppInfo;

use OCA\CLNPRS\EventListener\AddContentSecurityPolicyEventListener;
use OCA\CLNPRS\EventListener\BeforeTemplateRenderedEventListener;
use OCP\AppFramework\App;
use OCP\AppFramework\Http\Events\BeforeTemplateRenderedEvent;
use OCP\EventDispatcher\IEventDispatcher;
use OCP\Security\CSP\AddContentSecurityPolicyEvent;

/**
 * Class Application
 *
 * @package OCA\CLNPRS\AppInfo
 */
class Application extends App {

    /**
     * Application constructor.
     *
     * @param array $urlParams
     */
    public function __construct(array $urlParams = []) {
        parent::__construct('clnprs', $urlParams);
        $this->registerSystemEvents();
    }

    /**
     *
     */
    protected function registerSystemEvents() {
        /* @var IEventDispatcher $eventDispatcher */
        $dispatcher = $this->getContainer()->get(IEventDispatcher::class);
        $dispatcher->addServiceListener(BeforeTemplateRenderedEvent::class, BeforeTemplateRenderedEventListener::class);
        $dispatcher->addServiceListener(AddContentSecurityPolicyEvent::class, AddContentSecurityPolicyEventListener::class);
    }
}