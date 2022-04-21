<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Http
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Http\Client;

use Payever\ExternalIntegration\Core\Base\HttpClientInterface;
use Payever\ExternalIntegration\Core\Base\RequestInterface;
use Payever\ExternalIntegration\Core\Exception\PayeverCommunicationException;
use Payever\ExternalIntegration\Core\Http\Request;
use Payever\ExternalIntegration\Core\Http\Response;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * This class represents Curl implementation of Client
 * @SuppressWarnings(PHPMD.MissingImport)
 */
class CurlClient implements HttpClientInterface, LoggerAwareInterface
{
    /** @var LoggerInterface */
    protected $logger;

    /** @var string */
    protected $logLevel = LogLevel::CRITICAL;

    /** @var string|null */
    protected $tmpLogLevel;

    /**
     * @throws \RuntimeException when cURL extension is not enabled
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        if (!extension_loaded('curl')) {
            throw new \RuntimeException('cURL PHP extension must be enabled in order to use this HTTP client');
        }
    }

    /**
     * @inheritDoc
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $logLevel
     */
    public function setLogLevel($logLevel = LogLevel::CRITICAL)
    {
        $this->logLevel = $logLevel;
    }

    /**
     * @param string|null $logLevel
     */
    public function setLogLevelOnce($logLevel)
    {
        $this->tmpLogLevel = $logLevel;
    }

    /**
     * @param RequestInterface $request
     * @return Response
     * @throws \Exception
     */
    public function execute(RequestInterface $request)
    {
        try {
            return $this->executeRequest($request);
        } catch (\Exception $exception) {
            $logLevel = $this->logLevel;
            if (null !== $this->tmpLogLevel) {
                $logLevel = $this->tmpLogLevel;
                $this->tmpLogLevel = null;
            }
            $this->logger->log(
                $logLevel,
                sprintf(
                    'HTTP Request failed: %s %s',
                    $exception->getCode(),
                    $exception->getMessage()
                ),
                ['trace' => $exception->getTraceAsString()]
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
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    protected function executeRequest(RequestInterface $request)
    {
        $this->logger->debug(
            sprintf('HTTP Request %s %s', $request->getMethod(), $request->getUrl()),
            ['headers' => $request->getHeaders(), 'body' => $request->toArray()]
        );

        if (!$request->validate()) {
            throw new \RuntimeException('Request entity is not valid');
        }

        $ch = curl_init();

        if ($ch === false) {
            throw new \RuntimeException('Could not get cURL resource');
        }

        $options = [
            CURLOPT_URL          => $request->getUrl(),
            CURLOPT_HTTPHEADER   => $request->getHeaders(),
            CURLOPT_HTTP_VERSION => $request->getProtocolVersion(),
        ];

        $customMethods = [
            Request::METHOD_PUT,
            Request::METHOD_PATCH,
            Request::METHOD_DELETE,
        ];

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

        if (
            isset($options[CURLOPT_POSTFIELDS]) && is_array($options[CURLOPT_POSTFIELDS])
            && $request->getHeader('Content-Type') == 'application/x-www-form-urlencoded'
        ) {
            $options[CURLOPT_POSTFIELDS] = http_build_query($options[CURLOPT_POSTFIELDS]);
        } elseif (
            isset($options[CURLOPT_POSTFIELDS]) && is_array($options[CURLOPT_POSTFIELDS])
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
            ['httpCode' => $httpCode, 'body' => $result, 'curlError' => $errorMessage]
        );

        if ($errorNumber !== 0) {
            throw new PayeverCommunicationException($errorMessage, $errorNumber);
        }

        if ($httpCode >= 400) {
            $message = $result;
            $data = json_decode($result, true);

            if (isset($data['error_description'])) {
                $message = $data['error_description'];
            } elseif (isset($data['message'])) {
                $message = $data['message'];
            }

            if (isset($data['error'])) {
                $message = sprintf(
                    '%s: %s',
                    $data['error'],
                    $message
                        ? (is_array($message) ? json_encode($message) : $message)
                        : 'Unknown'
                );
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
     * @param $fileUrl
     * @param $savePath
     * @throws \Exception
     */
    public function download($fileUrl, $savePath)
    {
        try {
            $this->downloadRequest($fileUrl, $savePath);
        } catch (\Exception $exception) {
            $logLevel = $this->logLevel;
            if (null !== $this->tmpLogLevel) {
                $logLevel = $this->tmpLogLevel;
                $this->tmpLogLevel = null;
            }
            $this->logger->log(
                $logLevel,
                sprintf(
                    'HTTP Request failed: %s %s',
                    $exception->getCode(),
                    $exception->getMessage()
                ),
                ['trace' => $exception->getTraceAsString()]
            );

            throw $exception;
        }
    }

    /**
     * @param $fileUrl
     * @param $savePath
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    protected function downloadRequest($fileUrl, $savePath)
    {
        $this->logger->debug(
            sprintf('HTTP download Request %s %s', $fileUrl, $savePath)
        );

        $filePointer = fopen($savePath, 'w+');
        $ch = curl_init($fileUrl);

        if ($ch === false) {
            throw new \RuntimeException('Could not get cURL resource');
        }

        $options = $this->getRequestOptions();
        $options[CURLOPT_TIMEOUT] = 100;
        $options[CURLOPT_CONNECTTIMEOUT] = 300;
        $options[CURLOPT_FILE] = $filePointer;

        curl_setopt_array($ch, $options);

        curl_exec($ch);
        $httpCode     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $errorMessage = curl_error($ch);
        $errorNumber  = curl_errno($ch);

        curl_close($ch);
        fclose($filePointer);

        $this->logger->debug(
            sprintf('HTTP Download Response %s', $savePath),
            ['httpCode' => $httpCode, 'curlError' => $errorMessage]
        );

        if ($errorNumber !== 0) {
            throw new PayeverCommunicationException($errorMessage, $errorNumber);
        }

        if ($httpCode >= 400) {
            throw new PayeverCommunicationException('Could not download the file', $httpCode);
        }
    }

    /**
     * Returns cURL request params array
     *
     * @param array $override
     *
     * @return array
     */
    protected function getRequestOptions($override = [])
    {
        $default = [
            CURLOPT_HEADER         => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        ];

        return $override + $default;
    }
}
