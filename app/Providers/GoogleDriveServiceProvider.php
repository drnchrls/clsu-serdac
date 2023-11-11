<?php

namespace App\Providers;

use Google\Service\Drive;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Masbug\Flysystem\GoogleDriveAdapter;
use League\Flysystem\Filesystem;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Storage::extend('google', function($app, $config) {
        //     $client = new \Google_Client();
        //     $client->setClientId($config['clientId']);
        //     $client->setClientSecret($config['clientSecret']);
        //     $client->refreshToken($config['refreshToken']);
        //     $service = new Drive($client);
        //     $adapter = new GoogleDriveAdapter($service, $config['folderId']);

        //     return new \League\Flysystem\Filesystem($adapter);
        // });
        Storage::extend('google', function($app, $config) {
            $client = new \Google_Client();
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);
            $service = new Drive($client);

            // $options = [];
            // if(isset($config['teamDriveId'])) {
            //     $options['teamDriveId'] = $config['teamDriveId'];
            // }

            $adapter = new GoogleDriveAdapter($service, $config['folderName']);
            $driver = new Filesystem($adapter);
            return new FilesystemAdapter($driver, $adapter);
      
        });
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}