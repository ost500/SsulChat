<?php

namespace App\Console\Commands;

use App\Ssul;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheMainSsuls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:MainSsuls';

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
     * @return mixed
     */
    public function handle()
    {

        $dt = new Carbon();

        $builder = Ssul::leftJoin('ssul_chattings', function ($q) use ($dt) {
            $q->on('ssul_chattings.ssul_id', '=', 'ssuls.id');
            $q->where('ssul_chattings.created_at', '>', $dt->subDay()->format('Y-m-d H:i:s'));
        })
            ->groupBy('ssuls.id')
            ->selectRaw("ssuls.*, count(ssul_chattings.id) as chat_count")
            ->orderBy('chat_count', 'desc')->take(12);


        $channels = $builder->get();


        Cache::pull('cache:mainSsuls');
        Cache::remember('cache:mainSsuls', 20, function () use ($channels, $dt) {

            print_r($channels->toArray());

            return $channels;
        });
    }
}
