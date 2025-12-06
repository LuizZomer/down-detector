<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name : O nome do módulo (ex: Financeiro)}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria a estrutura de um novo módulo';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
