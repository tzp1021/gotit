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
        $action = $request->input('action', 'home');
        switch($action) {
            case 'home':
                return view('edit.edit');
            case 'indexTopicList':
                return view('edit.indexTopicList');
            case 'queryTopicList':
                return getTopics($request->input('key', ''));
            case 'indexDataFlow':
                return view('edit.indexDataFlow');
            case 'queryDataFlow':
                return getFeeds('');
            default:
                echo 'page is not found';
        }
    }
    
    public function edit_save(Request $request) {
        switch($request->action) {
            case 'updateTopic':
                return updateTopic($request);
            case 'updateTopicStatus':
                return updateTopicStatus($request);
            case 'updateFeed':
                return updateFeed($request);
            case 'updateFeedStatus':
                return updateFeedStatus($request);
            default:
                return paramIllegal();
        }
    }

}

function getTopics($sub_str) {
    Log::info('getTopics');
    Log::info($sub_str);
    $res = NewsTopic::where('name', 'LIKE', '%'.$sub_str.'%')->paginate(10);
    return $res;
}

function getFeeds($sub_str) {
    Log::info('getFeeds');
    $res = NewsDataFlow::paginate(10);
    Log::info($res);
    return $res;
}

function updateTopic($request) {
    Log::info("updateTopic");
    Log::info($request->id);
    Log::info($request->name);
    Log::info($request->abstract);
    $file = $request->file("picture");
    $url = $request->icon_url;
    Log::info($url);
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
            Log::info($filename);
            if($bool) {
                Log::info(Storage::disk('uploads')->url($filename));
                $url = Storage::disk('uploads')->url($filename);
            }
        }   
    } else {
        Log::info("no file");
    }   
    if($request->id == '') {
        Log::info("new");
        $topic = NewsTopic::create(['name' => $request->name, 'abstract' => $request->abstract, 'icon_url' => $url]);
        if(is_null($topic)) {
            //TODO error
        }
    } else {
        Log::info("edit");
        $res = NewsTopic::find($request->id)->update(['name' => $request->name, 'abstract' => $request->abstract, 'icon_url' => $url]);
        if($res) {
            $topic = NewsTopic::find($request->id);
        }
    }
    $data = array(
        'topic' => $topic,
    );
    return returnSucceed($data);
}

function updateFeed($request) {
    Log::info('updateFeed');
    $res = NewsDataFlow::find($request->id)->update(['title' => $request->title, 'source_url' => $request->source_url, 'video_source' => $request->video_source]);
    if($res) {
        $feed = NewsDataFlow::find($request->id);
    }
	$data = array(
        'feed' => $feed,
    );
    return returnSucceed($data);
}

function updateTopicStatus($request) {
    Log::info("updateTopicStatus");
    Log::info($request->id);
    Log::info($request->status);
    $res = NewsTopic::find($request->id)->update(['status' => $request->status]);
    if($res) {
        $data = array('status' => $request->status);
        return returnSucceed($data);
    }
    return returnError(2, 'update error');
}

function updateFeedStatus($request) {
   Log::info("updateFeedStatus");
    Log::info($request->id);
    Log::info($request->status);
    $res = NewsDataFlow::find($request->id)->update(['status' => $request->status]);
    if($res) {
        $data = array('status' => $request->status);
        return returnSucceed($data);
    }   
    return returnError(2, 'update error'); 
}

function returnSucceed($data) {
    $result = array(
        'errCode' => 0,
        'errMsg' => "Succeed",
        'data' => $data,
    );
    return json_encode($result);
}

function paramIllegal() {
    return returnError(1, "param illegal");
}

function returnError($code, $msg) {
    $result = array(
        'errCode' => $code,
        'errMsg' => $msg,
    );
    return json_encode($result);
}
