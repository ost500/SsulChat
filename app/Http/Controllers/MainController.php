<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Chatting;
use App\Page;
use App\Ssul;
use App\Team;
use App\User;


use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use MetzWeb\Instagram\Instagram;


class MainController extends Controller
{

    public function main()
    {
        if (Auth::check() and Auth::user()->annony) {
            Auth::logout();
        }

        $dt = new Carbon();

        $builder = Ssul::leftJoin('ssul_chattings', function ($q) use ($dt) {
            $q->on('ssul_chattings.ssul_id', '=', 'ssuls.id');
            $q->where('ssul_chattings.created_at', '>', $dt->subDay()->format('Y-m-d H:i:s'));
        })
            ->groupBy('ssuls.id')
            ->selectRaw("ssuls.*, count(ssul_chattings.id) as chat_count")
            ->orderBy('chat_count', 'desc');


        $channels = $builder->paginate(12);

        $channels->each(function ($value) {
            $loginMembers = Redis::get("presence-newMessage{$value->id}:members");

            /** @var Collection $loginMembers */
            $loginMembers = collect(json_decode($loginMembers));

            $value->loginMembersCount = $loginMembers->count();
        });

        $channels = $channels->sortByDesc('loginMembersCount');


        /** @var Collection $pages */
        $pages = Page::take(4)->with('ssuls')->withCount('ssuls')->get();

        $pageUserCount = 0;

        foreach ($pages as $page) {

            foreach ($page->ssuls as $ssul) {
                $loginMembers = Redis::get("presence-newMessage{$ssul->id}:members");

                /** @var Collection $loginMembers */
                $loginMembers = collect(json_decode($loginMembers));

                $pageUserCount += $loginMembers->count();
            }
            $page->membersCount = $pageUserCount;
            $pageUserCount = 0;
        }

        $pages = $pages->sortByDesc('membersCount');


        $likeBests = Cache::get('cache:likeBests');

        return view('main', compact('channels', 'pages', 'likeBests'));
    }

