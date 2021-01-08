<?php
/**
 * This class represents Payever OauthToken List
 *
 * PHP version 5.4
 *
 * @category  Authorization
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */

namespace Payever\ExternalIntegration\Core\Authorization;

use Payever\ExternalIntegration\Core\Base\NamedList;
use Payever\ExternalIntegration\Core\Base\OauthTokenInterface;

/**
 * This class represents Payever OauthToken List
 *
 * PHP version 5.4
 *
 * @category  Authorization
 * @package   Payever\Core
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */
abstract class OauthTokenList extends NamedList
{
    /**
     * Loads Tokens into List from external source
     *
     * @return self
     */
    abstract public function load();

    /**
     * Saves Tokens from List to external source
     *
     * @return self
     */
    abstract public function save();

    /**
     * Returns empty OauthToken instance
     *
     * @return OauthTokenInterface
     *
     * @throws \Exception
     */
    public function create()
    {
        return new OauthToken();
    }
}
