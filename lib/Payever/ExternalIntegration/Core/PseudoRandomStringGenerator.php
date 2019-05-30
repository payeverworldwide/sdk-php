<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Core;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
class PseudoRandomStringGenerator
{
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
     */
    public function generate($length = 64)
    {
        $binaryString = false;

        if (function_exists('random_bytes')) {
            $binaryString = random_bytes($length);
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
            throw new \RuntimeException("Unable to generate random string.");
        }

        return $this->binToHex($binaryString, $length);
    }

    /**
     * @param $binaryData
     * @param $length
     *
     * @return bool|string
     */
    protected function binToHex($binaryData, $length)
    {
        return substr(bin2hex($binaryData), 0, $length);
    }
}
