<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\ThirdParty\Action;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * Class ActionResult
 *
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 *
 * @method int getCreatedCount()
 * @method int getUpdatedCount()
 * @method int getDeletedCount()
 * @method int getSkippedCount()
 * @method string[] getErrors();
 */
class ActionResult extends MessageEntity
{
    protected $createdCount = 0;

    protected $updatedCount = 0;

    protected $deletedCount = 0;

    protected $skippedCount = 0;

    protected $errors = array();

    /**
     * @return static
     */
    public function incrementCreated()
    {
        $this->createdCount++;

        return $this;
    }

    /**
     * @return static
     */
    public function incrementUpdated()
    {
        $this->updatedCount++;

        return $this;
    }

    /**
     * @return static
     */
    public function incrementDeleted()
    {
        $this->deletedCount++;

        return $this;
    }

    /**
     * @return $this
     */
    public function incrementSkipped()
    {
        $this->skippedCount++;

        return $this;
    }

    /**
     * @return int
     */
    public function getErrorsCount()
    {
        return count($this->errors);
    }

    /**
     * @param $error
     *
     * @return static
     */
    public function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    /**
     * @param \Exception $exception
     *
     * @return static
     */
    public function addException(\Exception $exception)
    {
        $this->addError($exception->getMessage());

        return $this;
    }

    public function toString()
    {
        return sprintf(
            "%s: [created=%d] [updated=%d] [deleted=%d] [skipped=%d] [errors=%d]",
            'Result',
            $this->getCreatedCount(),
            $this->getUpdatedCount(),
            $this->getDeletedCount(),
            $this->getSkippedCount(),
            $this->getErrorsCount()
        );
    }
}
