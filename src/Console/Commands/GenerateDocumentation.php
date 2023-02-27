<?php

namespace AutoDocumentation\Console\Commands;

use AutoDocumentation\Documentation;
use Illuminate\Console\Command;

class GenerateDocumentation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto-doc:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate documentation';

    /**
     * @return void
     */
    public function handle(Documentation $documentation)
    {
        $this->warn('Generating documentation ...');

        $documentation->generate();

        $this->info('Documentation generated! Visit: '.route('auto-documentation.documentation'));
    }
}
