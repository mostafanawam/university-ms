<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

use Calendar;
class FullCalenderController extends Controller
{
  public function getcalendar(Request $request)//calendat to student only view
  {
    if($request->ajax()) {
         $data = Event::whereDate('start', '>=', $request->start)

                   ->whereDate('end',   '<=', $request->end)

                   ->get(['id', 'title', 'start', 'end']);
         return response()->json($data);
    }

    return view('student.calendar');

  }
  public function index(Request $request)//caledner to admin where he can update
{
  if($request->ajax()) {
       $data = Event::whereDate('start', '>=', $request->start)

                 ->whereDate('end',   '<=', $request->end)

                 ->get(['id', 'title', 'start', 'end']);
       return response()->json($data);
  }

  return view('admin.calender');
}
public function ajax(Request $request)

{
    switch ($request->type) {
       case 'add':
          $event = Event::create([
              'title' => $request->title,
              'start' => $request->start,
              'end' => $request->end,
          ]);
          return response()->json($event);
         break;

       case 'update':
          $event = Event::find($request->id)->update([
              'title' => $request->title,
              'start' => $request->start,
              'end' => $request->end,
          ]);
          return response()->json($event);
         break;
       case 'delete':
          $event = Event::find($request->id)->delete();
          return response()->json($event);
         break;
       default:

         # code...

         break;

    }

}
}
