<?php
/**
 * This file is part of the CLNPRS App
 * and licensed under the AGPL.
 */

namespace OCA\CLNPRS\Services;

use OCP\IConfig;

/**
 * Class SettingsService
 *
 * @package OCA\CLNPRS\Services
 */
class SettingsService {

    const STYLE_LOGIN          = 'clnprs/style/login';
    const STYLE_HEADER         = 'clnprs/style/header';
    const STYLE_DASHBORAD      = 'clnprs/style/dashborad';
    const USER_STYLE_HEADER    = 'clnprs/style/header';
    const USER_STYLE_DASHBORAD = 'clnprs/style/dashborad';

    /**
     * @var IConfig
     */
    protected $config;

    /**
     * @var string
     */
    protected $userId;

    /**
     * @var string
     */
    protected $appName;

    /**
     * FaviconService constructor.
     *
     * @param string|null $userId
     * @param             $appName
     * @param IConfig     $config
     */
    public function __construct($userId, $appName, IConfig $config) {
        $this->config = $config;
        $this->userId = $userId;
        if($this->config->getSystemValue('maintenance', false)) {
            $this->userId = null;
        }
        $this->appName = $appName;
    }

    /**
     * If the page header should be styled for this user
     *
     * @return bool
     */
    public function getUserStyleHeaderEnabled(): bool {
        $styleHeader = $this->config->getUserValue($this->userId, $this->appName, self::USER_STYLE_HEADER, null);

        if($styleHeader === null) return $this->getServerStyleHeaderEnabled();

        return $styleHeader == 1;
    }

    /**
     * Set if the page header should be styled for this user
     *
     * @param int $styleHeader
     *
     * @return void
     * @throws \OCP\PreConditionNotMetException
     */
    public function setUserStyleHeaderEnabled(int $styleHeader = 1) {
        $this->config->setUserValue($this->userId, $this->appName, self::USER_STYLE_HEADER, $styleHeader);
    }

    /**
     * If the dashboard should be styled for this user
     *
     * @return bool
     */
    public function getUserStyleDashboardEnabled(): bool {
        $styleHeader = $this->config->getUserValue($this->userId, $this->appName, self::USER_STYLE_DASHBORAD, null);

        if($styleHeader === null) return $this->getServerStyleDashboardEnabled();

        return $styleHeader == 1;
    }

    /**
     * Set if the dashboard should be styled for this user
     *
     * @param int $styleDashboard
     *
     * @return void
     * @throws \OCP\PreConditionNotMetException
     */
    public function setUserStyleDashboardEnabled(int $styleDashboard = 1) {
        $this->config->setUserValue($this->userId, $this->appName, self::USER_STYLE_DASHBORAD, $styleDashboard);
    }

    /**
     * If the page header should be styled by default
     *
     * @return bool
     */
    public function getServerStyleHeaderEnabled(): bool {
        return $this->config->getAppValue($this->appName, self::STYLE_HEADER, 1) == 1;
    }

    /**
     * Set if the page header should be styled by default
     *
     * @param int $styleHeader
     */
    public function setServerStyleHeaderEnabled(int $styleHeader = 1) {
        $this->config->setAppValue($this->appName, self::STYLE_HEADER, $styleHeader);
    }

    /**
     * If the page dashboard be styled by default
     *
     * @return bool
     */
    public function getServerStyleDashboardEnabled(): bool {
        return $this->config->getAppValue($this->appName, self::STYLE_DASHBORAD, 0) == 1;
    }

    /**
     * Set if the dashboard should be styled by default
     *
     * @param int $styleDashboard
     */
    public function setServerStyleDashboardEnabled(int $styleDashboard = 1) {
        $this->config->setAppValue($this->appName, self::STYLE_DASHBORAD, $styleDashboard);
    }

    /**
     * If the login page should be styled by default
     *
     * @return bool
     */
    public function getServerStyleLoginEnabled(): bool {
        return $this->config->getAppValue($this->appName, self::STYLE_LOGIN, 1) == 1;
    }

    /**
     * Set if the login page should be styled by default
     *
     * @param int $styleLogin
     */
    public function setServerStyleLoginEnabled(int $styleLogin = 1) {
        $this->config->setAppValue($this->appName, self::STYLE_LOGIN, $styleLogin);
    }

    /**
     * @return int
     */
    public function getNextcloudVersion(): int {
        $version = $this->config->getSystemValue('version', '0.0.0');
        $parts = explode('.', $version, 2);

        return intval($parts[0]);
    }
}