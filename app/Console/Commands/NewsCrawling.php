<?php

namespace App\Console\Commands;

use App\Chatting;
use App\NaverNews;
use App\Ssul;
use App\SsulChatting;
use App\User;
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

            $countAtOnce = 10;

            for ($i = 1; $i <= $crawlCount; $i += $countAtOnce) {


                $encText = urlencode($ssul->name);
                $url = "https://openapi.naver.com/v1/search/news.json?start={$i}&display={$countAtOnce}&query=" . $encText; // json 결과

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
                                $newNaverNews->ssul_id = $ssul->id;
                                $newNaverNews->title = $title;
                                $newNaverNews->link = $new['link'];
                                $desc = strip_tags(htmlspecialchars_decode($new['description']));
                                $newNaverNews->description = $desc;
                                $newNaverNews->save();

                                $newChat = new Chatting();

                                $naverNewsUser = User::where('name',"NaverNews")->first();

                                $newChat->user_id = $naverNewsUser->id;
                                $newChat->team_id = null;
                                $newChat->ipaddress = "127.0.0.1";
                                $newChat->social = 2;

                                $content = $title . " " . $desc;
                                $newChat->content = $content;

                                $newChat->save();


                                $newSsulChatting = new SsulChatting();
                                $newSsulChatting->ssul_id = $ssul->id;
                                $newSsulChatting->chatting_id = $newChat->id;
                                $newSsulChatting->save();
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
