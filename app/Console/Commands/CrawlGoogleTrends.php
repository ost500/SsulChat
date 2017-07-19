<?php

namespace App\Console\Commands;

use App\Channel;
use App\Ssul;
use App\Team;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class CrawlGoogleTrends extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:googleTrends';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'google trends crawling';

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
        $client = new Client([
            'base_uri' => 'https://trends.google.com',
        ]);
        $response = $client->get('/trends/hottrends/atom/feed', [
            'query' => [
                'pn' => 'p23'
            ],
        ]);
        $body = $response->getBody();


        $xml = simplexml_load_string($body);


        foreach ($xml->channel->item as $item) {
            print_r($item);

            if (!Ssul::where('name', $item->title)->exists()) {

                DB::transaction(function () use ($item) {
                    $newSsul = new Ssul();
                    $newSsul->name = $item->title;
                    $newSsul->save();

                    $newChannel = new Channel();
                    $newChannel->ssul_id = $newSsul->id;
                    $newChannel->name = 1;
                    $newChannel->save();

                    $newTeam = new Team();
                    $newTeam->ssul_id = $newSsul->id;
                    $newTeam->name = "긍정";
                    $newTeam->value = 50;
                    $newTeam->save();

                    $newTeam = new Team();
                    $newTeam->ssul_id = $newSsul->id;
                    $newTeam->name = "부정";
                    $newTeam->value = 50;
                    $newTeam->save();
                });

            }

        }

    }

}
