<?php

namespace LaPress\BlogFront\Commands;

use App\Support\ConfigBuilder;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class GenerateBlogfrontLocalConfigCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogfront:generate-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate local config';

    /**
     * @var ConfigBuilder
     */
    private $configBuilder;

    /**
     * Create a new command instance.
     * @param ConfigBuilder $configBuilder
     */
    public function __construct(ConfigBuilder $configBuilder)
    {
        parent::__construct();
        $this->configBuilder = $configBuilder;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->configBuilder->build();
        $this->icon('✔', 'Generated local config', 'local.json');
    }
}
