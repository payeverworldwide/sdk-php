<?php
/**
 * This class represents Curl implementation of Client
 *
 * PHP version 5.4
 *
 * @category  Http
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */

namespace Payever\ExternalIntegration\Core\Http\Client;

use Payever\ExternalIntegration\Core\Base\HttpClientInterface;
use Payever\ExternalIntegration\Core\Base\RequestInterface;
use Payever\ExternalIntegration\Core\Exception\PayeverCommunicationException;
use Payever\ExternalIntegration\Core\Http\Request;
use Payever\ExternalIntegration\Core\Http\Response;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

/**
 * This class represents Curl implementation of Client
 *
 * PHP version 5.4
 *
 * @category  Http
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */
class CurlClient implements HttpClientInterface, LoggerAwareInterface
{
    /**
     * CurlClient constructor.
     *
     * @throws \RuntimeException when cURL extension is not enabled
     */
    public function __construct()
    {
        if (!extension_loaded('curl')) {
            throw new \RuntimeException('cURL PHP extension must be enabled in order to use this HTTP client');
        }
    }

    /** @var LoggerInterface */
    protected $logger;

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     *
     * @param RequestInterface $request
     *
     * @throws \Exception
     */
    public function execute(RequestInterface $request)
    {
        try {
            return $this->executeRequest($request);
        } catch (\Exception $exception) {
            $this->logger->critical(
                sprintf(
                    'HTTP Request failed: %s %s',
                    $exception->getCode(),
                    $exception->getMessage()
                ),
                array('trace' => $exception->getTraceAsString())
            );

            throw $exception;
        }
    }

    /**
     * @param RequestInterface $request
     *
     * @return Response
     *
     * @throws \RuntimeException
     * @throws PayeverCommunicationException
     */
    protected function executeRequest(RequestInterface $request)
    {
        $this->logger->debug(
            sprintf('HTTP Request %s %s', $request->getMethod(), $request->getUrl()),
            array('headers' => $request->getHeaders(), 'body' => $request->toArray())
        );

        if (!$request->validate()) {
            throw new \RuntimeException('Request entity is not valid');
        }

        $ch = curl_init();

        if (!is_resource($ch)) {
            throw new \RuntimeException('Could not get cURL resource');
        }

        $options = array(
            CURLOPT_URL          => $request->getUrl(),
            CURLOPT_HTTPHEADER   => $request->getHeaders(),
            CURLOPT_HTTP_VERSION => $request->getProtocolVersion(),
        );

        $customMethods = array(
            Request::METHOD_PUT,
            Request::METHOD_PATCH,
            Request::METHOD_DELETE,
        );

        if ($request->getMethod() === Request::METHOD_POST) {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $request->toArray();
        } elseif ($request->getMethod() === Request::METHOD_GET && $request->toArray()) {
            $paramChar = strpos('?', $request->getUrl()) === false ? '?' : '&';
            $options[CURLOPT_URL] = $request->getUrl() . $paramChar . http_build_query($request->toArray());
        } elseif (in_array($request->getMethod(), $customMethods)) {
            $options[CURLOPT_CUSTOMREQUEST] = $request->getMethod();
            $options[CURLOPT_POSTFIELDS] = $request->toArray();
        }

        if (isset($options[CURLOPT_POSTFIELDS])
            && $request->getHeader('Content-Type') == 'application/x-www-form-urlencoded'
        ) {
            $options[CURLOPT_POSTFIELDS] = http_build_query($options[CURLOPT_POSTFIELDS]);
        } elseif (isset($options[CURLOPT_POSTFIELDS])
            && $request->getHeader('Content-Type') == 'application/json'
        ) {
            $options[CURLOPT_POSTFIELDS] = json_encode($options[CURLOPT_POSTFIELDS]);
        }

        curl_setopt_array($ch, $this->getRequestOptions($options));

        $result       = curl_exec($ch);
        $httpCode     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $errorMessage = curl_error($ch);
        $errorNumber  = curl_errno($ch);

        curl_close($ch);

        $this->logger->debug(
            sprintf('HTTP Response %s %s', $request->getMethod(), $request->getUrl()),
            array('httpCode' => $httpCode, 'body' => $result, 'curlError' => $errorMessage)
        );

        if ($errorNumber !== 0) {
            throw new PayeverCommunicationException($errorMessage, $errorNumber);
        }

        if ($httpCode >= 400) {
            $message = $result;
            $data = @json_decode($result, true);

            if (isset($data['error_description'])) {
                $message = $data['error_description'];
            } elseif (isset($data['message'])) {
                $message = $data['message'];
            }

            if (isset($data['error'])) {
                $message = sprintf('%s: %s', $data['error'], $message ?: 'Unknown');
            }

            throw new PayeverCommunicationException($message, $httpCode);
        }

        $response = new Response();

        $response
            ->setRequestEntity($request->getRequestEntity())
            ->setResponseEntity($request->getResponseEntity())
            ->load($result);

        if ($response->isFailed()) {
            throw new PayeverCommunicationException(
                $response->getResponseEntity()->getErrorDescription()
            );
        }

        return $response;
    }

    /**
     * Returns cURL request params array
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
}
