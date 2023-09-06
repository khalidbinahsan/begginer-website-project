<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class appInstaller extends Controller
{
    function makeMigrationFile(){
       Artisan::call('make:migration my_table');
    }
    function runMigrationFile(){
        Artisan::call('migrate');
    }
    function AppCacheClear(){
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');

    }
    function SetEnvVal($envKey, $envValue){
       $envFilePath = app()->environmentFilePath();
       $envByString = file_get_contents($envFilePath);
        // Create a new line at last of the .env string
        $envByString.="\n";
        // Get String Position
        $keyStartPos = strpos($envByString, "{$envKey}=");
        $keyEndingPos = strpos($envByString, "\n", $keyStartPos);
        $oldValue = substr($envByString, $keyStartPos, $keyEndingPos-$keyStartPos);

        if(!$keyStartPos || !$keyEndingPos || !$oldValue){
            $envByString.="{$envKey}={$envValue}\n";
        } else {
            $envByString = str_replace($oldValue, "{$envKey}={$envValue}", $envByString);
        }
        $envByString = substr($envByString, 0, -1);
        $changingResult = file_put_contents($envFilePath, $envByString);
        if(!$changingResult){
            return false;
        } else {
            return true;
        }
    }

    function EnvConfig(){
        $this->SetEnvVal('DB_DATABASE', 'my_database');
        $this->SetEnvVal('DB_USERNAME', 'my_user');
        $this->SetEnvVal('DB_PASSWORD', '28428927');

        $this->SetEnvVal('ON_SIGNAL_API_KEY', '2424354654754736');
        $this->SetEnvVal('SMS_API_KEY', '457346347537355673');
        $this->SetEnvVal('SMS_API_USER', '35634563453');
        $this->SetEnvVal('SMS_API_PASS', '563634645645');
    }

    function serverConfigCheck(){
        $phpVersion = phpversion();
        $bcmath = extension_loaded('bcmath');
        $ctype = extension_loaded('ctype');
        $fileInfo = extension_loaded('fileinfo');
        $json = extension_loaded('json');
        $mbString = extension_loaded('mbstring');
        $openSSL = extension_loaded('openssl');
        $tokenizer = extension_loaded('tokenizer');
        $xml = extension_loaded('xml');
        $pdo = defined('PDO::ATTR_DRIVER_NAME');
        if($phpVersion >= 7.2 && $bcmath == true && $ctype == true && $fileInfo == true && $json == true && $mbString == true && $openSSL == true && $tokenizer == true && $xml == true && $pdo == true){
            return "Laravel 7x Supported";
        } else {
            return  "Laravel 7x ont Supported";
        }
    }





}
