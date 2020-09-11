<?php

namespace App\Http\Controllers\Customer;

use App\Models\Feed;
use App\Models\LinkTree;
use App\Models\SocialLinks;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

class LinkTreeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('guest')->only('customWebsite');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->ajax() && $request->has('color')) {
            return LinkTree::where('id', '=', $request->input('color'))->get();
        }
        if($request->ajax() && $request->has('checkbox')) {
            return LinkTree::where('id', '=', $request->query('id'))->where('user_id', '=', Auth::guard('customers')->id())->get();
        }
        if($request->ajax() && $request->has('logo') || $request->has('name') || $request->has('profile') ) {
            LinkTree::where('id', '=', $request->id)->where('user_id', '=', Auth::guard('customers')->id())->update([
                'profile_picture_option' => $request->profile,
                'link_name_option' => $request->name,
                'logo_option' => $request->logo,
            ]);
            return LinkTree::where('id', '=', $request->query('id'))->where('user_id', '=', Auth::guard('customers')->id())->get();
        }
        if ($request->ajax()) {
            LinkTree::where('id', '=', $request->id)->update([
                'bg_color' => $request->gradient,
            ]);
            return response()->json(LinkTree::where('user_id', '=', Auth::guard('customers')->user())->first());
        }
        $settings = LinkTree::where('user_id', '=', Auth::guard('customers')->id())->first();
        $links_stats = SocialLinks::where('user_id', '=', Auth::guard('customers')->id())->get();
        return view('customer.link_collections.settings', compact('settings', 'links_stats'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $oldImage = LinkTree::where('user_id', '=', Auth::guard('customers')->id())->first();
//            dd(stripos($oldImage, 'images'));
//            unlink($oldImage->bg_color);
//            dd(Input::has('image'));
            $ext = $request->file('image')->extension();
            $image = time() . mt_rand(100, 999) . '.' . $ext;
            $request->file('image')->move(public_path('/images'), $image);
            LinkTree::where('user_id', '=', Auth::guard('customers')->id())->update([
                'bg_color' => $image
                ]);

            return LinkTree::where('user_id', '=', Auth::guard('customers')->id())->first();
        }

        if ($request->has('account') && $request->ajax()) {
            LinkTree::create([
                'account' => $request->account,
                'account_name' => $request->account_name,
                'button_title' => $request->button_title,
                'user_id' => Auth::guard('customers')->id(),
            ]);
            return redirect()->to('customers/social-collection/settings');
        }
        if ($request->ajax()) {
            $var = LinkTree::where('id', '=', $request->input('id'))
                ->update(
                    [
                        'link_name_option' => $request->input('link_name_option'),
                        'bg_color' => $request->input('bg_color'),
                    ]);

            return $var;
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LinkTree $linkTree
     * @return \Illuminate\Http\Response
     */
    public function show(LinkTree $linkTree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LinkTree $linkTree
     * @return \Illuminate\Http\Response
     */
    public function edit(LinkTree $linkTree)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\LinkTree $linkTree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->has('image')) {
            $ext = $request->file('image')->extension();
            $image = time() . mt_rand(100, 999) . '.' . $ext;
            $request->file('image')->move(public_path('/images'), $image);
            LinkTree::where('id', '=', $id)->update([
                'picture' => $image,
                'user_id' => Auth::guard('customers')->id(),
            ]);
        }

        if ($request->input('link_name_option')) {

            LinkTree::where('id', '=', $id)->update([
                'link_name_option' => $request->link_name_option,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LinkTree $linkTree
     * @return \Illuminate\Http\Response
     */
    public function destroy(LinkTree $linkTree)
    {
        //
    }

    public function checkUser(Request $request, $id)
    {
        $user_name = LinkTree::where('user_name', '=', 'upco.de/'.$request->link)->first();
        if($user_name){
            return redirect()->route('customer.social-collection.index')->with('warning', 'user name already exists! Try another one');
        }

        LinkTree::where('id', $id)->update([
            'user_name' => 'upco.de/'. $request->link,
        ]);
        return redirect('customer/social-collection#profile');
    }

}
