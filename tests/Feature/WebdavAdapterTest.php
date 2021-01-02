<?php


namespace Villaflor\WebdavAdapter\Tests\Feature;


use Illuminate\Support\Facades\Storage;
use Villaflor\WebdavAdapter\Tests\TestCase;
use Villaflor\WebdavAdapter\WebdavAdapter;

class WebdavAdapterTest extends TestCase
{

    public function testInjectedAdapter(): void
    {
        $filesystem = Storage::disk('webdav');
        $driver = $filesystem->getDriver();

        $this->assertInstanceOf(WebdavAdapter::class, $driver->getAdapter());
    }
}