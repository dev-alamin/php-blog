<?php

/**
 * Session Class
 * Return @void
 */

class Session
{

    /**
     * Init the session
     *
     * @return void
     */
    public static function init()
    {
        session_start();
    }
    /**
     * Set the session
     *
     * @param $ky
     * @param $val
     * @return void
     */
    public static function set($key, $val)
    {
        $_SESSION[ $key ] = $val;
    }

    /**
     * Get the sesssion
     *
     * @param session $key
     * @return void
     */
    public static function get($key)
    {

        if (isset($_SESSION[ $key ])) {
            return $_SESSION[ $key ];
        } else {
            return false;
        }
    }
    
    /**
     * Check the sesssion if exists
     *
     * @return void
     */
    public static function checkSession()
    {
        self::init();

        if (self::get("login") == false) {
            self::destroy();
        }
    }

    /**
     * CheckLogin
     *
     * @return void
     */
    public static function CheckLogin()
    {
        self::init();

        if (self::get("login") == true) {
          header('Location:index.php');
        }
    }

    /**
     * Destroy the session when user logged out
     *
     * @return void
     */
    public static function destroy()
    {
        session_destroy();
        header('Location: login.php');
    }
}
