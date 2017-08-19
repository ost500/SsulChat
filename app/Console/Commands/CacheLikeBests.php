<?php

namespace App\Console\Commands;

use App\Chatting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheLikeBests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:likeBests';

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
        $likeBests = Chatting::leftJoin(DB::raw('`likes` FORCE INDEX (likes_chatting_id_index)'), function ($q) {
            $q->on('likes.chatting_id', '=', 'chattings.id');
            $q->where('likes.created_at', '>', Carbon::now()->subWeek()->format("Y-m-d H:i:s"));
        })
            ->selectRaw('chattings.*, count(chattings.id) as likeCount')
            ->groupBy('chattings.id')
            ->orderBy('likeCount', 'desc')
            ->orderBy('created_at')
            ->take(50)->with('ssuls')->with('user')->get();
        Cache::pull('cache:likeBests');
        Cache::remember('cache:likeBests', 120, function () use ($likeBests) {


            return $likeBests;
        });
    }
}
