<?php

namespace App\Http\Controllers\Admin;

use App\Models\Variables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $variables = Variables::where('language_id', $id)->get();
        return view('admin.variable.show',['variables'=>$variables, 'id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        /*echo '<pre>';
        print_r($request->input('var'));
        exit;*/

        $arrOfVars = $request->input('var');
        if(!empty($arrOfVars) && count($arrOfVars)>0) {
            foreach($arrOfVars as $varId=>$varVal) {
                $objVar = Variables::find($varId);
                $objVar->text = $varVal;
                $objVar->update();
            }
        }

        return redirect()->to('admin/variable/'.$id)
            ->with('success','Variable updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
