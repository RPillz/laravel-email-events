<?php

namespace STS\EmailEvents\Auth;

use Illuminate\Http\Request;

/**
 *
 */
class SignatureAuth
{
    /** @var string */
    protected $signingKey;

    /**
     * SignatureAuth constructor.
     *
     * @param $signatureKey
     */
    public function __construct( $signatureKey )
    {
        $this->signatureKey = $signatureKey;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function __invoke( Request $request )
    {
        if (abs(time() - $request->input('signature.timestamp')) > 15) {
            return false;
        }

        return $this->buildSignature($request) === $request->input('signature.signature');
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    protected function buildSignature( Request $request )
    {
        return hash_hmac(
            'sha256',
            $request->input('signature.timestamp') . $request->input('signature.token'),
            $this->signatureKey
        );
    }
}