<?php

namespace App\Http\Controllers\Admin;

use App\Models\DocumentTemplates;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class DocumentTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DocumentTemplates::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if($row->is_active=='Yes') {
                        $btn = '<a href="'.url('admin/document_template/activedeactive/'.$row->id.'/No').'" class="danger" onclick="return confirm(\'Are you sure to deactivate this feature?\')"><i class="la la-times"></i> </a>&nbsp;&nbsp;';
                    } else {
                        $btn = '<a href="'.url('admin/document_template/activedeactive/'.$row->id.'/Yes').'" onclick="return confirm(\'Are you sure to activate this feature?\')"><i class="la la-check"></i> </a>&nbsp;&nbsp;';
                    }
                    $btn .= '<a href="'.url('admin/document_template/'.$row->id.'/edit').'" class=""><i class="icon-pencil"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('admin/document_template/destroy/'.$row->id).'" class="danger" onclick="return confirm(\'Are you sure to delete?\')"><i class="icon-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.document_template.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.document_template.create');
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

        DocumentTemplates::create($input);

        return redirect()->to('admin/document_template')
            ->with('success','Document template created successfully');
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
        $emailTemplate = DocumentTemplates::find($id);
        return view('admin.document_template.edit',compact('emailTemplate'));
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

        $email = DocumentTemplates::find($id);
        $email->update($input);

        return redirect()->to('admin/document_template')
            ->with('success','Document template updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DocumentTemplates::find($id)->delete();
        return redirect()->to('admin/document_template')
            ->with('success','Document template deleted successfully');
    }

    public function activedeactive($id, $status)
    {
        $obj = DocumentTemplates::find($id);
        $obj->is_active = $status;
        $obj->save();
        return redirect()->to('admin/document_template')
            ->with('success','Document template updated successfully');
    }

}
