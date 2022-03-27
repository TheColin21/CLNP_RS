<?php
/**
 * This file is part of the Unpslash App
 * and licensed under the AGPL.
 */

namespace OCA\CLNPRS\EventListener;

use OC\Security\CSP\ContentSecurityPolicy;
use OCA\CLNPRS\Services\SettingsService;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\Security\CSP\AddContentSecurityPolicyEvent;

class AddContentSecurityPolicyEventListener implements IEventListener {
    /**
     * @var SettingsService
     */
    protected $settingsService;

    /**
     * BeforeTemplateRenderedEventListener constructor.
     *
     * @param SettingsService $settingsService
     */
    public function __construct(SettingsService $settingsService) {
        $this->settingsService = $settingsService;
    }

    /**
     * @param Event $event
     */
    public function handle(Event $event): void {
        if(!($event instanceof AddContentSecurityPolicyEvent)) {
            return;
        }

        if($this->settingsService->getUserStyleHeaderEnabled() || $this->settingsService->getServerStyleLoginEnabled() || $this->settingsService->getUserStyleDashboardEnabled()) {
            $policy = new ContentSecurityPolicy();
            $policy->addAllowedImageDomain('https://rs.clnp.cloud');
            $event->addPolicy($policy);
        }
    }
}