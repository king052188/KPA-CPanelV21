<?php

namespace App\Http\Controllers;

use Composer\Composer;
use Composer\Console\Application;
use Illuminate\Http\Request;

use Phar;
use Symfony\Component\Console;


class ComposerController extends Controller
{
    //
    public function getStatus()
    {
        $output = array(
            'composer' => file_exists('composer.phar'),
            'composer_extracted' => file_exists('extracted'),
            'installer' => file_exists('installer.php'),
        );

        echo json_encode($output);
    }

    public function downloadComposer()
    {
        $installerURL = 'https://getcomposer.org/installer';
        $installerFile = 'installer.php';
        if (!file_exists($installerFile))
        {
            echo 'Downloading ' . $installerURL . PHP_EOL;
            flush();
            $ch = curl_init($installerURL);
            curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . '/cacert.pem');
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_FILE, fopen($installerFile, 'w+'));
            if (curl_exec($ch))
                echo 'Success downloading ' . $installerURL . PHP_EOL;
            else
            {
                echo 'Error downloading ' . $installerURL . PHP_EOL;
                die();
            }
            flush();
        }
        echo 'Installer found : ' . $installerFile . PHP_EOL;
        echo 'Starting installation...' . PHP_EOL;
        flush();
        $argv = array();
        include $installerFile;
        flush();
    }

    public function extractComposer()
    {
        if (file_exists('composer.phar'))
        {
            echo 'Extracting composer.phar ...' . PHP_EOL;
            flush();
            $composer = new Phar('composer.phar');
            $composer->extractTo('extracted');
            echo 'Extraction complete.' . PHP_EOL;

        }
        else
            echo 'composer.phar does not exist';
    }

    public function command()
    {
        command:
        set_time_limit(-1);
        ini_set('memory_limit','2G');
        putenv('COMPOSER_HOME=' . __DIR__ . '/extracted/bin/composer');
        if(!file_exists($_POST['path']))
        {
            echo 'Invalid Path';
            die();
        }
        if (file_exists('extracted'))
        {
            require_once(__DIR__ . '/extracted/vendor/autoload.php');


            $input = new Console\Input\StringInput($_POST['command'].' -vvv -d '.$_POST['path']);
            $output = new Console\Output\StreamOutput(fopen('php://output','w'));
            $app = new Application();

//            $input = new Symfony\Component\Console\Input\StringInput($_POST['command'].' -vvv -d '.$_POST['path']);
//            $output = new Symfony\Component\Console\Output\StreamOutput(fopen('php://output','w'));
//            $app = new Composer\Console\Application();
            $app->run($input,$output);
        }
        else
        {
            echo 'Composer not extracted.';
            extractComposer();
            goto command;
        }
    }
}
