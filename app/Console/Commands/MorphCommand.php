<?php

namespace App\Console\Commands;

use App\Morph;
use App\Ssul;
use App\Team;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

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

        shell_exec($command . " >> morph_log.log");
//
//        /** @var Collection $ssuls */
//        $ssuls = Ssul::get();
//        $ssuls->each(function (Ssul $ssul) {
//            /** @var Collection $morphsBySsul */
//            $morphsBySsul = $ssul->morphs->sortByDesc('count')->take(10);
//
//            $morphsBySsul->each(function (Morph $morph) {
//
//                /** @var Ssul $morphedSsul */
//                $morphedSsul = Ssul::find($morph->ssul_id);
//                if (!Ssul::where('name', $morphedSsul->name . $morph->morph)->exists()) {
//
//                    echo "new Ssul : " . $morphedSsul->name . $morph->morph . "\n";
//
//                    $newSsul = new Ssul();
//                    $newSsul->name = $morphedSsul->name . $morph->morph;
//                    $newSsul->save();
//
//                    $team = new Team();
//                    $team->ssul_id = $newSsul->id;
//                    $team->name = "긍정";
//                    $team->value = 50;
//                    $team->save();
//
//                    $team = new Team();
//                    $team->ssul_id = $newSsul->id;
//                    $team->name = "부정";
//                    $team->value = 50;
//                    $team->save();
//                }
//            });
//        });

    }
}
