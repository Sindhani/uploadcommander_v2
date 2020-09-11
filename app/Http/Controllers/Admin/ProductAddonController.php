<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductAddons;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ProductAddonController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:productaddons-list|productaddons-create|productaddons-edit|productaddons-delete', ['only' => ['index','show']]);
        $this->middleware('permission:productaddons-create', ['only' => ['create','store']]);
        $this->middleware('permission:productaddons-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:productaddons-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = ProductAddons::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="'.url('admin/productaddon/'.$row->id.'/edit').'" class=""><i class="icon-pencil"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('admin/productaddon/destroy/'.$row->id).'" class="danger" onclick="return confirm(\'Are you sure to delete?\')"><i class="icon-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.productaddon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.productaddon.create');
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
            'addon_name'=>'required',
            //'social_account_limit' => 'required',
            //'file_storage_size' => 'required',
            'monthly_pricing' => 'required',
            'yearly_pricing' => 'required',
        ]);

        $input = $request->all();

        ProductAddons::create($input);

        return redirect()->to('admin/productaddon')
            ->with('success','Product addons created successfully');
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
        $productAddons = ProductAddons::find($id);
        return view('admin.productaddon.edit',compact('productAddons'));
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
            'addon_name'=>'required',
            //'social_account_limit' => 'required',
            //'file_storage_size' => 'required',
            'monthly_pricing' => 'required',
            'yearly_pricing' => 'required',
        ]);

        $input = $request->all();

        $productAddon = ProductAddons::find($id);
        $productAddon->update($input);

        return redirect()->to('admin/productaddon')
            ->with('success','Product addons updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductAddons::find($id)->delete();
        return redirect()->to('admin/productaddon')
            ->with('success','Product addons deleted successfully');
    }
}
