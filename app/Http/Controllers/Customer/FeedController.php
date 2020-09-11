<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ButtonStatistic;
use App\Models\Feed;
use Auth;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Feed|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function index(Request $request)
    {
//        if ($request->ajax() && $request->has('id')) {
//            $count = Feed::where('customer_id', '=', Auth::guard('customers')->id())->first();
//            if($count){
//                Feed::where('customer_id', '=', $count->customer_id)
//                    ->update([
//                        'clicks_count' => $count->clicks_count + 1,
//                    ]);
//            }
//            else{
//                Feed::create([
//                        'clicks_count' => 1,
//                        'customer_id' =>  Auth::guard('customers')->id()
//                    ]);
//            }
//
//
//        }

        if ($request->ajax()) {
            return Feed::where('customer_id', '=', $request->visits_counts)->first();
        }
        return Feed::where('customer_id', '=', $request->id)->first();
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
     * @return int
     */
    public function store(Request $request)
    {



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feed $feed
     * @return \Illuminate\Http\Response
     */
    public
    function show(Feed $feed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feed $feed
     * @return \Illuminate\Http\Response
     */
    public
    function edit(Feed $feed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Feed $feed
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, Feed $feed)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feed $feed
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Feed $feed)
    {
        //
    }
}
