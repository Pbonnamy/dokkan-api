<?php

namespace App\Console\Commands;

use App\Traits\DokkanScrapingTrait;
use Illuminate\Console\Command;

class ScrapDokkan extends Command
{

    use DokkanScrapingTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap-dokkan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->get_dokkan_data();
        
        return 0;
    }
}
