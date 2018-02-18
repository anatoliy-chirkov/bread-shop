<?php

class Auth
{
    public $id;
    public $name;
    public $password;
    public $password2;

    public function verify($name = null, $password = null)
    {   
        if ($_SESSION['auth'] === "true") {
            return true;
        } 
        elseif ($_COOKIE['hash']) {
            $user = new User;
            $user = $user->select();
            if ($_COOKIE['hash'] === $user['hash']) {
                return true;
            }
        } else {
            $user = new User;
            $user = $user->select();
            if ($name === $user['name']) {
                $verify = password_verify($password, $user['password']);
                if ($password === $user['password']) 
                    $verify = true;
                if ($verify) {
                    session_start();
                    $_SESSION['auth'] = true;
                    $hash = md5($this->generateHash(10));
                    $hash = substr($hash, 0, 30);
                    global $pdo;
                    $res = $pdo->prepare("UPDATE user SET hash = ? WHERE id = ?");
                    $res->execute(array($hash, $user['id']));
                    setcookie("hash", $hash, time()+60*60*24*30, "/");
                    return true;
                }
            }
        }
    }

    private function generateHash($length=6) 
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;  
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];  
        }
        return $code;
    }

    public function set($array)
    {   
        $this->id = (int)$array['id'];
        $this->name = (string)$array['name'];
        $this->password = (string)$array['password'];
        $this->password2 = (string)$array['password2'];
        return $this;
    }

    public function update()
    {
      global $pdo;
      if ($this->password === $this->password2) {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $res = $pdo->prepare("UPDATE user SET name = ?, password = ? WHERE id = ?");
        $res->execute(array($this->name, $this->password, $this->id));
        if ($res != null)
            return true;
      }
    }

    public function logout()
    {
        setcookie("hash", "", time()-3600*24*30*12, "/");
        session_start();
        unset($_SESSION['session_username']);
        unset($_SESSION['is_auth']);
        unset($_SESSION["session_user_id"]);
        session_destroy();
    }

}