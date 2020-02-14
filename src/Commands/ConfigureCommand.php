<?php

namespace LaPress\BlogFront\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class ConfigureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogfront:configure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configure WordPress';

    /**
     * Create a new command instance.
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        parent::__construct();
    }

    public function handle()
    {
        $wordpressSampleConfig = wordpress_path('wp-config-sample.php');
        if ($this->filesystem->exists($wordpressSampleConfig)) {
            $this->filesystem->delete($wordpressSampleConfig);
        }

        $this->filesystem->copy(
            __DIR__.'/stubs/wp-config.php.stub',
            wordpress_path('wp-config.php')
        );
    }
}
