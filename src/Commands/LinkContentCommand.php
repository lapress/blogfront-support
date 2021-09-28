<?php

namespace LaPress\BlogFront\Commands;


use LaPress\BlogFront\Installer;

class LinkContentCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogfront:content:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Link content directory';
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
        try {
            $this->installer->link();
            $this->icon('✔', 'Public content has been linked');
        } catch (\Exception $e) {

        }
    }
}
