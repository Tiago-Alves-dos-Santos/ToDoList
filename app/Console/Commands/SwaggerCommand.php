<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SwaggerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compilar swagger ui';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $openApi = \OpenApi\Generator::scan([config('swagger.sources')]);
        file_put_contents(public_path('api-doc/swagger.json'), $openApi->toJson());
        //saida console
        $this->info('Swagger Api generated successfully');
        return Command::SUCCESS;

    }
}
