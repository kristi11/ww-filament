<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Laravel\Prompts\Prompt;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Process\Process;

class SetupShieldCommand extends Command
{
    /**
     * Configure the prompt fallbacks and set interactive mode to false to avoid stream_isatty issues.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @return void
     */
    protected function configurePrompts(InputInterface $input)
    {
        parent::configurePrompts($input);

        // Force non-interactive mode to avoid stream_isatty issues
        Prompt::interactive(false);
    }
    protected $signature = 'app:setup-shield';
    protected $description = 'Run a series of commands to set up Shield with fresh migrations and admin user';

    public function handle()
    {
        $this->info('Starting Shield setup process...');

        // Step 1: Fresh migrations with seeding
        $this->info('Running fresh migrations with seeding...');
        Artisan::call('migrate:fresh', ['--seed' => true]);
        $this->info(Artisan::output());

        // Step 2: Shield setup
        $this->info('Setting up Shield...');
        // Use Process with --minimal and --no-interaction options to avoid interactive prompts
        $process = new \Symfony\Component\Process\Process([
            'php', 'artisan', 'shield:setup', '--fresh', '--minimal', '--no-interaction'
        ]);
        $process->run();
        $this->info($process->getOutput());

        // Step 3: Generate Shield resources
        $this->info('Generating Shield admin resource permissions...');
        Artisan::call('shield:generate', ['--all' => true, '--panel' => 'admin']);
        $this->info(Artisan::output());

        // Step 4: Set up super admin
        $this->info('Setting up super admin user...');
        Artisan::call('shield:super-admin', ['--user' => '1']);
        $this->info(Artisan::output());

        $this->info('Shield setup completed successfully!');

        return 0;
    }
}
