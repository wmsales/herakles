<?php

namespace App\Controllers;

use Core\Controller;

class ConfigController extends Controller
{
    public function index()
    {
        $this->view('setup/config', ['title' => 'Configura tu Aquilles']);
    }

    public function apply_config()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $env = $_POST['env'];
            $db_name = $_POST['db_name'];
            $db_user = $_POST['db_user'];
            $db_password = $_POST['db_password'] ? $_POST['db_password'] : '';

            if (empty($db_name) || empty($db_user)) {
                return $this->view('setup/config', ['title' => 'Configura tu Aquilles', 'error' => 'Por favor, completa todos los campos.']);
            }

            $this->createEnvFile($env, $db_name, $db_user, $db_password);

            $this->view('setup/config', ['title' => 'Configura tu Aquilles', 'success' => '<i class="bi bi-check-circle-fill"></i> Instalación de Aquilles correcta']);
        }
    }

    private function createEnvFile($env, $db_name, $db_user, $db_password)
    {
        $env_file = __DIR__ . '/../../../.env'; 

        if (!file_exists($env_file)) {
            file_put_contents($env_file, "APP_NAME=Aquilles\nAPP_VERSION=1.1.0\nAPP_DEV=true\nAPP_LANG=es\nAPP_DB_MOTOR=MySQL\n");
        }

        $env_content = file_get_contents($env_file);

        if ($env === 'dev') {
            $env_content = preg_replace('/^DB_NAME_DEV=.*/m', "DB_NAME_DEV=$db_name", $env_content);
            $env_content = preg_replace('/^DB_USER_DEV=.*/m', "DB_USER_DEV=$db_user", $env_content);
            $env_content = preg_replace('/^DB_PASS_DEV=.*/m', "DB_PASS_DEV=$db_password", $env_content);
        } else {
            $env_content = preg_replace('/^DB_NAME_PROD=.*/m', "DB_NAME_PROD=$db_name", $env_content);
            $env_content = preg_replace('/^DB_USER_PROD=.*/m', "DB_USER_PROD=$db_user", $env_content);
            $env_content = preg_replace('/^DB_PASS_PROD=.*/m', "DB_PASS_PROD=$db_password", $env_content);
        }

        file_put_contents($env_file, $env_content);
    }
}
