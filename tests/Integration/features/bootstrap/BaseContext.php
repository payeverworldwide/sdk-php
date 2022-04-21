<?php

namespace Payever\ExternalIntegration\Tests;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Payever\ExternalIntegration\Core\Authorization\OauthToken;
use Payever\ExternalIntegration\Core\ClientConfiguration;
use Payever\ExternalIntegration\Core\Helper\StringHelper;
use Payever\ExternalIntegration\Core\Http\Response;
use Payever\Stub\Client;

/**
 * Defines application features from the specific context.
 */
class BaseContext implements Context
{
    /**
     * @var Response $response
     */
    protected $response;

    /**
     * @var OauthToken $token
     */
    protected $token;

    /** @var PaymentsApiClient */
    protected static $apiClient;

    /** @var string */
    protected static $stubStartCmd = "/bin/bash vendor/bin/stub-server %s:%s";

    /** @var string */
    protected static $stubServerPid;

    /** @var string */
    protected static $stubWorkerPid;

    /** @var Client */
    protected static $stubClient;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @BeforeSuite
     */
    public static function beforeSuite(BeforeSuiteScope $scope)
    {
        $suite = $scope->getSuite();

        $stubUrl = $suite->getSetting('stub_url');
        $stubHostParams = parse_url($stubUrl);

        $clientConfig = new ClientConfiguration();
        $clientConfig
            ->setApiMode(ClientConfiguration::API_MODE_SANDBOX)
            ->setBusinessUuid('stub')
            ->setClientId('stub_client_id')
            ->setClientSecret('stub_client_secret')
            ->setCustomSandboxUrl("http://{$stubHostParams['host']}:{$stubHostParams['port']}")
        ;

        static::$apiClient = new PaymentsApiClient($clientConfig);

        // setup stub server
        static::$stubServerPid = exec(sprintf(static::$stubStartCmd, $stubHostParams['host'], $stubHostParams[ 'port']));

        // create separate server process for further needs
        $workerPort = intval($stubHostParams['port']) + 1;
        static::$stubWorkerPid = exec(sprintf(static::$stubStartCmd, $stubHostParams['host'], $workerPort));

        // give the stub server time to boot up
        sleep(1);

        // setup stub client
        static::$stubClient = new Client($workerPort, $stubHostParams['host']);
    }

    /**
     * @AfterSuite
     */
    public static function afterSuite()
    {
        // shutdown stub server
        if (static::$stubServerPid) {
            exec("kill " . static::$stubServerPid);
        }
        // shutdown worker server
        if (static::$stubWorkerPid) {
            exec("kill " . static::$stubWorkerPid);
        }
    }

    public function getApiClient()
    {
        return static::$apiClient;
    }

    /**
     * @Given /^Payments API is available$/
     * @throws \Assert\AssertionFailedException
     */
    public function paymentsAPIIsAvailable()
    {
        Assertion::isInstanceOf($this->getApiClient(), PaymentsApiClient::class);
    }

    /**
     * @Given Payments Configuration is loaded
     * @Exception \Assert\AssertionFailedException
     * @throws \Assert\AssertionFailedException
     */
    public function paymentsConfigurationIsLoaded()
    {
        Assertion::true($this->getApiClient()->getConfiguration()->isLoaded());
    }

    /**
     * @Given /^My "(?P<scope>(?:[^"]|\\")*)" scope is (not\s)?valid$/
     * @param $scope
     * @param bool $not
     * @throws \Assert\AssertionFailedException
     */
    public function myScopeIsValid($scope, $not = false)
    {
        Assertion::eq(in_array($scope, OauthToken::getScopes()), !$not);
    }

    /**
     * @Given /^I check the following scopes:$/
     * | scope | valid |
     * @param TableNode $table
     * @throws \Assert\AssertionFailedException
     */
    public function iCheckTheFollowingScopes(TableNode $table)
    {
        foreach ($table as $node) {
            $this->myScopeIsValid($node['scope'], !($node['valid'] === 'true'));
        }
    }

    /**
     * @Given /^I get token with "(?P<scope>(?:[^"]|\\")*)" scope$/
     * @throws \Exception
     */
    public function iGetTokenWithScope($scope)
    {
        $this->token = $this->getApiClient()->getToken($scope);
    }

    /**
     * @Then /^The token must have the following:$/
     * @param TableNode $table
     * @throws \Assert\AssertionFailedException
     */
    public function theTokenMustHaveTheFollowing(TableNode $table)
    {
        $this->checkPropertyGetters($this->token, $table);
    }

    /**
     * @param $object
     * @param TableNode $table
     * @throws \Assert\AssertionFailedException
     */
    protected function checkPropertyGetters($object, TableNode $table)
    {
        foreach ($table as $node) {
            $propertyGetter = StringHelper::camelize('get_' . $node['property']);

            Assertion::notEmpty($object->{$propertyGetter}());
        }
    }

    /**
     * @Given /^The "([^"]*)" property of "([^"]*)" must be equal to "([^"]*)"$/
     * @param $property
     * @param $object
     * @param $value
     * @throws \Assert\AssertionFailedException
     */
    public function thePropertyOfMustBeEqualTo($property, $object, $value)
    {
        $propertyGetter = StringHelper::camelize('get_' . $property);

        Assertion::isObject($this->{$object});
        Assertion::methodExists($propertyGetter, $this->{$object});
        Assertion::eq($this->{$object}->{$propertyGetter}(), $value);
    }

    /**
     * @Given /^The "([^"]*)" property of "([^"]*)" must be greater than (\d+)$/
     */
    public function thePropertyOfMustBeGreaterThan($property, $object, $value)
    {
        $propertyGetter = StringHelper::camelize('get_' . $property);

        Assertion::isObject($this->{$object});
        Assertion::methodExists($propertyGetter, $this->{$object});
        Assertion::greaterThan($this->{$object}->{$propertyGetter}(), $value);
    }

    /**
     * @When /^I update token with "([^"]*)" scope and set "([^"]*)" property to (\d+)$/
     * @param $scope
     * @param $property
     * @param $value
     * @throws \Assert\AssertionFailedException
     */
    public function iUpdateTokenWithScopeAndSetPropertyTo($scope, $property, $value)
    {
        $propertySetter = StringHelper::camelize('set_' . $property);

        $token = $this->getApiClient()->getToken($scope);

        Assertion::isInstanceOf($token, OauthToken::class);
        Assertion::methodExists($propertySetter, $token);

        $token->{$propertySetter}($value);
    }

    /**
     * @Then /^Token with "([^"]*)" scope should (not\s)?be expired$/
     * @param $scope
     * @param $not
     * @throws \Assert\AssertionFailedException
     */
    public function tokenWithScopeShouldBeExpired($scope, $not = false)
    {
        $key = md5($this->getApiClient()->getConfiguration()->getHash() . $scope);

        Assertion::eq($this->getApiClient()->getTokens()->get($key)->isExpired(), !$not);
    }

    /**
     * @When /^I update token with "([^"]*)" scope and set "([^"]*)" property with date "([^"]*)"$/
     * @param $scope
     * @param $property
     * @param $value
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function iUpdateTokenWithScopeAndSetPropertyWithDate($scope, $property, $value)
    {
        $propertySetter = StringHelper::camelize('set_' . $property);

        $token = $this->getApiClient()->getToken($scope);

        Assertion::isInstanceOf($token, OauthToken::class);
        Assertion::methodExists($propertySetter, $token);

        $token->{$propertySetter}(strtotime($value));
    }

    /**
     * @return Client
     */
    public function getStubClient()
    {
        return static::$stubClient;
    }
}
