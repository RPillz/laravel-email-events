<?php

namespace STS\EmailEvents\Auth;

use Illuminate\Http\Request;

/**
 *
 */
class BasicHttpAuth
{
    /**
     * @var
     */
    protected $username;
    /**
     * @var
     */
    protected $password;

    /**
     * BasicHttpAuth constructor.
     *
     * @param $username
     * @param $password
     */
    public function __construct( $username, $password )
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function __invoke( Request $request )
    {
        return $request->getUser() == $this->username && $request->getPassword() == $this->password;
    }
}