<?php

namespace Payever\ExternalIntegration\Tests;

use Assert\Assertion;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentRequest;

/**
 * Defines application features from the specific context.
 */
class RequestsContext extends BaseContext
{
    protected $paymentId;

    protected $url;

    /**
     * @When /^I create (not\s)?valid obtain token request with "(?P<scope>(?:[^"]|\\")*)" scope$/
     * @param $scope
     * @param bool $not
     * @throws \Exception
     */
    public function iCreateObtainTokenRequestWithScope($scope, $not = false)
    {
        try {
            $this->response = $this->getApiClient()->obtainTokenRequest($scope);

            if ($not) {
                throw new \UnexpectedValueException("OauthToken request finished successfully, but it must not");
            }
        } catch (\UnexpectedValueException $e) {
            throw $e;
        } catch (\Exception $e) {
            if (!$not) {
                throw $e;
            }
        }
    }

    /**
     * @When /^I create (not\s)?valid refresh token request with "(?P<scope>(?:[^"]|\\")*)" scope$/
     * @param $scope
     * @param bool $not
     * @throws \Exception
     */
    public function iCreateRefreshTokenRequestWithScope($scope, $not = false)
    {
        try {
            $token = $this->getApiClient()->getToken($scope);

            $this->response = $this->getApiClient()->refreshTokenRequest($token);
        } catch (\Exception $e) {
            if (!$not) {
                throw $e;
            }
        }
    }

    /**
     * @When /^I create (not\s)?valid get currencies token request for "([^"]*)" country$/
     * @param bool $not
     * @param $country
     * @throws \Exception
     */
    public function iCreateGetCurrenciesTokenRequestWithScope($country, $not = false)
    {
        try {
            $this->response = $this->getApiClient()->getCurrenciesRequest($country);
        } catch (\Exception $e) {
            if (!$not) {
                throw $e;
            }
        }
    }

    /**
     * @When /^I create (not )?valid list channel sets request$/
     * @param bool $not
     * @throws \Exception
     */
    public function iCreateListChannelSetsRequest($not = false)
    {
        try {
            $this->response = $this->getApiClient()->listChannelSetsRequest('payever');
        } catch (\Exception $e) {
            if (!$not) {
                throw $e;
            }
        }
    }

    /**
     * @When /^I create (not )?valid create payment request with the following:$/
     * | property | value |
     * @param bool $not
     * @throws \Exception
     */
    public function iCreateCreatePaymentRequest(TableNode $table, $not = false)
    {
        $data = [];

        foreach ($table->getTable() as $column) {
            $data[$column[0]] = $column[1];
        }

        try {
            $entity = new CreatePaymentRequest($data);
            $this->response = $this->getApiClient()->createPaymentRequest($entity);
        } catch (\Exception $e) {
            if (!$not) {
                throw $e;
            }
        }
    }

    /**
     * @Then /^I create (not )?valid retrieve payment request$/
     * @param bool $not
     * @throws \Exception
     * @throws \Assert\AssertionFailedException
     */
    public function iCreateValidRetrievePaymentRequest($not = false)
    {
        Assertion::notNull($this->paymentId);

        try {
            $this->response = $this->getApiClient()->retrievePaymentRequest($this->paymentId);
        } catch (\Exception $e) {
            if (!$not) {
                throw $e;
            }
        }
    }

    /**
     * @Given /^I create (not )?valid cancel payment request$/
     * @param bool $not
     * @throws \Exception
     * @throws \Assert\AssertionFailedException
     */
    public function iCreateValidCancelPaymentRequest($not = false)
    {
        Assertion::notNull($this->paymentId);

        try {
            $this->response = $this->getApiClient()->cancelPaymentRequest($this->paymentId);
        } catch (\Exception $e) {
            if (!$not) {
                throw $e;
            }
        }
    }

    /**
     * @Then /^The response should (not\s)?be successful$/
     *
     * @param bool $not
     * @throws \Assert\AssertionFailedException
     */
    public function theResponseShouldBeSuccessful($not = false)
    {
        if ($not) {
            Assertion::null($this->response);
        } else {
            Assertion::isInstanceOf($this->response, 'Payever\ExternalIntegration\Core\Http\Response');
            Assertion::eq($this->response->isSuccessful(), !$not);
        }
    }

    /**
     * @Given /^Response must contain response entity with the following:$/
     * | property |
     * @throws \Assert\AssertionFailedException
     */
    public function responseMustContainResponseWithTheFollowing(TableNode $table)
    {
        Assertion::isInstanceOf($this->response->getResponseEntity(), 'Payever\ExternalIntegration\Core\Http\ResponseEntity');

        $responseEntity = $this->response->getResponseEntity();

        $this->checkPropertyGetters($responseEntity, $table);
    }

    /**
     * @Then /^I expect payment redirect url to be "(success_url|failure_url|pending_url|none)"$/
     * @param $type
     */
    public function expectRedirectUrlToBe($type)
    {
        $this->getStubClient()->expectRedirect($type);
    }

    /**
     * @Then /^I expect payment status to be "([^"]+)"$/
     * @param $type
     */
    public function expectStatusToBe($type)
    {
        $this->getStubClient()->expectStatus($type);
    }

    /**
     * @Given /^I expect payment action "([^"]+)" to be (allowed|disallowed)$/
     *
     * @param $action
     * @param $value
     */
    public function expectPaymentActionToBe($action, $value)
    {
        $this->getStubClient()->expectAction($action, $value == 'allowed');
    }

    /**
     * @Then /^I save payment ID$/
     * @throws \Assert\AssertionFailedException
     */
    public function iSavePaymentID()
    {
        $this->paymentId = $this->response->getResponseEntity()->getCall()->getId();

        Assertion::notNull($this->paymentId);
    }

    /**
     * @Given /^I save Redirect URL$/
     */
    public function iSaveRedirectURL()
    {
        $this->url = $this->response->getResponseEntity()->getRedirectUrl();

        Assertion::notNull($this->url);
    }

    /**
     * @Then /^I go to saved URL$/
     */
    public function iGoToSavedURL()
    {
        $client = new Client();

        try {
            $client->get($this->url);
        } catch (\Exception $e) {
        }
    }
}
