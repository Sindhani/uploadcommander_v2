<?php

namespace App\Http\Controllers\Admin;

use App\Models\SystemSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemSettingController extends Controller
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
        $settings = SystemSettings::find($id);
        return view('admin.system_settings.edit',compact('settings'));
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
            'logo'=>'nullable|mimes:jpeg,png,jpg|max:1024',
            'favicon'=>'nullable|image|mimes:png,ico|max:1024',
        ]);

        $input = $request->all();

        $settings = SystemSettings::find($id);

        if($request->input('maintenance_mode')==0) {
            $input['maintenance_mode'] = 0;
        } else {
            $input['maintenance_mode'] = 1;
        }

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $logoName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/systemsettings');
            $image->move($destinationPath, $logoName);
        } else {
            $logoName = $settings->logo;
        }

        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $faviconName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/systemsettings');
            $image->move($destinationPath, $faviconName);
        } else {
            $faviconName = $settings->logo;
        }

        $input['logo'] = $logoName;
        $input['favicon'] = $faviconName;

        $settings->update($input);

        return redirect()->to('admin/system_settings/'.$id.'/edit')
            ->with('success','System settings updated successfully');
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
