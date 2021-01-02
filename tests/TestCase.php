<?php


namespace Villaflor\WebdavAdapter\Tests;


use Illuminate\Foundation\Application;
use Villaflor\WebdavAdapter\WebdavAdapterServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{

    /**
     * Define environment setup.
     *
     * @param  Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('filesystems.disks.webdav', [
            'driver' => 'webdav',
            'baseUri' => 'http://example.com',
            'proxy' => null,
            'pathPrefix' => null,
            'userName' => 'username',
            'password' => 'password',
            'authType' => null,
            'encoding' => null,
        ]);
    }

    /**
     * Get package providers.
     *
     * @param  Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            WebdavAdapterServiceProvider::class
        ];
    }
}