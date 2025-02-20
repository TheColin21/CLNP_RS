<?php
/**
 * This file is part of the CLNPRS App
 * and licensed under the AGPL.
 */

namespace OCA\CLNPRS\Settings;

use OCA\CLNPRS\Services\SettingsService;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IURLGenerator;
use OCP\Settings\ISettings;

/**
 * Class AdminSettings
 *
 * @package OCA\CLNPRS\Settings
 */
class AdminSettings implements ISettings {

    /**
     * @var IURLGenerator
     */
    protected $urlGenerator;

    /**
     * @var SettingsService
     */
    protected $settings;

    /**
     * AdminSection constructor.
     *
     * @param IURLGenerator   $urlGenerator
     * @param SettingsService $settings
     */
    public function __construct(IURLGenerator $urlGenerator, SettingsService $settings) {
        $this->urlGenerator = $urlGenerator;
        $this->settings     = $settings;
    }

    /**
     * @return TemplateResponse returns the instance with all parameters set, ready to be rendered
     */
    public function getForm(): TemplateResponse {
        return new TemplateResponse('clnprs', 'settings/admin', [
            'saveSettingsUrl' => $this->urlGenerator->linkToRouteAbsolute('clnprs.admin_settings.set'),
            'styleLogin'      => $this->settings->getServerStyleLoginEnabled(),
            'styleHeader'     => $this->settings->getServerStyleHeaderEnabled(),
            'styleDashboard'  => $this->settings->getServerStyleDashboardEnabled(),
            'hasDashboard'    => $this->settings->getNextcloudVersion() > 19
        ]);
    }

    /**
     * @return string the section ID, e.g. 'sharing'
     */
    public function getSection(): string {
        return 'theming';
    }

    /**
     * @return int whether the form should be rather on the top or bottom of
     * the admin section. The forms are arranged in ascending order of the
     * priority values. It is required to return a value between 0 and 100.
     */
    public function getPriority(): int {
        return 75;
    }
}