<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\NewsTopic;
use App\Models\NewsDataFlow;
use Log;
use Storage;

class EditController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function edit(Request $request) {
        Log::info($request);
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
    
    public function edit_save(Request $request) {
        Log::info("edit_save");
        Log::info($request->id);
        Log::info($request->name);
        Log::info($request->abstract);
        $file = $request->file("picture");
        if($request->hasFile("picture")) {
            Log::info("hasFile");
            if($file->isValid()) {
                Log::info("isValid");
                $originalName = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();
                $type = $file->getClientMimeType();
                $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                var_dump($bool);
                Log::info($originalName);
                Log::info($ext);
                Log::info($realPath);
                Log::info($type);
                Log::info($filename);
            }
        } else {
            Log::info("no file");
        }
    }

}

function getTopics($sub_str) {
    return NewsTopic::paginate(10);
}

function getFeeds($sub_str) {
    return NewsDataFlow::paginate(10);
}
