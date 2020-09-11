<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use App\Models\Feed;
use App\Models\LinkTree;
use App\Models\SocialLinks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

class SocialLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->ajax() && $request->has('statistics')){
            $count = SocialLinks::where('id', '=', $request->id)->where('user_id', '=', Auth::guard('customers')->id())->first();

            SocialLinks::where('id', '=', $request->id)->where('user_id', '=', Auth::guard('customers')->id())->update([
                'clicks_count' => $count->clicks_count+1,
                'click_time' => Carbon::now()
            ]);
        }
        if ($request->ajax() && $request->has('id') && $request->has('statistics')) {
            $count = Feed::where('customer_id', '=', Auth::guard('customers')->id())->first();
            if($count){
                $total_clicks = SocialLinks::sum('clicks_count');
                Feed::where('customer_id', '=', $count->customer_id)
                    ->update([
                        'clicks_count' => $total_clicks,
                    ]);
            }
            else{
                Feed::create([
                    'clicks_count' => 1,
                    'customer_id' =>  Auth::guard('customers')->id()
                ]);
            }
        }

        if ($request->ajax() && $request->has('button_type')) {
            SocialLinks::where('user_id', '=', Auth::guard('customers')->id())->update([
                "button_type" => $request->button_type,
            ]);
        }


        if ($request->ajax() && $request->has('collectionTabCheckboxes')) {
            return SocialLinks::where('user_id', '=', Auth::guard('customers')->id())->get();
        }
        if ($request->ajax() && $request->has('visibility')) {
            SocialLinks::where('id', '=', $request->id)->update([
                'visibility' => $request->input('visibility'),
            ]);
        }
        if ($request->ajax()) {

            $links = SocialLinks::where('user_id', '=', Auth::guard('customers')->id())->get();
            return $links;
        }

//        return view('customer.link_collections', compact('links'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $button_type = SocialLinks::where('user_id', '=', Auth::guard('customers')->id())->first();
        $links = SocialLinks::create([
                'account' => $request->account,
                'account_name' => $request->account_name,
                'button_title' => $request->button_title,
                'button_type' => $button_type->button_type,
                'user_id' => Auth::guard('customers')->id(),
            ]
        );
        return redirect()->to('customer/social-collection#profile');
//			return view('customer.link_collections.button')->with('links', $links);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        SocialLinks::where('id', '=', $id)->delete();
        return redirect()->back();
    }

    public function unlink(Request $request)
    {
        if ($request->ajax()) {
            SocialLinks::where('id', '=', $request->id)->delete();
            return redirect()->back();
        }
    }

    public function userName($username, Request $request)
    {
        $user = LinkTree::where('user_name', '=', 'upco.de/' . $username)->first();
        if ($user) {
            $count = Feed::where('customer_id', '=', $user->user_id)->first();
            Feed::where('customer_id', '=', $user->user_id)
                ->update([
                    'personal_link_visits' => $count->personal_link_visits + 1
                ]);
            $links_options = LinkTree::where('user_id', '=', $user->user_id)->first();
            $buttons = SocialLinks::where('visibility', '=', 1)->get();
            return view('customer.website.index', compact('links_options', 'buttons'));
        }
        return redirect('customer/social-collection#setting');
    }
}

