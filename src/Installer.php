<?php

namespace LaPress\BlogFront;

use Illuminate\Filesystem\Filesystem;
use LaPress\Support\WordPress;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class Installer
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function wpConfig()
    {
        $wordpressSampleConfig = WordPress::path('wp-config-sample.php');
        if ($this->filesystem->exists($wordpressSampleConfig)) {
            $this->filesystem->delete($wordpressSampleConfig);
        }

        $this->filesystem->copy(
            __DIR__.'/Commands/stubs/wp-config.php.stub',
            WordPress::path('wp-config.php')
        );

        return $this;
    }

    public function link()
    {
        try {
            $this->filesystem->link(WordPress::content('uploads'), public_path('content/uploads'));
        } catch (\Exception $e) {

        }

        return $this;
    }

    public function linkTheme()
    {
        $theme = config('wordpress.theme.active', 'theme');

        try {
            $this->filesystem->link(
                resource_path('themes/'.$theme.'/public'),
                WordPress::content('themes/'.$theme)
            );
        } catch (\Exception $e) {

        }

        try {
            $this->filesystem->link(
                resource_path('themes/'.$theme.'/public'),
                public_path($theme)
            );
        } catch (\Exception $e) {

        }

        return $this;
    }

    public function deletePreviousWordPress()
    {
        $path = base_path('wordpress');
        if ($this->filesystem->exists($path)) {
            $this->filesystem->deleteDirectory($path);
        }
    }

    public function updateWordpress()
    {
        exec('composer update johnpbloch/wordpress-core');

        $this->link();
        $this->wpConfig();
    }

    public function wordpress()
    {
        if (!$this->filesystem->exists(WordPress::path())) {
            exec('composer update johnpbloch/wordpress-core');
        }

        $this->filesystem->makeDirectory(
            WordPress::content('/themes')
        );

        $this->filesystem->makeDirectory(
            WordPress::content('/uploads')
        );


        if ($this->filesystem->exists(WordPress::content('/plugins'))) {
            $this->filesystem->delete(WordPress::content('/plugins'));
        }
        $this->filesystem->move(
            WordPress::path('wp-content/plugins'),
            WordPress::content('/plugins')
        );
        if ($this->filesystem->exists(WordPress::content('/languages'))) {
            $this->filesystem->delete(WordPress::content('/languages'));
        }
        if ($this->filesystem->exists(WordPress::path('wp-content/languages'))) {
            $this->filesystem->move(
                WordPress::path('wp-content/languages'),
                WordPress::content('/languages')
            );
        } else {
            $this->filesystem->makeDirectory(
                WordPress::content('/languages')
            );
        }


        $this->filesystem->cleanDirectory(
            WOrdPress::path('wp-content')
        );
    }
}
