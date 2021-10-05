<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\Policy\RequestPolicyInterface;
use Cake\Http\ServerRequest;

class RequestPolicy implements RequestPolicyInterface
{
    /**
     * Method to check if the request can be accessed
     *
     * @param \Authorization\IdentityInterface|null $identity Identity
     * @param \Cake\Http\ServerRequest $request Server Request
     * @return bool
     */
    public function canAccess($identity, ServerRequest $request): bool
    {
        if (
            $request->getParam('prefix') === 'Api'
            && $request->getParam('controller') === 'Metar'
            && $request->getParam('action') === 'get'
        ) {
            $icao = $request->getParam('pass')[0] ?? null;
            if (
                !empty($icao)
                && strtolower($icao) === 'eddm'
                && $identity->role !== 'admin'
            ) {
                return false;
            }
        }

        return true;
    }
}
