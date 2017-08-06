<?php

namespace App\Http\Controllers;

use App\Page;
use App\PageSsul;
use App\Ssul;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function pageSetting($id)
    {
        $page = Page::with('ssuls')->withCount('ssuls')->with('ssuls')->findOrFail($id);
        /** @var Collection $admins */
        $admins = $page->admin;


        if (Auth::user()->name == "ost") {
            $admin = true;
        } elseif (!$admins->where('name', Auth::user()->name)->isEmpty()) {
            $admin = true;
        } else {
            abort(404);
        }


        return view('setting.console', compact('page', 'admin'));
    }

    public function chattingCreate($id)
    {
        $page = Page::with('ssuls')->withCount('ssuls')->with('ssuls')->findOrFail($id);
        /** @var Collection $admins */
        $admins = $page->admin;


        if (Auth::user()->name == "ost") {
            $admin = true;
        } elseif (!$admins->where('name', Auth::user()->name)->isEmpty()) {
            $admin = true;
        } else {
            abort(404);
        }

        return view('setting.chatting_create', compact('page', 'admin'));
    }

    public function chattingCreatePost(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        try {


            /** @var Ssul $newInputSsul */
            $newInputSsul = Ssul::where('name', $request->create_chatting)->firstOrFail();
        } catch (ModelNotFoundException $e){
            $newSsul = new Ssul();
            $newSsul->name = $request->create_chatting;
            $newSsul->picture = "/images/gallery_img-4.jpg";
            $newSsul->save();
            $newInputSsul = $newSsul;
        }

        if (!PageSsul::where('page_id', $id)->where('ssul_id', $newInputSsul->id)->get()->isEmpty()) {
            session()->flash('create_chatting', "이미 이 페이지에 존재하는 채팅방 입니다");
            return redirect()->back();
        }

        /** @var PageSsul $newPageSsul */
        $newPageSsul = new PageSsul();
        $newPageSsul->page_id = $page->id;
        $newPageSsul->ssul_id = $newInputSsul->id;
        $newPageSsul->save();

        return redirect()->back();

    }

    public function chattingCreateDelete(Request $request, $id)
    {

        PageSsul::where('page_id', $id)->where('ssul_id', $request->ssul_id)->delete();
    }
}
