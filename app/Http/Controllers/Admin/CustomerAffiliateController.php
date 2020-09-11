<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomerAffiliates;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class CustomerAffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = CustomerAffiliates::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer_number', function ($row){
                    return $row->customer->customer_number;
                })
                ->addColumn('first_name', function ($row){
                    return $row->customer->first_name;
                })
                ->addColumn('last_name', function ($row){
                    return $row->customer->last_name;
                })
                ->addColumn('affiliate_number', function ($row){
                    return $row->customer->affiliate_number;
                })
                ->addColumn('commission_rate', function ($row){
                    return $row->commission_rate.'%';
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    return $btn;
                })
                ->make(true);
        }
        return view('admin.customer_affiliate.index');
    }

    public function affiliateRegistrationCashout(Request $request)
    {
        if ($request->ajax()) {

            $data = CustomerAffiliates::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row){
                    return $row->customer->created_at;
                })
                ->addColumn('customer_number', function ($row){
                    return $row->customer->customer_number;
                })
                ->addColumn('first_name', function ($row){
                    return $row->customer->first_name;
                })
                ->addColumn('last_name', function ($row){
                    return $row->customer->last_name;
                })
                ->addColumn('payment_method', function ($row){
                    return '';
                })
                ->addColumn('packages', function ($row){
                    return '';
                })
                ->addColumn('payed_price', function ($row){
                    return '';
                })
                ->addColumn('commission_amount', function ($row){
                    return '';
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    return $btn;
                })
                ->make(true);
        }
        return view('admin.customer_affiliate.affiliate_registration_cashout');
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
        //
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
