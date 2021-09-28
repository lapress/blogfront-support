<?php

namespace LaPress\BlogFront\Commands;

use Illuminate\Filesystem\Filesystem;
use LaPress\BlogFront\Installer;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class InstallCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogfront:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install laPress';
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Installer
     */
    private $installer;

    /**
     * Create a new command instance.
     * @param Installer $installer
     */
    public function __construct(Installer $installer)
    {
        parent::__construct();
        $this->installer = $installer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('                                   ');
        $this->info('  _       ____                     ');
        $this->info(' | | __ _|  _ \ _ __ ___  ___ ___  ');
        $this->info(' | |/ _` | |_) | \'__/ _ \/ __/ __| ');
        $this->info(' | | (_| |  __/| | |  __/\__ \__ \ ');
        $this->info(' |_|\__,_|_|   |_|  \___||___/___/ ');
        $this->info('                                   ');

        $this->installer->deletePreviousWordPress();
        $this->icon('✔', 'Previous WordPress code deleted');
        $this->installer->wordpress();
        $this->icon('✔', 'WordPress content moved to storage directory');
        $this->installer->link();
        $this->icon('✔', 'Public content linked');
        $this->installer->wpConfig();
        $this->icon('✔', 'Blogfront WordPress has been configured', 'wp-config.php');


        $this->line('');
        $this->info('----------------------------');
        $this->info('|    laPress installed.    |');
        $this->info('----------------------------');
        $this->line('');
    }
}
