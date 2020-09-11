<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CouponExport;
use App\Models\Coupon;
use App\Models\Packages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:coupon-list|coupon-create|coupon-edit|coupon-delete', ['only' => ['index','show']]);
        $this->middleware('permission:coupon-create', ['only' => ['create','store']]);
        $this->middleware('permission:coupon-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:coupon-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Coupon::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('coupon_type', function ($row){
                    return ucwords($row->coupon_type);
                })
                ->addColumn('status', function ($row){
                    return ucwords($row->status);
                })
                ->addColumn('coupon_value', function ($row){
                    if($row->coupon_type=='percentage') {
                        return $row->coupon_value.'%';
                    }
                    if($row->coupon_type=='absolute') {
                        return $row->coupon_value.' €';
                    }
                })
                ->addColumn('package', function ($row){
                    if($row->package_id) {
                        return $row->packages()->first()->subscription_name;
                    }
                    return null;
                })
                ->addColumn('valid_from', function ($row){
                    $date = null;
                    if(strtotime($row->coupon_from_date)>0) {
                        $date = date('m/d/Y',strtotime($row->coupon_from_date));
                    }
                    if(strtotime($row->coupon_from_time) > 0) {
                        $date .= ' '.date('h:i A',strtotime($row->coupon_from_time));
                    }
                    return $date;

                })
                ->addColumn('valid_to', function ($row){
                    $date = null;
                    if(strtotime($row->coupon_to_date)>0) {
                        $date = date('m/d/Y',strtotime($row->coupon_to_date));
                    }
                    if(strtotime($row->coupon_to_time) > 0) {
                        $date .= ' '.date('h:i A',strtotime($row->coupon_to_time));
                    }
                    return $date;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="'.url('admin/coupon/'.$row->id.'/edit').'" class=""><i class="icon-pencil"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('admin/coupon/destroy/'.$row->id).'" class="danger" onclick="return confirm(\'Are you sure to delete?\')"><i class="icon-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $couponCodeType = couponCodeType();
        $couponType = couponType();
        $packages = Packages::pluck('subscription_name','id');
        $packages->prepend('Select Package','');
        return view('admin.coupon.create',compact('couponCodeType','couponType','packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if($request->input('coupon_type')=='percentage') {
            $couponValue = str_replace('%','',$request->input('percentage'));
        } else {
            $couponValue = $request->input('amount');
        }

        $status = 'active';
        if(!$request->input('status')) {
            $status = 'inactive';
        }

        if($request->input('coupon_code_type')=='automatic')
        {
            $noOfCoupon = $request->input('no_of_coupon');
            $couponCode = '';
            for($i=1; $i<=$noOfCoupon; $i++)
            {
                $code = generate_code();

                $couponCode .= $code."\n";

                $data = [
                    'coupon_code_type'=>'automatic',
                    'no_of_coupon'=>$noOfCoupon,
                    'coupon_code'=>strtoupper($code),
                    'coupon_type'=>$request->input('coupon_type'),
                    'coupon_value'=>$couponValue,
                    'coupon_from_date'=>$request->input('coupon_from_date'),
                    'coupon_to_date'=>$request->input('coupon_to_date'),
                    'coupon_from_time'=>$request->input('coupon_from_time'),
                    'coupon_to_time'=>$request->input('coupon_to_time'),
                    'package_id'=>$request->input('package_id'),
                    'coupon_code_used'=>$request->input('coupon_code_used'),
                    'status'=>$status
                ];
                Coupon::create($data);
            }
        }
        else
        {
            $data = [
                'coupon_code_type'=>'manual',
                'no_of_coupon'=>0,
                'coupon_code'=>$request->input('coupon_code'),
                'coupon_type'=>$request->input('coupon_type'),
                'coupon_value'=>$couponValue,
                'coupon_from_date'=>$request->input('coupon_from_date'),
                'coupon_to_date'=>$request->input('coupon_to_date'),
                'coupon_from_time'=>$request->input('coupon_from_time'),
                'coupon_to_time'=>$request->input('coupon_to_time'),
                'package_id'=>$request->input('package_id'),
                'coupon_code_used'=>$request->input('coupon_code_used'),
                'status'=>$status
            ];
            Coupon::create($data);
        }

        return redirect()->to('admin/coupon')
            ->with('success','Coupon created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $couponCodeType = couponCodeType();
        $couponType = couponType();
        $packages = Packages::pluck('subscription_name','id');
        $packages->prepend('Select Package','');
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit',compact('couponCodeType','couponType','packages', 'coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);

        $input = $request->all();

        if($coupon->coupon_code_type == 'automatic') {
            $input['coupon_code'] = $request->input('coupon_code1');
        }

        if($request->input('coupon_type')=='percentage') {
            $input['coupon_value'] = str_replace('%','',$request->input('percentage'));
        } else {
            $input['coupon_value'] = $request->input('amount');
        }

        if(!$request->input('status')) {
            $input['status'] = 'inactive';
        }

        /*echo '<pre>';
        print_r($input);
        exit;*/

        $coupon->update($input);

        return redirect()->to('admin/coupon')
            ->with('success','Coupon update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::find($id)->delete();
        return redirect()->to('admin/coupon')
            ->with('success','Coupon deleted successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadData()
    {
        $arr = (object) [
            'coupon_code_type'=>'11',
            'coupon_code'=>'22'
        ];
        //return Excel::download($arr, 'coupon.xlsx');
        return Excel::download(new CouponExport, 'coupon.xlsx');
    }

}
