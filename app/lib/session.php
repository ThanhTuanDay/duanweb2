<?php

/**
 *Session Class
 **/
class Session
{
    public static function init()
    {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function checkSession()
    {
        self::init();
        if (self::get("adminlogin") == false) {
            self::destroy();
            header("Location:login.php");
        }
    }

    public static function checkLogin()
    {
        self::init();
        return self::get("adminlogin") == true;
    }

    public static function destroy($isLogout=false)
    {
        if ($isLogout) {
            $redirectPage ="homepage" ;
            $alert = "bạn đã đăng xuất";
        } else {
            $redirectPage = "login";
            $alert =  "bạn đã hết phiên làm việc";
        }

        session_start();
        $_SESSION = [];
        session_destroy();
    
        echo "<script>
                alert('$alert')
                window.location.href = '$redirectPage';
              </script>";
        exit();
    }
}
