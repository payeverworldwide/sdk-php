<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Plugins
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Plugins\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * PHP version 5.4 and 7
 *
 * @method string getFilename()
 * @method string getVersion()
 * @method \DateTime getCreatedAt()
 * @method string getMinCmsVersion()
 * @method string getMaxCmsVersion()
 *
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
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
