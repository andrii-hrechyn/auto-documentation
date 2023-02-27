<?php

namespace AutoDocumentation\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto-doc:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install documentation';

    /**
     * @return void
     */
    public function handle()
    {
        $this->addAutoloadToComposerJson();

        (new Filesystem)->copyDirectory(
            __DIR__.'/docs-stubs',
            base_path('docs')
        );

        $this->executeCommand('composer dump -o', getcwd());
    }

    protected function addAutoloadToComposerJson()
    {
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        if (isset($composer['autoload']['psr-4']['Docs\\'])) {
            return;
        }

        $composer['autoload']['psr-4']['Docs\\'] = 'docs';

        file_put_contents(
            base_path('composer.json'),
            json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        );
    }

    protected function executeCommand($command, $path)
    {
        $process = (Process::fromShellCommandline($command, $path))->setTimeout(null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            $process->setTty(true);
        }

        $process->run(function ($type, $line) {
            $this->output->write($line);
        });
    }
}
