<?php
/**
 * Interface represents Payever Payments Configuration
 *
 * PHP version 5.4
 *
 * @category  Base
 * @package   Payever\Payments
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Base;

/**
 * Interface represents Payever Payments Configuration
 *
 * PHP version 5.4
 *
 * @category  Base
 * @package   Payever\Payments
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
interface IConfiguration
{
    /**
     * Loads configuration
     *
     * @return void
     */
    public function load();

    /**
     * Returns Client ID
     *
     * @return string
     */
    public function getClientId();

    /**
     * Returns Client Secret
     *
     * @return string
     */
    public function getClientSecret();

    /**
     * Returns Slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Returns Channel Set
     *
     * @return string
     */
    public function getChannelSet();

    /**
     * Returns Debug Mode status
     *
     * @return bool
     */
    public function getDebugMode();

    /**
     * Returns Api Mode
     *
     * @return string
     */
    public function getApiMode();

    /**
     * Returns Sandbox URL
     *
     * @return string
     */
    public function getSandboxUrl();

    /**
     * Returns Configuration Hash
     *
     * @return string
     */
    public function getHash();
}
