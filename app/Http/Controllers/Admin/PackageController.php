<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Packages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:package-list|package-create|package-edit|package-delete', ['only' => ['index','show']]);
        $this->middleware('permission:package-create', ['only' => ['create','store']]);
        $this->middleware('permission:package-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:package-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Packages::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="'.url('admin/package/'.$row->id.'/edit').'" class=""><i class="icon-pencil"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('admin/package/destroy/'.$row->id).'" class="danger" onclick="return confirm(\'Are you sure to delete?\')"><i class="icon-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.package.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'subscription_name'=>'required',
            'social_account_limit' => 'required',
            'file_storage_size' => 'required',
            'file_size' => 'required',
            'monthly_pricing' => 'required',
            'yearly_pricing' => 'required',
        ]);

        $input = $request->all();

        Packages::create($input);

        return redirect()->to('admin/package')
            ->with('success','Package created successfully');
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
        $package = Packages::find($id);

        return view('admin.package.edit',compact('package'));
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
        $this->validate($request, [
            'subscription_name'=>'required',
            'social_account_limit' => 'required',
            'file_storage_size' => 'required',
            'file_size' => 'required',
            'monthly_pricing' => 'required',
            'yearly_pricing' => 'required',
        ]);

        $input = $request->all();

        $package = Packages::find($id);
        $package->update($input);

        return redirect()->to('admin/package')
            ->with('success','Package update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkPackage = Customer::where('package_id',$id)->count();
        $checkCouponPackage = Coupon::where('package_id',$id)->count();
        if($checkPackage || $checkCouponPackage) {
            return redirect()->to('admin/package')
                ->with('danger','Package can not be deleted successfully. Package is in used.');
        } else {
            Packages::find($id)->delete();
            return redirect()->to('admin/package')
                ->with('success','Package deleted successfully');
        }


    }
}
