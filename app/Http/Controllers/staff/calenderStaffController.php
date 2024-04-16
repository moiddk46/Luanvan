<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\calendarModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class calenderStaffController extends Controller
{
    public $title;
    public function __construct()
    {
        $this->title = 'Lịch làm việc';
    }
    public function home(Request $request)
    {
        $title = $this->title;
        return view('Pages.Staff.Calender', compact('title'));
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request): JsonResponse
    {
 
        switch ($request->type) {
           case 'add':
              $event = calendarModel::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = calendarModel::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = calendarModel::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
}
