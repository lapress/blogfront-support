<?php

namespace LaPress\BlogFront\Commands;

use LaPress\BlogFront\Installer;

class ThemeLinkCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogfront:theme:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link for theme';

    /**
     * @var Theme
     */
    private $theme;

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
        $this->installer->linkTheme();
        $this->icon('✔', 'Theme has been linked');
    }
}
