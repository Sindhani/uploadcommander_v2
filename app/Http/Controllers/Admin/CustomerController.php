<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\CustomerAffiliates;
use App\Models\Language;
use App\Models\Packages;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Hash;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index','show']]);
        $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Customer::where('parent_id',null)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('package', function ($row){
                    return $row->packages()->first()->subscription_name;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="'.url('admin/customer/'.$row->id.'/edit').'" class=""><i class="icon-pencil"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('admin/customer/destroy/'.$row->id).'" class="danger" onclick="return confirm(\'Are you sure to delete?\')"><i class="icon-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $timezones = getTimeZoneList();

        $language = Language::pluck('language_name','country_code');
        $language->prepend('Select Language','');

        $packages = Packages::pluck('subscription_name','id');
        $packages->prepend('Select Package','');

        $dateFormat = dateFormat();
        $timeFormat = timeFormat();

        $customerNumber = Customer::getIncrementNum();
        return view('admin.customer.create',['customerNumber'=>$customerNumber, 'packages'=>$packages,'timezones'=>$timezones, 'language'=>$language, 'dateFormat'=>$dateFormat, 'timeFormat'=>$timeFormat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_number'=>'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers,email',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['affiliate_number'] = strtoupper(generate_code(10));

        if(!$request->input('status')) {
            $input['status'] = 'inactive';
        }
        $input['is_lock'] = 'No';

        $customer = Customer::create($input);

        //-------------- add entry in customer affiliate table --------------
        $affiliateSettings = Settings::find(1);

        $objCustomerAffiliate = new CustomerAffiliates();
        $objCustomerAffiliate->commission_rate = $affiliateSettings->default_commision;
        $customer->affiliate()->save($objCustomerAffiliate);
        //--------------------------------------------------------------------


        return redirect()->to('admin/customer')
            ->with('success','Customer created successfully');
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
        $timezones = getTimeZoneList();

        $language = Language::pluck('language_name','country_code');
        $language->prepend('Select Language','');

        $customer = Customer::find($id);

        $packages = Packages::pluck('subscription_name','id');
        $packages->prepend('Select Package','');

        $dateFormat = dateFormat();
        $timeFormat = timeFormat();

        return view('admin.customer.edit',compact('customer','packages','dateFormat', 'timeFormat', 'timezones', 'language'));
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
            'customer_number'=>'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers,email,'.$id,
        ]);

        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }

        if(!$request->input('status')) {
            $input['status'] = 'inactive';
        }


        if(!$request->input('is_lock')) {
            $input['is_lock'] = 'No';
        }

        $customer = Customer::find($id);
        $customer->update($input);


        return redirect()->to('admin/customer')
            ->with('success','Customer update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::find($id)->delete();
        return redirect()->to('admin/customer')
            ->with('success','Customer deleted successfully');
    }
}
