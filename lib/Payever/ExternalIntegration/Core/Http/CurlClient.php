<?php
/**
 * This class represents Curl implementation of Client
 *
 * PHP version 5.4
 *
 * @category  Http
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */

namespace Payever\ExternalIntegration\Core\Http;

use Payever\ExternalIntegration\Core\Base\AbstractClient;
use Payever\ExternalIntegration\Core\Base\IRequest;

/**
 * This class represents Curl implementation of Client
 *
 * PHP version 5.4
 *
 * @category  Http
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */
class CurlClient extends AbstractClient
{
    /**
     * Returns Request params
     *
     * @param array $override
     *
     * @return array
     */
    protected function getRequestOptions($override)
    {
        $default = array(
            CURLOPT_HEADER         => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_HTTP_VERSION   => 1.1,
        );

        return $override + $default;
    }

    /**
     * {@inheritdoc}
     *
     * @param IRequest $request
     *
     * @throws \Exception
     */
    public function execute($request)
    {
        $ch = curl_init();

        $options = array(
            CURLOPT_URL          => $request->getUrl(),
            CURLOPT_HTTPHEADER   => $request->getHeaders(),
            CURLOPT_HTTP_VERSION => $request->getProtocolVersion(),
        );

        if ($request->getMethod() === Request::METHOD_POST) {
            $options[CURLOPT_POST]       = true;
            $options[CURLOPT_POSTFIELDS] = $request->toArray();
        } elseif ($request->getMethod() === Request::METHOD_GET && $request->toArray()) {
            $paramChar = strpos('?', $request->getUrl()) === false ? '?' : '&';
            $options[CURLOPT_URL] = $request->getUrl() . $paramChar . http_build_query($request->toArray());
        }

        curl_setopt_array($ch, $this->getRequestOptions($options));

        $result       = curl_exec($ch);
        $httpCode     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $errorMessage = curl_error($ch);
        $errorNumber  = curl_errno($ch);

        curl_close($ch);

        if ($errorNumber !== 0) {
            throw new \Exception($errorMessage, $errorNumber);
        }

        if ($httpCode >= 400) {
            throw new \Exception($result, $httpCode);
        }

        $response = new Response();

        $response
            ->setRequestEntity($request->getRequestEntity())
            ->setResponseEntity($request->getResponseEntity())
            ->load($result);

        return $response;
    }
}
