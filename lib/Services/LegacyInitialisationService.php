<?php
/**
 * This file is part of the Unpslash App
 * and licensed under the AGPL.
 */

namespace OCA\CLNPRS\Services;

use OC\Security\CSP\ContentSecurityPolicy;
use OCP\Security\IContentSecurityPolicyManager;
use OCP\Util;

/**
 * Class LegacyInitialisationService
 *
 * @package OCA\CLNPRS\Services
 */
class LegacyInitialisationService {

    /**
     * @var SettingsService
     */
    protected $settingsService;

    /**
     * @var IContentSecurityPolicyManager
     */
    protected $contentSecurityPolicyManager;

    /**
     * LegacyInitialisationService constructor.
     *
     * @param SettingsService               $settingsService
     * @param IContentSecurityPolicyManager $contentSecurityPolicyManager
     */
    public function __construct(SettingsService $settingsService, IContentSecurityPolicyManager $contentSecurityPolicyManager) {
        $this->settingsService = $settingsService;
        $this->contentSecurityPolicyManager = $contentSecurityPolicyManager;
    }

    /**
     *
     */
    public function initialize() {
        $this->registerStyleSheets();
        $this->registerCsp();
    }

    /**
     * Add the stylesheets
     */
    protected function registerStyleSheets() {
        if($this->settingsService->getUserStyleHeaderEnabled()) {
            Util::addStyle('clnprs', 'header');
        }
        if($this->settingsService->getServerStyleLoginEnabled()) {
            Util::addStyle('clnprs', 'login');
        }
    }

    /**
     * Allow clnprs hosts in the csp
     */
    protected function registerCsp() {
        if($this->settingsService->getUserStyleHeaderEnabled() || $this->settingsService->getServerStyleLoginEnabled()) {
            $policy  = new ContentSecurityPolicy();
            $policy->addAllowedImageDomain('https://rs.clnp.cloud');
            $this->contentSecurityPolicyManager->addDefaultPolicy($policy);
        }
    }
}