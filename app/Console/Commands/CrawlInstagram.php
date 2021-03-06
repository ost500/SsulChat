<?php

namespace App\Console\Commands;

use App\Chatting;
use App\Instagram;
use App\Ssul;
use App\SsulChatting;
use App\User;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Smochin\Instagram\Crawler;

class CrawlInstagram extends Command
{
    const BASE_URI = 'https://www.instagram.com';
    const QUERY = ['__a' => 1];
    const TAG_ENDPOINT = '/explore/tags/%s';
    const LOCATION_ENDPOINT = '/explore/locations/%d';
    const USER_ENDPOINT = '/%s';
    const MEDIA_ENDPOINT = '/p/%s';
    const SEARCH_ENDPOINT = '/web/search/topsearch';
    const SEARCH_CONTEXT_PARAM = 'blended';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:instagram';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '인스타그램 데이터를 크롤링해 옵니다';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'query' => self::QUERY,
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var Collection $ssuls */
        $ssuls = Ssul::get();
        $ssuls->each(function (Ssul $ssul) {
            try {


                $title = $ssul->name;

                $title = str_replace(' ', '', $title);

                $title = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", '', $title);

                echo "[Instagram]" . $title . "\n";

                $media = $this->getMediaByTag(urlencode($title));

                foreach ($media as $me) {
                    foreach ($me['media']['nodes'] as $node) {
                        if (!Instagram::where('display_src', $node['display_src'])->exists()) {
                            DB::transaction(function () use ($node, $title, $ssul) {
                                $newInstagram = new Instagram();

                                $newInstagram->display_src = $node['display_src'];
                                $newInstagram->date = $node['date'];
                                $newInstagram->caption = $node['caption'];
                                $newInstagram->ssul_id = $ssul->id;

                                $newInstagram->save();

                                $newChat = new Chatting();

                                $instaUser = User::where('name', "instagram")->first();

                                $newChat->user_id = $instaUser->id;
                                $newChat->team_id = null;
                                $newChat->ipaddress = "127.0.0.1";
                                $newChat->picture = $node['display_src'];
                                $newChat->social = 1;

                                $content = $node['caption'];
                                $newChat->content = $content;

                                $newChat->save();

                                $newSsulChatting = new SsulChatting();
                                $newSsulChatting->ssul_id = $ssul->id;
                                $newSsulChatting->chatting_id = $newChat->id;
                                $newSsulChatting->save();
                            });
                        }
                    }

                }
            } catch (Exception $e) {
                (new SlackMessage)
                    ->from('Instagram Crawling')
                    ->content("[Instagram Crawling]에러가 발생했습니다 {$title}\n" . $e->getMessage() . "\n" . $e->getTraceAsString());
            }
        });


    }

    public function getMediaByTag(string $name): array
    {
        $client = new Client([
            'base_uri' => 'https://www.instagram.com',
            'query' => ['__a' => 1],
        ]);
        $response = $client->request('GET', '/explore/tags/' . $name);

        $body = json_decode($response->getBody()->getContents(), true);

        return ($body);
    }

}
