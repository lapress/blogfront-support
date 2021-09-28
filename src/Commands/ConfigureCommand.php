<?php

namespace LaPress\BlogFront\Commands;

use LaPress\BlogFront\Installer;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class ConfigureCommand extends BaseCommand
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
     * @var Installer
     */
    private $installer;

    /**
     * Create a new command instance.
     *
     * @param Installer $installer
     */
    public function __construct(Installer $installer)
    {
        parent::__construct();
        $this->installer = $installer;
    }

    public function handle()
    {
        $this->installer->wpConfig();
        $this->icon('✔', 'Blogfront WordPress has been configured', 'wp-config.php');

        $this->installer->link();
        $this->icon('✔', 'Content folder linked', '/content');
    }
}
