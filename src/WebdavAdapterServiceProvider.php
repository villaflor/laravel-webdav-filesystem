<?php


namespace Villaflor\WebdavAdapter;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Sabre\DAV\Client;

class WebdavAdapterServiceProvider extends ServiceProvider
{

    public function boot(): void
    {

        Storage::extend('webdav', function ($app, $config) {
            $adapter = new WebdavAdapter(new Client($config), $config);

            if (!empty($config['pathPrefix'])) {
                $adapter->setPathPrefix($config['pathPrefix']);
            }

            return new Filesystem($adapter);
        });
    }

    public function register(): void
    {

    }
}