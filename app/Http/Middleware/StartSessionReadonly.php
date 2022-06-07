<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Session\SessionManager;

/**
 * Middleware for sharing session between `web` and `api` guards.
 * Since the latter is essentially stateless, the session from
 * `web` is shared as readonly.
 *
 * @package App\Http\Middleware
 */
class StartSessionReadonly extends StartSession
{
    protected $encrypter;

    public function __construct(Encrypter $encrypter, SessionManager $manager)
    {
        parent::__construct($manager);
        $this->encrypter = $encrypter;
    }

    public function handle($request, Closure $next)
    {
        // If a session driver has been configured, we will need to start the session here
        // so that the data is ready for an application. Note that the Laravel sessions
        // do not make use of PHP "native" sessions in any way since they are crappy.
        if ($this->sessionConfigured()) {
            $request->setLaravelSession($this->startSession($request));
        }

        return $next($request);
    }

    public function getSession(Request $request)
    {
        return tap($this->manager->driver(), function (Session $session) use ($request) {
            $payload = $request->cookies->get($session->getName());
            $unserialize = EncryptCookies::serialized($session->getName());
            try {
                $session->setId($this->encrypter->decrypt($payload, $unserialize));
            }
            catch (DecryptException $exception) {
            }
        });
    }
}