<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailTemplates;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = EmailTemplates::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if($row->is_active=='Yes') {
                        $btn = '<a href="'.url('admin/email_template/activedeactive/'.$row->id.'/No').'" class="danger" onclick="return confirm(\'Are you sure to deactivate this feature?\')"><i class="la la-times"></i> </a>&nbsp;&nbsp;';
                    } else {
                        $btn = '<a href="'.url('admin/email_template/activedeactive/'.$row->id.'/Yes').'" onclick="return confirm(\'Are you sure to activate this feature?\')"><i class="la la-check"></i> </a>&nbsp;&nbsp;';
                    }
                    $btn .= '<a href="'.url('admin/email_template/'.$row->id.'/edit').'" class=""><i class="icon-pencil"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('admin/email_template/destroy/'.$row->id).'" class="danger" onclick="return confirm(\'Are you sure to delete?\')"><i class="icon-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.email_template.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.email_template.create');
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
            'template_name'=>'required',
            'subject' => 'required',
            'email_body' => 'required',
        ]);

        $input = $request->all();

        if(!$request->input('is_active')) {
            $input['is_active'] = 'No';
        }

        EmailTemplates::create($input);

        return redirect()->to('admin/email_template')
            ->with('success','Email template created successfully');
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
        $emailTemplate = EmailTemplates::find($id);
        return view('admin.email_template.edit',compact('emailTemplate'));
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
            'template_name'=>'required',
            'subject' => 'required',
            'email_body' => 'required',
        ]);

        $input = $request->all();

        if(!$request->input('is_active')) {
            $input['is_active'] = 'No';
        }

        $email = EmailTemplates::find($id);
        $email->update($input);

        return redirect()->to('admin/email_template')
            ->with('success','Email template updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmailTemplates::find($id)->delete();
        return redirect()->to('admin/email_template')
            ->with('success','Email template deleted successfully');
    }

    public function activedeactive($id, $status)
    {
        $obj = EmailTemplates::find($id);
        $obj->is_active = $status;
        $obj->save();
        return redirect()->to('admin/email_template')
            ->with('success','Email template updated successfully');
    }

}

