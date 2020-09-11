<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\HelpDesk;
use Auth;

class HelpDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helpdesk = HelpDesk::all();
        $children = HelpDesk::where('is_menu',0)->get();
        // dd($creater);
        return view('admin.helpdesk.index', compact('helpdesk','children'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $helpdesk = HelpDesk::where('is_menu',1)->get();
        return view('admin.helpdesk.create',compact('helpdesk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if(isset($request->is_menu)){

            $validation = Validator::make($request->all(), [
              'description' => 'required'
             ]);
            if($validation->passes()){
                $menu = $request->is_menu;
                $description = $request->description;
                $active = $request->is_active;
                if($menu == 'on'){
                    $is_menu = 1;
                }else{
                    $is_menu = 0;
                }

                if($active == 'on'){
                    $is_active = 1;
                }else{
                    $is_active = 0;
                }
                $creater = Auth::user()->first_name;

                HelpDesk::create(['is_menu'=>$is_menu, 'description'=>$description, 'creater'=>$creater, 'is_active'=>$is_active]);
                // dd($request->all());
                return response()->json([
                   'message' => 'Entry Added Successfully'
                ]);
            }else{
                return response()->json([
                   'error'   => $validation->errors()->all()
                  ]);
            }

        }else{
            $validation = Validator::make($request->all(), [
              'linked_page' => 'required',
              'assignment' => 'required',
              'description' => 'required',
              'content' => 'required',
             ]);
            if($validation->passes()){
                $linked_page = $request->linked_page;
                $assignment = $request->assignment;
                $description = $request->description;
                $content = $request->content;
                $active = $request->is_active;
                $is_menu = 0;
                if($active == 'on'){
                    $is_active = 1;
                }else{
                    $is_active = 0;
                }
                $creater = Auth::user()->first_name;

                HelpDesk::create(['is_menu'=>$is_menu, 'linked_page'=>$linked_page, 'assignment'=>$assignment,'description'=>$description, 'content'=>$content, 'creater'=>$creater,'is_active'=>$is_active]);
                // dd($request->all());
                return response()->json([
                   'message' => 'Entry Added Successfully'
                ]);
            }else{
                return response()->json([
                   'error'   => $validation->errors()->all()
                  ]);
            }

        }
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
    public function edit(Request $request, $id)
    {
        $helpdesk = HelpDesk::where('is_menu',1)->get();

        if(isset($request->edit)){
            if($request->edit == '1'){
                // dd('menu edit');
                $menu_edit = 'yes';
                $menu = HelpDesk::where('id',$id)->first();
                
                return view('admin.helpdesk.edit',compact('menu_edit','menu','helpdesk'));

            }else if($request->edit == '0'){
                 // dd('child edit');
                $child_edit = 'yes';
                $menu = HelpDesk::where('id',$id)->first();
                
                return view('admin.helpdesk.edit',compact('child_edit','menu','helpdesk'));
            }
        }
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
        if(isset($request->menu_id)){
            $validation = Validator::make($request->all(), [
              'description' => 'required'
             ]);
             if($validation->passes()){
                $menu_id = $request->menu_id;
                $active = $request->is_active;
                if($active == 'on'){
                    $is_active = 1;
                }else{
                    $is_active = 0;
                }
                $old_description = HelpDesk::where('id',$menu_id)->first();

                HelpDesk::where('is_menu',0)->where('assignment',$old_description->description)->update(['is_active'=>$is_active, 'assignment'=>$request->description]);

                HelpDesk::where('id',$menu_id)->update(['description'=>$request->description,'is_active'=>$is_active]);
                // if($is_active == '0'){
                //     HelpDesk::where('is_menu',0)->where('assignment',$request->description)->update(['is_active'=>$is_active]);
                // }
                 return response()->json([
                   'message'   => 'Entry Updated Successfully.'
                  ]);
            }else{
                return response()->json([
                   'error'   => $validation->errors()->all()
                  ]);
            }

        }else if($request->child_id){
            $validation = Validator::make($request->all(), [
              'linked_page' => 'required',
              'assignment' => 'required',
              'description' => 'required',
              'content' => 'required',
             ]);
            if(isset($request->child_id)){
                $child_id = $request->child_id;
                // dd('child',$request->all());
                $active = $request->is_active;
                if($active == 'on'){
                    $is_active = 1;
                }else{
                    $is_active = 0;
                }

                HelpDesk::where('id',$child_id)->update(['linked_page'=>$request->linked_page, 'assignment'=>$request->assignment, 'content'=>$request->content, 'description'=>$request->description,'is_active'=>$is_active]);
                 return response()->json([
                   'message'   => 'Entry Updated Successfully.'
                  ]);
            }else{
                return response()->json([
                   'error'   => $validation->errors()->all()
                  ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(isset($request->delete_menu)){
            if($request->delete_menu == 'menu'){
                $data_id = $request->data_id;
                $menu = HelpDesk::where('id',$data_id)->where('is_menu',1)->first();
                HelpDesk::where('assignment',$menu->description)->where('is_menu',0)->delete();
                HelpDesk::where('id',$data_id)->where('is_menu',1)->delete();

                 return response()->json([
                   'message'   => 'Entry Deleted Successfully.'
                  ]);
            }else if($request->delete_menu == 'child'){
                $data_id = $request->data_id;

                HelpDesk::where('id',$data_id)->where('is_menu',0)->delete();

                 return response()->json([
                   'message'   => 'Entry Deleted Successfully.'
                  ]);
            }
        }

    }

    public function makeActive(Request $request){
        // dd('make active', $request->all());
        if($request->data_status == 'menu'){
            $data_id = $request->data_id;
            HelpDesk::where('id',$data_id)->where('is_menu',1)->update(['is_active'=>1]);
            return response()->json([
               'message'   => 'Status Changed Successfully.'
              ]);
        }else if($request->data_status == 'child'){
            $data_id = $request->data_id;
            HelpDesk::where('id',$data_id)->where('is_menu',0)->update(['is_active'=>1]);
            return response()->json([
               'message'   => 'Status Changed Successfully.'
              ]);
        }

    }

    public function makeInActive(Request $request){
        // dd('make inactive', $request->all());
        if($request->data_status == 'menu'){
            $data_id = $request->data_id;
            HelpDesk::where('id',$data_id)->where('is_menu',1)->update(['is_active'=>0]);
            return response()->json([
               'message'   => 'Status Changed Successfully.'
              ]);
        }else if($request->data_status == 'child'){
            $data_id = $request->data_id;
            HelpDesk::where('id',$data_id)->where('is_menu',0)->update(['is_active'=>0]);
            return response()->json([
               'message'   => 'Status Changed Successfully.'
              ]);
        }
    }
}
