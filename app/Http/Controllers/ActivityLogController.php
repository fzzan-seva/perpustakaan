<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $items = ActivityLog::with('user')->latest()->search($search)->paginate(15);

        return view('activity-log.index', compact('items', 'search'));
    }
}
