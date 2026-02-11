<?php

namespace App\Http\Controllers\Backend;

use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use Lexx\ChatMessenger\Models\Message;
use Lexx\ChatMessenger\Models\Participant;
use Lexx\ChatMessenger\Models\Thread;
use Messenger;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        // Chat functionality disabled due to missing package
        return view('backend.messages.index-desktop', [
            'threads' => [],
            'teachers' => [],
            'thread' => ""
        ]);
    }

    public function send(Request $request)
    {
        return redirect()->back()->withFlashDanger('Chat function is currently disabled.');
    }

    public function reply(Request $request)
    {
        return redirect()->back()->withFlashDanger('Chat function is currently disabled.');
    }

    public function getUnreadMessages(Request $request)
    {
        if (!method_exists(auth()->user(), 'unreadMessagesCount')) {
            return ['unreadMessageCount' => 0, 'threads' => []];
        }
        $unreadMessageCount = auth()->user()->unreadMessagesCount();
        $unreadThreads = [];
        foreach (auth()->user()->threads as $item) {
            if ($item->userUnreadMessagesCount(auth()->user()->id)) {
                $data = [
                  'thread_id' => $item->id,
                  'message' => str_limit($item->messages()->orderBy('id', 'desc')->first()->body, 35),
                  'unreadMessagesCount' => $item->userUnreadMessagesCount(auth()->user()->id),
                  'title' => $item->participants()->with('user')->where('user_id', '<>', auth()->user()->id)->first()->user->name
                ];
                $unreadThreads[] = $data;
            }
        }
        return ['unreadMessageCount' =>$unreadMessageCount,'threads' => $unreadThreads];
    }
}
