<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Core
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core;

/**
 * @SuppressWarnings(PHPMD.MissingImport)
 */
class PseudoRandomStringGenerator
{
    /** @var string */
    protected static $fallbackKeyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Generates a random string, using a cryptographically secure pseudo-random number generator.
     * Falling back to non-CSPRNG generation when no source of random available.
     *
     * @param int $length
     *
     * @return string
     *
     * @throws \Exception when CSPRNG source failed to provide random bytes
     * @SuppressWarnings(PHPMD.IfStatementAssignment)
     * @SuppressWarnings(PHPMD.ElseExpression)
     */
    public function generate($length = 64)
    {
        if (function_exists('random_bytes')) {
            $binaryString = random_bytes($length);
        // @codeCoverageIgnoreStart
        } elseif (function_exists('mcrypt_create_iv')) {
            $binaryString = /** @scrutinizer ignore-deprecated */ mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $binaryString = openssl_random_pseudo_bytes($length);
        } elseif (($stream = fopen('/dev/urandom', 'rb'))) {
            stream_set_read_buffer($stream, 0);
            $binaryString = fread($stream, $length);
            fclose($stream);
        } else {
            // well, we've tried
            $chain = '';
            $max = mb_strlen(static::$fallbackKeyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $chain .= static::$fallbackKeyspace[rand(0, $max)];
            }
            $binaryString = hex2bin($chain);
        }

        if ($binaryString === false) {
            throw new \RuntimeException('Unable to generate random string.');
        }
        // @codeCoverageIgnoreEnd

        return $this->binToHex($binaryString, $length);
    }

    /**
     * @param string $binaryData
     * @param int $length
     *
     * @return bool|string
     */
    protected function binToHex($binaryData, $length)
    {
        return substr(bin2hex($binaryData), 0, $length);
    }
}
