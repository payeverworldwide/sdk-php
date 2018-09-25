<?php

namespace Base\Plugin\Payever\Core;

require_once '../../../src/Payever/ExternalIntegration/Core/TokenList.php';

use Payever\ExternalIntegration\Core\Base\IToken;
use Payever\ExternalIntegration\Core\Authorization\TokenList as CoreTokenList;

class TokenList extends CoreTokenList
{
    /**
     * {@inheritdoc}
     */
    public function load($clientId)
    {
        $tokensDb = DB::get('payever_core_tokens')->select(array('client_id' => $clientId))->all();

        foreach ($tokensDb as $tokenDb) {
            $params = array(
                'client_id'     => $tokenDb['client_id'],
                'access_token'  => $tokenDb['access_token'],
                'refresh_token' => $tokenDb['refresh_token'],
                'scope'         => $tokenDb['scope'],
                'created_at'    => $tokenDb['created_at'],
                'updated_at'    => $tokenDb['updated_at'],
            );

            $this->add(
                $tokenDb['scope'],
                $this->create()->load($params)
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        /** @var IToken $token */
        foreach ($this->getAll() as $token) {
            DB::truncate('payever_core_tokens');

            DB::insert('payever_core_tokens')->values($token->getParams())->execute();
        }
    }

    /**
     * Returns new Token
     *
     * @return IToken
     *
     * @throws \Exception
     */
    public function create()
    {
        return new Token();
    }
}
