<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Laravel\Prompts\Prompt;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Process\Process;

class SetupAppCommand extends Command
{
    /**
     * Configure the prompt fallbacks and set interactive mode to false to avoid stream_isatty issues.
     *
     * @return void
     */
    protected function configurePrompts(InputInterface $input)
    {
        parent::configurePrompts($input);

        // Force non-interactive mode to avoid stream_isatty issues
        Prompt::interactive(false);
    }

    protected $signature = 'app:setup
                            {--no-key : Skip the key generation step}
                            {--production : Use npm run build instead of npm run dev (for production environments)}
                            {--minimal-seed : Only seed essential data, skip demo content}
                            {--no-composer : Skip Composer dependencies installation}
                            {--no-npm : Skip NPM dependencies installation}';

    protected $description = 'Set up the application with all necessary dependencies and configurations, with options to skip key generation, use production build, seed only essential data, skip Composer installation, or skip NPM installation';

    public function handle()
    {
        $this->info('Starting application setup process...');

        // Step 1: npm install (unless skipped)
        if (!$this->option('no-npm')) {
            $this->info('Installing npm dependencies...');
            $this->runProcess(['npm', 'install']);
        } else {
            $this->warn('Skipping NPM dependencies installation as requested.');
        }

        // Step 2: composer install (unless skipped)
        if (!$this->option('no-composer')) {
            $this->info('Installing composer dependencies...');
            $this->runProcess(['composer', 'install']);
        } else {
            $this->warn('Skipping Composer dependencies installation as requested.');
        }

        // Step 3: Copy .env.example to .env
        $this->info('Creating environment file...');
        if (! file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
            $this->info('Environment file created successfully.');
        } else {
            $this->warn('Environment file already exists. Skipping this step.');
        }

        // Step 4: Generate application key (unless skipped)
        if (! $this->option('no-key')) {
            $this->info('Generating application key...');
            Artisan::call('key:generate');
            $this->info(Artisan::output());
        } else {
            $this->warn('Skipping key generation as requested.');
        }

        // Step 5: Run database migrations with appropriate seeding
        if ($this->option('minimal-seed')) {
            $this->info('Running fresh migrations with essential seeding only...');
            // Run migrations first
            Artisan::call('migrate:fresh');
            $this->info(Artisan::output());

            // Then call the essential data seeder
            $this->info('Seeding essential data only...');
            Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\EssentialDataSeeder']);
            $this->info(Artisan::output());
        } else {
            $this->info('Running fresh migrations with full seeding...');
            Artisan::call('migrate:fresh', ['--seed' => true]);
            $this->info(Artisan::output());
        }

        // Step 6: Set up Shield
        $this->info('Setting up Shield...');
        // Use Process with --minimal and --no-interaction options to avoid interactive prompts
        $process = new Process(['php', 'artisan', 'shield:setup', '--fresh', '--minimal', '--no-interaction']);
        $process->run();
        $this->info($process->getOutput());

        // Step 7: Generate Shield resources
        $this->info('Generating Shield admin resource permissions...');
        Artisan::call('shield:generate', ['--all' => true, '--panel' => 'admin']);
        $this->info(Artisan::output());

        // Step 8: Set up super admin
        $this->info('Setting up super admin user...');
        Artisan::call('shield:super-admin', ['--user' => '1']);
        $this->info(Artisan::output());

        // Step 9: Create storage link
        $this->info('Creating storage link...');
        Artisan::call('storage:link');
        $this->info(Artisan::output());

        // Step 10: Run npm build or dev based on option
        if ($this->option('production')) {
            $this->info('Building assets for production...');
            $this->runProcess(['npm', 'run', 'build']);
        } else {
            $this->info('Building assets for development...');
            $this->runProcess(['npm', 'run', 'dev']);
        }

        $this->info('Setup completed successfully!');
        $this->info('To start the development server, run: php artisan serve');

        return 0;
    }

    /**
     * Run a process and display its output
     *
     * @param  array  $command  The command to run
     * @param  bool  $waitForProcess  Whether to wait for the process to complete
     * @return void
     */
    protected function runProcess(array $command, bool $waitForProcess = true)
    {
        $process = new Process($command);
        $process->setTimeout(null);

        if ($waitForProcess) {
            $process->run(function ($type, $buffer) {
                $this->output->write($buffer);
            });
        } else {
            // For long-running processes
            $process->start();
            $this->info('Process started: '.implode(' ', $command));
        }
    }
}
