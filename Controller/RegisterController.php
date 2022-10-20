<?php

namespace App\Controller;

use App\Model\RegisterModel;

class LoginController extends Controller
{
    public static function index()
    {
        parent::render('Login/FormLogin');
    }

    public static function auth()
    {
        $model = new RegisterModel();

        $e = $model->email = $_POST['email'];
        $s = $model->senha = $_POST['senha'];
        if (empty($s) || empty($e)):
            header("Location: /register");

        $usuario_logado = $model->autenticar();

        if ($usuario_logado !== null) {

            $_SESSION['usuario_logado'] = $usuario_logado;

            header("Location: /");

        } else
            header("Location: /login?erro=true");
    }

    public static function logout()
    {
        unset($_SESSION['usuario_logado']);

        parent::isAuthenticated();
    }
}
