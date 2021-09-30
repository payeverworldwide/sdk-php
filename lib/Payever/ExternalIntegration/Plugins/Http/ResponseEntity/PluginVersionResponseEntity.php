<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  ResponseEntity
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Plugins\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * @method string getFilename()
 * @method string getVersion()
 * @method \DateTime getCreatedAt()
 * @method string getMinCmsVersion()
 * @method string getMaxCmsVersion()
 *
 * @SuppressWarnings(PHPMD.MissingImport)
 */
class PluginVersionResponseEntity extends ResponseEntity
{
    /** @var string */
    protected $filename;

    /** @var string */
    protected $version;

    /** @var \DateTime */
    protected $createdAt;

    /** @var string */
    protected $minCmsVersion;

    /** @var string */
    protected $maxCmsVersion;

    /**
     * @param string $createdAt
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime($createdAt);

        return $this;
    }
}
