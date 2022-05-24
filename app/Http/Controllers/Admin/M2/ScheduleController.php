<?php

namespace App\Http\Controllers\Admin\M2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use View;
use App\Setting;
use App\Classes;
use App\ClassSchedule;
use App\User;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $columns = [
                0 => '',
                1 => 'start_date',
                2 => '',
                3 => '',
                4 => '',
                5 => '',
                6 => '',
                7 => ''
            ];
            $weekdays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

            $totalData = ClassSchedule::whereModule(2)
                ->where(function ($query) {
                    $query->where('end_date', '>=', Carbon::now()->format('Y-m-d H:i:s'));
                })
                ->count();
            $totalFiltered = $totalData;

            $limit = $request->length;
            $start = $request->start;

            $query = ClassSchedule::whereModule(2)
                ->where(function ($query) {
                    $query->where('end_date', '>=', Carbon::now()->format('Y-m-d H:i:s'));
                })
                ->orderBy('start_date', 'ASC');

            $query_filtered = clone($query);

            $items = $query
                ->offset($start)
                ->limit($limit)
                ->get();

            $totalFiltered = $query_filtered->count();

            $data = array();
            foreach ($items as $key => $item) {
                $nestedData['id'] = $key + 1;
                $nestedData['date'] = $item->disp_date;
                $nestedData['time'] = $item->disp_time;
                $nestedData['weekday'] = ucfirst($weekdays[$item->weekday]);
                $nestedData['coach'] = $item->coach->full_name;
                $nestedData['status'] = $item->status == 1 ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                $nestedData['options'] = (string)View::make('admin.m2.schedule.options-template', ['schedule' => $item])->render();

                $data[] = $nestedData;
            }

            $json_data = [
                "draw" => intval($request->draw),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                'data' => $data
            ];

            return response()->json($json_data);

        } else {
            $setting = Setting::find(1);
            $working_days = $setting->working_days;
            $class = Classes::whereModule(2)->first();
            $coaches = User::whereType(2)->whereNotIn('coach_type', [3])->orderBy('first_name', 'ASC')->get();
            $slots = $this->getTimeSlots($setting->start_time, $setting->end_time);

            return View('admin.m2.schedule.index', compact('class', 'coaches', 'working_days', 'slots'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $weekdays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $created_by = auth()->user()->id;

        if ($request->start_date != '' && $request->end_date != '') {
            $schedule_date = $request->start_date;
            $end_date = $request->end_date;

            $class = Classes::whereModule(2)->first();

            while (Carbon::parse($end_date)->greaterThanOrEqualTo(Carbon::parse($schedule_date))) {
                $weekday_num = Carbon::parse($schedule_date)->format('w');
                $weekday = $weekdays[$weekday_num];

                $status = $weekday . '_status';

                if (isset($request->{$weekday}) && $request->{$weekday} == $weekday_num) {
                    if (isset($request->{$weekday . '_time'}) && $request->{$weekday . '_time'} != '' && isset($request->{$weekday . '_coach'}) && count($request->{$weekday . '_coach'}) > 0) {

                        //create schedule for each coach
                        foreach ($request->{$weekday . '_coach'} as $key => $coach_id) {
                            $classSchedule = new ClassSchedule();
                            $classSchedule->weekday = $weekday_num;
                            $classSchedule->module = 2;
                            $classSchedule->coach_id = $coach_id;
                            $classSchedule->num_seats = $class->num_seats;

                            if ($schedule_date) {//set start and end date
                                $classSchedule->start_date = $schedule_date . ' ' . $request->{$weekday . '_time'};
                                $classSchedule->end_date = $schedule_date . ' ' . Carbon::parse($request->{$weekday . '_time'})->addMinutes($request->duration)->subSeconds(1)->format('H:i:s');
                            }

                            $classSchedule->status = $request->{$status};
                            $classSchedule->created_by = $created_by;
                            $class->classSchedules()->save($classSchedule);
                        }
                    }
                }
                $schedule_date = Carbon::parse($schedule_date)->addDay()->format('Y-m-d');
            }
        }

        return response()->json(['status' => 'ok', 'msg' => 'Schedule created successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassSchedule $schedule)
    {
        $schedule->start_time = Carbon::parse($schedule->start_date)->format('H:i:s');
        $schedule->update_url = route('admin.m2.schedule.update', [$schedule]);
        return response()->json($schedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassSchedule $schedule)
    {
        $schedule->weekday = Carbon::parse($request->schedule_date)->format('w');
        $schedule->start_date = $request->schedule_date . ' ' . $request->start_time;
        $schedule->end_date = $request->schedule_date . ' ' . Carbon::parse($request->start_time)->addMinutes($schedule->classes->duration)->subSeconds(1)->format('H:i:s');
        $schedule->coach_id = $request->coach_id;
        $schedule->status = $request->status;
        $schedule->save();

        return response()->json(['status' => 'ok', 'msg' => 'Schedule updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassSchedule $schedule)
    {
        $schedule->delete();

        return response()->json(['status' => 'ok', 'msg' => 'Schedule deleted successfully']);
    }

    public function getTimeSlots($start_time, $end_time)
    {
        $setting = Setting::find(1);

        $time_slots = [];

        $time = $start_time;
        while ($time < $end_time) {
            array_push($time_slots, [$time, Carbon::parse($time)->format('h:i A')]);

            $time = Carbon::parse($time)->addMinutes($setting->min_slot_duration)->format('H:i:s');
        }

        return $time_slots;
    }
}
