<?php

namespace Tests\Feature\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SetupAppCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the minimal-seed option is recognized.
     *
     * @return void
     */
    public function test_minimal_seed_option_exists()
    {
        // Get the command definition
        $definition = $this->app->make(\App\Console\Commands\SetupAppCommand::class)->getDefinition();

        // Check if the minimal-seed option exists
        $this->assertTrue($definition->hasOption('minimal-seed'));

        // Check if the option description is correct
        $option = $definition->getOption('minimal-seed');
        $this->assertEquals('Only seed essential data, skip demo content', $option->getDescription());
    }

    /**
     * Test that the command can be executed with the minimal-seed option.
     *
     * @return void
     */
    public function test_command_can_be_executed_with_minimal_seed_option()
    {
        // This test just verifies that the command can be found and executed
        // without actually running the full command
        $this->artisan('app:setup --minimal-seed --help')
            ->assertExitCode(0);
    }

    /**
     * Test that the no-composer option is recognized.
     *
     * @return void
     */
    public function test_no_composer_option_exists()
    {
        // Get the command definition
        $definition = $this->app->make(\App\Console\Commands\SetupAppCommand::class)->getDefinition();

        // Check if the no-composer option exists
        $this->assertTrue($definition->hasOption('no-composer'));

        // Check if the option description is correct
        $option = $definition->getOption('no-composer');
        $this->assertEquals('Skip Composer dependencies installation', $option->getDescription());
    }

    /**
     * Test that the command can be executed with the no-composer option.
     *
     * @return void
     */
    public function test_command_can_be_executed_with_no_composer_option()
    {
        // This test just verifies that the command can be found and executed
        // without actually running the full command
        $this->artisan('app:setup --no-composer --help')
            ->assertExitCode(0);
    }

    /**
     * Test that the no-npm option is recognized.
     *
     * @return void
     */
    public function test_no_npm_option_exists()
    {
        // Get the command definition
        $definition = $this->app->make(\App\Console\Commands\SetupAppCommand::class)->getDefinition();

        // Check if the no-npm option exists
        $this->assertTrue($definition->hasOption('no-npm'));

        // Check if the option description is correct
        $option = $definition->getOption('no-npm');
        $this->assertEquals('Skip NPM dependencies installation', $option->getDescription());
    }

    /**
     * Test that the command can be executed with the no-npm option.
     *
     * @return void
     */
    public function test_command_can_be_executed_with_no_npm_option()
    {
        // This test just verifies that the command can be found and executed
        // without actually running the full command
        $this->artisan('app:setup --no-npm --help')
            ->assertExitCode(0);
    }
}
