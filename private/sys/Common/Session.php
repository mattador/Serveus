<?php

namespace Sys\Common;

/**
 * Offers very basic session abstraction
 *
 * @author Matthew Cooper <mattador82@gmail.com>
 */
class Session {

    public static function getSession($cookie = 'SERVEUS_SESS_ID') {
        if (!isset($_SESSION)) {
            session_name($cookie);
            session_start();
        }
        $sessionStorage = __CLASS__;
        return new $sessionStorage();
    }

    public function setVar($ns, $key, $value) {
        $_SESSION[$ns][$key] = $value;
    }

    public function getVar($ns, $key) {
        if (!isset($_SESSION[$ns][$key])) {
            return false;
        }
        return $_SESSION[$ns][$key];
    }

    public function clear($ns, $key = null) {
        if (!$key) {
            unset($_SESSION[$ns]);
        } else {
            unset($_SESSION[$ns][$key]);
        }
    }

}