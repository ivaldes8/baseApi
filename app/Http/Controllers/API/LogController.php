<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Log as LogResource;
use Validator;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function addToLog(Request $request){   
        $log = new UserActivity();
        $log->user_id = Auth::id();
        $log->action = $request->input('action');
        $log->data = $request->input('data');
        $log->save();
        return $this->sendResponse($log, 'Log created.');
    }

    public function logActivity()
    {
        $logs = UserActivity::all();
        return $this->sendResponse(LogResource::collection($logs), 'Logs fetched.');
    }

    public function logActivityByUser($id)
    {
        
        $logs = UserActivity::where('user_id', $id)->get();
        return $this->sendResponse($logs , 'Logs fetched.');
    }
}
