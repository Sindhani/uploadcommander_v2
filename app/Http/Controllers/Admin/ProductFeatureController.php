<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductFeatures;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ProductFeatureController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:productfeatures-list|productfeatures-create|productfeatures-edit|productfeatures-delete', ['only' => ['index','show']]);
        $this->middleware('permission:productfeatures-create', ['only' => ['create','store']]);
        $this->middleware('permission:productfeatures-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:productfeatures-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = ProductFeatures::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                /*->addColumn('is_active', function ($row) {
                    if($row->is_active=='Yes') {
                        $btn = '<button class="btn btn-danger -btn-small" onclick="location.href=\''.url('admin/productfeature/activedeactive/'.$row->id.'/No').'\'">Deactivate</button>';
                    } else {
                        $btn = '<button class="btn btn-primary -btn-small" onclick="location.href=\''.url('admin/productfeature/activedeactive/'.$row->id.'/Yes').'\'">Activate</button>';
                    }

                    return $btn;
                })*/
                ->addColumn('product_type', function ($row) {
                    if($row->product_type) {
                        return productType($row->product_type);
                    } else {
                        return '';
                    }

                })
                ->addColumn('action', function ($row) {
                    if($row->is_active=='Yes') {
                        $btn = '<a href="'.url('admin/productfeature/activedeactive/'.$row->id.'/No').'" class="danger" onclick="return confirm(\'Are you sure to deactivate this feature?\')"><i class="la la-times"></i> </a>&nbsp;&nbsp;';
                    } else {
                        $btn = '<a href="'.url('admin/productfeature/activedeactive/'.$row->id.'/Yes').'" onclick="return confirm(\'Are you sure to activate this feature?\')"><i class="la la-check"></i> </a>&nbsp;&nbsp;';
                    }
                    $btn .= '<a href="'.url('admin/productfeature/'.$row->id.'/edit').'" class=""><i class="icon-pencil"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('admin/productfeature/destroy/'.$row->id).'" class="danger" onclick="return confirm(\'Are you sure to delete?\')"><i class="icon-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action','is_active'])
                ->make(true);
        }
        return view('admin.productfeature.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arrOfProductType = productType();
        return view('admin.productfeature.create',compact('arrOfProductType'));
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
            'name'=>'required',
            'product_type'=>'required',
            'version' => 'required',
        ]);

        $input = $request->all();

        if(!$request->input('is_active')) {
            $input['is_active'] = 'No';
        }

        ProductFeatures::create($input);

        return redirect()->to('admin/productfeature')
            ->with('success','Product feature created successfully');
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
        $arrOfProductType = productType();
        $productFeatures = ProductFeatures::find($id);
        return view('admin.productfeature.edit',compact('productFeatures','arrOfProductType'));
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
            'name'=>'required',
            'product_type'=>'required',
            'version' => 'required',
        ]);

        $input = $request->all();

        if(!$request->input('is_active')) {
            $input['is_active'] = 'No';
        }

        $productFeatures = ProductFeatures::find($id);
        $productFeatures->update($input);

        return redirect()->to('admin/productfeature')
            ->with('success','Product feature updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductFeatures::find($id)->delete();
        return redirect()->to('admin/productfeature')
            ->with('success','Product feature deleted successfully');
    }

    public function activedeactive($id, $status)
    {
        $obj = ProductFeatures::find($id);
        $obj->is_active = $status;
        $obj->save();
        return redirect()->to('admin/productfeature')
            ->with('success','Product feature updated successfully');
    }
}
