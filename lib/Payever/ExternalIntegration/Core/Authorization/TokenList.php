<?php
/**
 * This class represents Payever Token List
 *
 * PHP version 5.4
 *
 * @category  Authorization
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */

namespace Payever\ExternalIntegration\Core\Authorization;

use Payever\ExternalIntegration\Core\Base\IToken;
use Payever\ExternalIntegration\Core\Base\NamedList;

/**
 * This class represents Payever Token List
 *
 * PHP version 5.4
 *
 * @category  Authorization
 * @package   Payever\Core
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */
abstract class TokenList extends NamedList
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
     * Returns new Token
     *
     * @return IToken
     */
    abstract public function create();
}
