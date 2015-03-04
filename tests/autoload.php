<?php

include dirname(__DIR__) . '/vendor/autoload.php';

use Mockery as m;
use Onigoetz\Imagecache\Manager;
use org\bovigo\vfs\vfsStream;

trait ImagecacheTestTrait {

    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    protected $vfsRoot;

    function getDummyImageName()
    {
        return '500px-Smiley.png';
    }

    function getImageFolder()
    {
        $this->vfsRoot = vfsStream::setup('root');
        mkdir(vfsStream::url('root') . '/images');
        vfsStream::copyFromFileSystem(__DIR__ . '/Fixtures/source', $this->vfsRoot->getChild('images'));
        return vfsStream::url('root');
    }
}

abstract class ImagecacheTestCase extends \PHPUnit_Framework_TestCase
{
    use ImagecacheTestTrait;

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        m::close();
    }

    function getManager($options = array())
    {
        //Add default option
        $options += array('path_images_root' => $this->getImageFolder());

        return new Manager($options);
    }

    function getMockedManager($options = array())
    {
        //Add default option
        $options += array('path_images_root' => $this->getImageFolder());

        return m::mock('Onigoetz\Imagecache\Manager', array($options))
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();
    }
}

class Laravel5TestCase extends \Orchestra\Testbench\TestCase
{
    use ImagecacheTestTrait;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        if (! $this->app) {
            $this->refreshApplication();
        }

        $artisan = $this->app->make('Illuminate\Contracts\Console\Kernel');
        $artisan->call('vendor:publish');

        //refresh configuration values
        $this->refreshApplication();
    }

    /**
     * {@inheritdoc}
     */
    protected function getEnvironmentSetUp($app)
    {
        // reset base path to point to our package's src directory
        $app['path.base'] = realpath(__DIR__ . '/..');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app)
    {
        return ['\Onigoetz\Imagecache\Support\Laravel\ImagecacheServiceProvider5'];
    }
}