    public function search(Request $request)
    {
        $question = $request->question;

        $chattings = Ssul::join('ssul_chattings', 'ssul_chattings.ssul_id', '=', 'ssuls.id')
            ->groupBy('ssuls.id')
            ->selectRaw("ssuls.*, count(ssul_chattings.id) as chat_count")
            ->orderBy('chat_count', 'desc')
            ->where('ssuls.name', 'like', "{$question}%")
            ->paginate(10);

        $pages = Page::where('title', 'like', "{$question}%")->paginate(10);

        /** @var Collection $exactChatting */
        $exactChatting = Ssul::where('name', $question)->get();

        if ($exactChatting->isEmpty()) {
            $addNew = true;
        }

        return view('search', compact('chattings', 'pages', 'question', 'addNew'));
    }

    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();

    }

    public function facebookCallback(Request $request)
    {

        $fbUser = Socialite::driver('facebook')->user();

        $user = User::where('email', $fbUser->email)->first();

        if ($user == null) {
            $newUser = new User();

            $newUser->name = $fbUser->name;
            $newUser->email = $fbUser->email;
            $newUser->password = $fbUser->id;
            $newUser->profile_img = $fbUser->avatar;
            $newUser->save();

            Auth::loginUsingId($newUser->id);
        } else {
            Auth::loginUsingId($user->id);
        }

        return redirect()->intended();
    }

    public function search_json(Request $request)
    {
        $ssuls = Ssul::where('name', 'like', "%" . $request->keyword . "%")->limit(5)->get();

        return response()->json($ssuls);
    }

    public function ssul(Request $request)
    {
        return view('ssul');
    }

    public function ssulCreate(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'team1' => 'required|max:20',
            'team2' => 'required|max:20',
        ], [
            'name.required' => '썰 제목은 필수 입니다.',
            'team1.required' => '세력1은 필수 입니다.',
            'team1.max' => '세력명이 너무 깁니다.',
            'team2.required' => '세력2는 필수 입니다.',
            'team2.max' => '세력명이 너무 깁니다.',
        ])->validate();

        print_r($request->all());

        $ssul = new Ssul();

        DB::transaction(function () use ($request, &$ssul) {

            $ssul->name = $request->name;
            $ssul->save();

            $team = new Team();
            $team->ssul_id = $ssul->id;
            $team->name = $request->team1;
            $team->value = 50;
            $team->save();

            $team = new Team();
            $team->ssul_id = $ssul->id;
            $team->name = $request->team2;
            $team->value = 50;
            $team->save();

            $newChannel = new Channel();
            $newChannel->name = 1;
            $newChannel->ssul_id = $ssul->id;
            $newChannel->save();
        });

        return redirect()->route('chattings', ['id' => $ssul->id]);

    }

    public function mysitemap()
    {

        // create new sitemap object
        $sitemap = App::make("sitemap");

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
//        $sitemap->setCache('laravel.sitemap', 60);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {

            $images = [
                ['url' => URL::to('/images/main_logo02.png'), 'title' => '썰챗'],
            ];

            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(URL::to('/'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', $images, "썰챗");


            // add item with images

//            $sitemap->add(URL::to('post-with-images'), '2015-06-24T14:30:00+02:00', '0.9', 'monthly', $images);

            // get all posts from db
            $ssuls = DB::table('ssuls')->orderBy('created_at', 'desc')->get();

            // add every post to the sitemap
            foreach ($ssuls as $ssul) {
                $images = [
                    ['url' => URL::to('/images/main_logo02.png'), 'title' => $ssul->name],
                ];

                $sitemap->add(route('chattings', ['id' => $ssul->id]), $ssul->created_at, '1.0', 'daily', $images, $ssul->name, []);
            }
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');

    }

    public function instaRedirect(Request $request)
    {
        $media = $this->getMediaByTag(urlencode('오상택'));
        foreach ($media as $me) {
            print_r($me['media']['nodes']);

        }

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

    public function page($id)
    {
        $page = Page::with('ssuls')->withCount('ssuls')->with('pagePosts')->findOrFail($id);

        $morphs = Page::join('page_ssuls', 'page_ssuls.page_id', '=', 'pages.id')
            ->join('ssuls', 'ssuls.id', '=', 'page_ssuls.ssul_id')
            ->join('morphs', 'morphs.ssul_id', '=', 'ssuls.id')
            ->join('morph_logs', 'morph_logs.morph_id', '=', 'morphs.id')
            ->groupBy('morph')
            ->selectRaw('morphs.morph, count(morph_logs.id) as morph_count')
            ->where('pages.id', $id)
            ->orderBy('morph_count', 'desc')
            ->take(40)
            ->get();

        $admin = false;

        /** @var Collection $admins */
        $admins = $page->admin;

        if (Auth::check()) {
            if (Auth::user()->name == "ost") {
                $admin = true;
            } elseif ($admins == null || !$admins->where('name', Auth::user()->name)->isEmpty()) {
                $admin = true;
            }
        }

        $likeBests = Page::join('page_ssuls', 'page_ssuls.page_id', '=', 'pages.id')
            ->join('ssuls', 'ssuls.id', '=', 'page_ssuls.ssul_id')
            ->join('ssul_chattings', 'ssul_chattings.ssul_id', '=', 'ssuls.id')
            ->rightJoin('chattings', 'chattings.id', '=', 'ssul_chattings.chatting_id')
            ->join('users', 'users.id', '=', 'chattings.user_id')
            ->leftJoin('likes', function ($q) {
                $q->on('likes.chatting_id', '=', 'chattings.id');
//                $q->where('likes.created_at', '>', Carbon::now()->subWeek()->format("Y-m-d H:i:s"));
            })
            ->groupBy('chattings.id')
            ->selectRaw('chattings.*, count(likes.id) as likeCount, users.*')
            ->where('pages.id', $id)
            ->orderBy('likeCount', 'desc')
            ->orderBy('likes.created_at')
            ->take(20)
            ->get();

//        return response()->json($likeBests);


        return view('page', compact('page', 'morphs', 'admin', 'likeBests'));
    }

    public function pageList()
    {
        $pages = Page::with('ssuls')->withCount('ssuls')->paginate(20);

//        return response()->json($page);

        $pageUserCount = 0;

        foreach ($pages as $page) {

            foreach ($page->ssuls as $ssul) {
                $loginMembers = Redis::get("presence-newMessage{$ssul->id}:members");

                /** @var Collection $loginMembers */
                $loginMembers = collect(json_decode($loginMembers));

                $pageUserCount += $loginMembers->count();
            }
            $page->membersCount = $pageUserCount;
            $pageUserCount = 0;
        }

        $likeBests = Cache::get('cache:likeBests');

        return view('pageList', compact('pages', 'likeBests'));
    }

    public function chattingList()
    {
        $builder = Ssul::leftJoin('ssul_chattings', function ($q) {
            $q->on('ssul_chattings.ssul_id', '=', 'ssuls.id');
        })
//            ->where('ssul_chattings.created_at', '>', Carbon::now()->subWeek()->format('Y-m-d'))
            ->groupBy('ssuls.id')
            ->selectRaw("ssuls.*, count(ssul_chattings.id) as chat_count")
            ->orderBy('chat_count', 'desc');


        $chattings = $builder->paginate(42);

        $chattings->each(function ($value) {
            $loginMembers = Redis::get("presence-newMessage{$value->id}:members");

            /** @var Collection $loginMembers */
            $loginMembers = collect(json_decode($loginMembers));

            $value->loginMembersCount = $loginMembers->count();
        });

        $likeBests = Cache::get('cache:likeBests');

        return view('chattingList', compact('chattings', 'likeBests'));
    }

    public function create_page()
    {
        return view('createPage');
    }

}
