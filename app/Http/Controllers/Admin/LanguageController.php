<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\DataTables;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Language::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if($row->status=='active') {
                        $btn = '<a href="'.url('admin/language/activedeactive/'.$row->id.'/inactive').'" class="danger" onclick="return confirm(\'Are you sure to deactivate this feature?\')"><i class="la la-times"></i> </a>&nbsp;&nbsp;';
                    } else {
                        $btn = '<a href="'.url('admin/language/activedeactive/'.$row->id.'/active').'" onclick="return confirm(\'Are you sure to activate this feature?\')"><i class="la la-check"></i> </a>&nbsp;&nbsp;';
                    }
                    $btn .= '<a href="'.url('admin/language/'.$row->id.'/edit').'" class=""><i class="icon-pencil"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('admin/language/destroy/'.$row->id).'" class="danger" onclick="return confirm(\'Are you sure to delete?\')"><i class="icon-trash"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('admin/variable/'.$row->id).'" class=""><i class="icon-eye"></i> </a>&nbsp;&nbsp;';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.language.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arrOfCountryCode = getCountryCode();

        return view('admin.language.create',['arrOfCountryCode'=>$arrOfCountryCode]);
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
            'language_name'=>'required',
            'country_code' => 'required',
        ]);

        $input = $request->all();

        if(!$request->input('status')) {
            $input['status'] = 'inactive';
        }
        $language = Language::create($input);

        $vars = Lang::get('messages');
        $arrOfVars = [];
        foreach($vars as $name=>$val) {
            $arrOfVars[] = array(
                'language_id'=>$language->id,
                'name'=>$name,
                'text'=>$val
            );
        }
        $language->variables()->insert($arrOfVars);

        return redirect()->to('admin/language')
            ->with('success','Language created successfully');
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
        $arrOfCountryCode = getCountryCode();
        $language = Language::find($id);
        return view('admin.language.edit',compact('language','arrOfCountryCode'));
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
            'language_name'=>'required',
            'country_code' => 'required',
        ]);

        $input = $request->all();

        if(!$request->input('status')) {
            $input['status'] = 'inactive';
        }

        $language = Language::find($id);
        $language->update($input);

        return redirect()->to('admin/language')
            ->with('success','Language updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Language::find($id)->delete();
        return redirect()->to('admin/language')
            ->with('success','Language deleted successfully');
    }

    public function activedeactive($id, $status)
    {
        $obj = Language::find($id);
        $obj->status = $status;
        $obj->save();
        return redirect()->to('admin/language')
            ->with('success','Language updated successfully');
    }

}
