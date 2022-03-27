<?php
/**
 * This file is part of the Unpslash App
 * and licensed under the AGPL.
 */

namespace OCA\CLNPRS\EventListener;

use OCA\CLNPRS\Services\SettingsService;
use OCP\AppFramework\Http\Events\BeforeTemplateRenderedEvent;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\IRequest;
use OCP\Util;

class BeforeTemplateRenderedEventListener implements IEventListener {
    /**
     * @var SettingsService
     */
    protected $settingsService;

    /**
     * @var IRequest
     */
    protected $request;

    /**
     * BeforeTemplateRenderedEventListener constructor.
     *
     * @param SettingsService $settingsService
     * @param IRequest        $request
     */
    public function __construct(SettingsService $settingsService, IRequest $request) {
        $this->settingsService = $settingsService;
        $this->request = $request;
    }

    /**
     * @param Event $event
     */
    public function handle(Event $event): void {
        if(!($event instanceof BeforeTemplateRenderedEvent)) {
            return;
        }

        if($event->isLoggedIn()) {
            if($this->settingsService->getUserStyleHeaderEnabled() && $this->request->getParam('_route') !== 'dashboard.dashboard.index') {
                Util::addStyle('clnprs', 'header');
            }

            if($this->settingsService->getUserStyleDashboardEnabled() && $this->request->getParam('_route') === 'dashboard.dashboard.index') {
                Util::addStyle('clnprs', 'dashboard');
            }
        }

        if(!$event->isLoggedIn() && $this->settingsService->getServerStyleLoginEnabled()) {
            Util::addStyle('clnprs', 'login');
        }
    }
}