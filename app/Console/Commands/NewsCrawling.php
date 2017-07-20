<?php

namespace App\Console\Commands;

use App\Chatting;
use App\NaverNews;
use App\Ssul;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class NewsCrawling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:naverNews {count=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '네이버 뉴스를 크롤링 해 옵니다.';

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

        $crawlCount = $this->argument('count');

        $client_id = "7cfdeaICkiBH_RGuNL1d";
        $client_secret = "CXsJbctS3X";

        /** @var Ssul $ssuls */
        $ssuls = Ssul::get();
        $ssuls->each(function (Ssul $ssul) use ($client_id, $client_secret, $crawlCount) {

            for ($i = 1; $i <= $crawlCount; $i += 100) {


                $encText = urlencode($ssul->name);
                $url = "https://openapi.naver.com/v1/search/news.json?start={$i}&display=100&query=" . $encText; // json 결과

                $is_post = false;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, $is_post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $headers = array();
                $headers[] = "X-Naver-Client-Id: " . $client_id;
                $headers[] = "X-Naver-Client-Secret: " . $client_secret;

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                $response = curl_exec($ch);
                $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                echo "status_code:" . $status_code . "";
                curl_close($ch);

                if ($status_code == 200) {
                    $news = json_decode($response, true);


                    foreach ($news["items"] as $new) {
                        echo $new["title"] . "\n";
                        $title = strip_tags(htmlspecialchars_decode($new["title"]));
                        if (!NaverNews::where('title', $title)->exists()) {

                            DB::transaction(function () use ($title, $new, $ssul) {
                                $newNaverNews = new NaverNews();
                                $newNaverNews->title = $title;
                                $newNaverNews->link = $new['link'];
                                $desc = strip_tags(htmlspecialchars_decode($new['description']));
                                $newNaverNews->description = $desc;
                                $newNaverNews->save();

                                $newChat = new Chatting();
                                $newChat->user_id = 1;
                                $newChat->team_id = null;
                                $newChat->channel_id = $ssul->channels->first()->id;
                                $newChat->ipaddress = "127.0.0.1";

                                $content = $title . " " . $desc . " " . $new['link'];
                                $newChat->content = $content;

                                $newChat->save();
                            });

                        }
                    }


                } else {
                    echo "Error 내용:" . $response;
                }
            }
        });

    }
}
