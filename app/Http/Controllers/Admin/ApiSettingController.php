<?php

namespace App\Http\Controllers\Admin;

use App\Models\ApiSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiSettingController extends Controller
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
        $environment = ['sandbox'=>'Sandbox','live'=>'Live'];
        $settings = ApiSettings::find($id);
        return view('admin.api_setting.edit',compact('settings','environment'));
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
        $input = $request->all();

        if(!$request->input('stripe_enable_recurring_payment')) {
            $input['stripe_enable_recurring_payment'] = 'No';
        }

        if(!$request->input('paypal_enable_subscription')) {
            $input['paypal_enable_subscription'] = 'No';
        }

        if(!$request->input('enable_recaptcha')) {
            $input['enable_recaptcha'] = 'No';
        }

        $api = ApiSettings::find($id);
        $api->update($input);

        return redirect()->to('admin/api_setting/'.$id.'/edit')
            ->with('success','API settings updated successfully');

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
