<?php

namespace Login;

class Controller_Login extends \Controller_ModuleBase {

    const ALREADY_LOGGED_IN = "1000";
    const SUCCESS = "1001";
    const FAILED = "1002";

    public function action_xhrlogoutaction() {
        // remove the remember-me cookie, we logged-out on purpose
        \Auth::dont_remember_me();
        // logout
        \Auth::logout();
        return $this->jsonSuccess('logout Success');
    }

    public function action_oauth($provider = null) {
        // bail out if we don't have an OAuth provider to call       
        if ($provider === null) {
            \Response::redirect_back();
        }
        //logger(400, $_SERVER['HTTP_HOST']);
        // load Opauth, it will load the provider strategy and redirect to the provider
        $opauth = \Auth\Auth_Opauth::forge(array(
                    'provider' => $provider,
                    'callback_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/login/callback',
                    'display' => 'popup'
        ));
    }

    public function action_callback() {
        // Opauth can throw all kinds of nasty bits, so be prepared
        try {
            // get the Opauth object
            $opauth = \Auth\Auth_CustomOpauth::forge(array(), false);

            // and process the callback
            try {
                $status = $opauth->login_or_register();
                //logger(400, print_r($opauth, 1), __METHOD__);
            } catch (\SimpleUserUpdateException $exc) {
                // user is in database already. 
                // ask for pwd to login                 
                $url = \Fuel\Core\Uri::create(\Fuel\Core\Uri::current(),
                                array(), $_GET);
                $modData = array(
                    "email" => $opauth->get('auth.info.email', ''),
                    "url" => $url
                );
                return \View::forge('linkacc.mustache', $modData);
            }
            // fetch the provider name from the opauth response so we can display a message
            $provider = $opauth->get('auth.provider', '?');
            //logger(\Fuel\Core\Fuel::L_ERROR, print_r($opauth, 1), __METHOD__);
            // deal with the result of the callback process
            switch ($status) {
                // a local user was logged-in, the provider has been linked to this user
                case 'linked':
                    logger(\Fuel\Core\Fuel::L_DEBUG, 'LINKED', __METHOD__);
                    \Auth\Auth::update_user(
                            array(
                                'profilepic' => $opauth->get('auth.info.image',
                                        ''),
                                'bdate' => $opauth->get('auth.raw.birthday', ''),
                            )
                    );
                    \Auth::remember_me();
                    break;

                // the provider was known and linked, the linked account as logged-in
                case 'logged_in':
                    logger(\Fuel\Core\Fuel::L_DEBUG, 'LOGGEDIN', __METHOD__);
                    \Auth\Auth::update_user(
                            array(
                                'uid' => $opauth->get('auth.uid', ''),
                            )
                    );
                    \Auth::remember_me();
                    break;

                // we don't know this provider login, ask the user to create a local account first
                case 'register':
                    // inform the user the login using the provider was succesful, but we need a local account to continue
                    logger(400, print_r($opauth, 1), __METHOD__);
                    logger(\Fuel\Core\Fuel::L_ERROR,
                            'The user should never come here as auto registration is activated',
                            __METHOD__);
                    break;

                // we didn't know this provider login, but enough info was returned to auto-register the user
                case 'registered':
                    \Auth\Auth::update_user(
                            array(
                                'nickname' => $opauth->get('auth.info.first_name',
                                        $opauth->get('auth.info.name', '')),
                                'profilepic' => $opauth->get('auth.info.image',
                                        ''),
                                'bdate' => $opauth->get('auth.raw.birthday', ''),
                                'uid' => $opauth->get('auth.uid', ''),
                            )
                    );
                    self::addUserInSystem();
                    \Auth::remember_me();
                    break;

                default:
                    throw new \FuelException('Auth_Opauth::login_or_register() has come up with a result that we dont know how to handle.');
            }

            // redirect to the url set
            return "<script>window.opener.location.href = window.opener.location.href; window.close();</script>";
        }

        // deal with Opauth exceptions
        catch (\OpauthException $e) {
            logger(\Fuel\Core\Fuel::L_ERROR, $e->getMessage(), __METHOD__);
            return "<script>window.close();</script>";
        }

        // catch a user cancelling the authentication attempt (some providers allow that)
        catch (\OpauthCancelException $e) {
            // you should probably do something a bit more clean here...
            return "<script>window.close();</script>";
        }
    }

    public static function addUserInSystem() {
        // Add user to global league
        $leagueid = \Fuel\Core\Config::get('global_league', 1);
        \Model_UserDataModel::addUserToLeague($leagueid);
        \Model_UserDataModel::initializeUserScores();
    }

}
