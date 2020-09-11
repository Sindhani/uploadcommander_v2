<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Faq;
use Auth;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all();
        $question = Faq::where('is_menu',0)->get();
        return view('admin.faqs.index', compact('faqs','question'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faqs = Faq::where('is_menu',1)->get();
        return view('admin.faqs.create',compact('faqs'));
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
                $supporrt_bot = $request->support_bot_use;
                if($supporrt_bot == 'on'){
                    $support_bot_use = 1;
                }else{
                    $support_bot_use = 0;
                }
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

                Faq::create(['is_menu'=>$is_menu, 'description'=>$description, 'creater'=>$creater, 'is_active'=>$is_active]);
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
                $supporrt_bot = $request->support_bot_use;
                $is_menu = 0;
                if($supporrt_bot == 'on'){
                    $support_bot_use = 1;
                }else{
                    $support_bot_use = 0;
                }
                if($active == 'on'){
                    $is_active = 1;
                }else{
                    $is_active = 0;
                }
                $creater = Auth::user()->first_name;

                Faq::create(['is_menu'=>$is_menu,'support_bot_use'=>$support_bot_use,'assignment'=>$assignment,'description'=>$description, 'content'=>$content, 'creater'=>$creater,'is_active'=>$is_active]);
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
        $faqs = Faq::where('is_menu',1)->get();
        
        if(isset($request->edit)){
            if($request->edit == '1'){
                // dd('menu edit');
                $menu_edit = 'yes';
                $menu = Faq::where('id',$id)->first();
                
                return view('admin.faqs.edit',compact('menu_edit','menu','faqs'));

            }else if($request->edit == '0'){
                 // dd('child edit');
                $child_edit = 'yes';
                $menu = Faq::where('id',$id)->first();

                
                return view('admin.faqs.edit',compact('child_edit','menu','faqs'));
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
        // dd($request->all());
        if(isset($request->menu_id)){
            $validation = Validator::make($request->all(), [
              'description' => 'required'
             ]);
             if($validation->passes()){
                $menu_id = $request->menu_id;
                $active = $request->is_active;
                $active = $request->is_active;
                $supporrt_bot = $request->support_bot_use;

                if($supporrt_bot == 'on'){
                    $support_bot_use = 1;
                }else{
                    $support_bot_use = 0;
                }

                if($active == 'on'){
                    $is_active = 1;
                }else{
                    $is_active = 0;
                }
                $old_description = Faq::where('id',$menu_id)->first();

                Faq::where('is_menu',0)->where('assignment',$old_description->description)->update(['is_active'=>$is_active, 'support_bot_use'=>$support_bot_use,'assignment'=>$request->description]);

                Faq::where('id',$menu_id)->update(['description'=>$request->description,'is_active'=>$is_active,'support_bot_use'=>$support_bot_use]);
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
              'assignment' => 'required',
              'description' => 'required',
              'content' => 'required',
             ]);
            if(isset($request->child_id)){
                $child_id = $request->child_id;
                $supporrt_bot = $request->support_bot_use;

                if($supporrt_bot == 'on'){
                    $support_bot_use = 1;
                }else{
                    $support_bot_use = 0;
                }

                $active = $request->is_active;
                if($active == 'on'){
                    $is_active = 1;
                }else{
                    $is_active = 0;
                }

                Faq::where('id',$child_id)->update(['assignment'=>$request->assignment, 'content'=>$request->content, 'description'=>$request->description,'is_active'=>$is_active,'support_bot_use'=>$support_bot_use]);
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
        // dd($id, $request->all());
        if(isset($request->delete_menu)){
            if($request->delete_menu == 'menu'){
                $data_id = $request->data_id;
                $menu = Faq::where('id',$data_id)->where('is_menu',1)->first();
                Faq::where('assignment',$menu->description)->where('is_menu',0)->delete();
                Faq::where('id',$data_id)->where('is_menu',1)->delete();

                 return response()->json([
                   'message'   => 'Entry Deleted Successfully.'
                  ]);
            }else if($request->delete_menu == 'child'){
                $data_id = $request->data_id;

                Faq::where('id',$data_id)->where('is_menu',0)->delete();

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
            Faq::where('id',$data_id)->where('is_menu',1)->update(['is_active'=>1]);
            return response()->json([
               'message'   => 'Status Changed Successfully.'
              ]);
        }else if($request->data_status == 'child'){
            $data_id = $request->data_id;
            Faq::where('id',$data_id)->where('is_menu',0)->update(['is_active'=>1]);
            return response()->json([
               'message'   => 'Status Changed Successfully.'
              ]);
        }

    }

    public function makeInActive(Request $request){
        // dd('make inactive', $request->all());
        if($request->data_status == 'menu'){
            $data_id = $request->data_id;
            Faq::where('id',$data_id)->where('is_menu',1)->update(['is_active'=>0]);
            return response()->json([
               'message'   => 'Status Changed Successfully.'
              ]);
        }else if($request->data_status == 'child'){
            $data_id = $request->data_id;
            Faq::where('id',$data_id)->where('is_menu',0)->update(['is_active'=>0]);
            return response()->json([
               'message'   => 'Status Changed Successfully.'
              ]);
        }
    }
}
