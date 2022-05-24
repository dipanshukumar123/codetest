<?php

namespace App\Http\Controllers\Admin\M2;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class CouponController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Coupon::whereModule(2)->whereType(1);

            if ($request->query('onlyTrashed')) {
                $query->onlyTrashed();
            }

            if ($request->query('status') == '0') {
                $query->where('status', $request->query('status'));
            } else {
                $query->where('status', 1);
            }

            if ($request->query('sort')) {
                $query->orderBy('created_at', $request->query('sort'));
            } else {
                $query->orderBy('created_at', 'desc');
            }

            $items = $query->get();

            $data = [];
            foreach ($items as $key => $item) {
                $nestedData['id'] = $key + 1;
                $nestedData['coupon'] = (string) View::make('admin.m2.coupon.coupon-template', ['coupon' => $item])->render();
                $nestedData['options'] = (string) View::make('admin.m2.coupon.options-template', ['coupon' => $item])->render();

                $data[$key] = $nestedData;
            }

            $json_data = [
                'draw' => $request->query('draw'),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => $data
            ];

            return response()->json($json_data);
        } else {
            return View('admin.m2.coupon.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.m2.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'code' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $exists = Coupon::whereModule(2)->whereCode($value)->exists();

                    if ($exists) {
                        $fail('Coupon code already exist');
                    }
                }
            ],
            'discount_type' => ['required', 'integer'],
            'discount' => ['required', 'string'],
            'start_date' => ['required', 'string'],
            'end_date' => ['required', 'string'],
            'total_usage' => ['required', 'integer'],
            'usage_per_user' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        // store
        $coupon = new Coupon();
        $coupon->module = 2;
        $coupon->type = 1;
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->total_usage = $request->total_usage;
        $coupon->usage_per_user = $request->usage_per_user;
        $coupon->status = $request->status;
        $coupon->save();

        return redirect()->route('admin.m2.coupon.index')->with('status', 'Coupon created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return View('admin.m2.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'code' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($coupon) {
                    $exists = Coupon::whereNotIn('id', [$coupon->id])->whereModule(2)->whereCode($value)->exists();

                    if ($exists) {
                        $fail('Coupon code already exist');
                    }
                }
            ],
            'discount_type' => ['required', 'integer'],
            'discount' => ['required', 'string'],
            'start_date' => ['required', 'string'],
            'end_date' => ['required', 'string'],
            'total_usage' => ['required', 'integer'],
            'usage_per_user' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        // update
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->total_usage = $request->total_usage;
        $coupon->usage_per_user = $request->usage_per_user;
        $coupon->status = $request->status;
        $coupon->save();

        return redirect()->route('admin.m2.coupons.index')->with('status', 'Coupon updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return back()->with('status', 'Coupon deleted successfully!');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param \App\Package $package
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        Coupon::withTrashed()->whereId($id)->restore();

        return back()->with('status', 'Coupon restored successfully!');
    }
}
