<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  Action
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\ThirdParty\Action;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * @method int getCreatedCount()
 * @method int getUpdatedCount()
 * @method int getDeletedCount()
 * @method int getSkippedCount()
 * @method string[] getErrors();
 */
class ActionResult extends MessageEntity
{
    /** @var int */
    protected $createdCount = 0;

    /** @var int */
    protected $updatedCount = 0;

    /** @var int */
    protected $deletedCount = 0;

    /** @var int */
    protected $skippedCount = 0;

    /** @var array */
    protected $errors = [];

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

    /**
     * @inheritDoc
     */
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
