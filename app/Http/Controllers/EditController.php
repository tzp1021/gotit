<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\NewsTopic;
use App\Models\NewsDataFlow;

class EditController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function edit(Request $request) {
        $table = $request->input('table', 'home');
        switch($table) {
            case 'home':
                $topics = getTopics('');
                return view('edit.edit', compact('topics'));
            case 'topics':
                $topics = getTopics('');
                return view('edit.edit-topics', compact('topics'));
            case 'feeds':
                $feeds = getFeeds('');
                return view('edit.edit-feed', compact('feeds'));
            default:
                echo 'page is not found';
        }
    }

}

function getTopics($sub_str) {
    return NewsTopic::paginate(10);
}

function getFeeds($sub_str) {
    return NewsDataFlow::paginate(10);
}
