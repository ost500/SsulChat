<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MorphCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'morph:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '형태소를 분석합니다';

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
     * @return mixed
     */
    public function handle()
    {
        $DB_PASSWORD = env('DB_PASSWORD', "\"\"");
        if ($DB_PASSWORD == "") {
            $DB_PASSWORD = "\"\"";
        }
        $command = "python morph " . env('DB_HOST', "\"\"") . " " . env('DB_USERNAME', "\"\"") . " " . $DB_PASSWORD . " " . env('DB_DATABASE', "\"\"");
        echo $command;

        shell_exec($command ." >> morph_log.log");
    }
}
