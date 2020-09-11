<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Hash;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Customer::where('parent_id',Auth::guard('customers')->user()->id)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->first_name.' '.$row->last_name;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="'.url('customer/user/'.$row->id.'/edit').'" class=""><i class="icon-pencil"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('customer/user/destroy/'.$row->id).'" class="danger" onclick="return confirm(\'Are you sure to delete?\')"><i class="icon-trash"></i> </a>&nbsp;&nbsp;';

                    $checked='';
                    if($row->status=='active') {
                        $checked='checked';
                    }

                    $btn .= '<div class="custom-control-inline custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch'.$row->id.'" '.$checked.' onchange="updateStatus(this.checked, '.$row->id.')" value="1">
                                <label class="custom-control-label" for="customSwitch'.$row->id.'">&nbsp;</label>
                            </div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('customer.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|confirmed|unique:customers,email',
            'email_confirmation' => 'required|email'
        ]);

        $input = $request->all();
        $input['parent_id'] = Auth::guard('customers')->user()->id;
        $input['created_by'] = Auth::guard('customers')->user()->id;
        //$input['password'] = Hash::make(generate_code());
        $input['password'] = Hash::make('test@123');
        //$input['affiliate_number'] = strtoupper(generate_code(10));

        if(!$request->input('status')) {
            $input['status'] = 'inactive';
        }
        $input['is_lock'] = 'No';

        $customer = Customer::create($input);

        //-------------- add entry in customer affiliate table --------------
        /*$affiliateSettings = Settings::find(1);

        $objCustomerAffiliate = new CustomerAffiliates();
        $objCustomerAffiliate->commission_rate = $affiliateSettings->default_commision;
        $customer->affiliate()->save($objCustomerAffiliate);*/
        //--------------------------------------------------------------------


        return redirect()->to('customer/user')
            ->with('success','User created successfully');
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
        $customer = Customer::find($id);

        return view('customer.user.edit',compact('customer'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers,email,'.$id,
        ]);

        $input = $request->all();

        if(!$request->input('status')) {
            $input['status'] = 'inactive';
        }


        if(!$request->input('is_lock')) {
            $input['is_lock'] = 'No';
        }

        $customer = Customer::find($id);
        $customer->update($input);


        return redirect()->to('customer/user')
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
        return redirect()->to('customer/user')
            ->with('success','Customer deleted successfully');
    }

    public function activedeactive($id, $status)
    {
        $obj = Customer::find($id);
        $obj->status = $status;
        $obj->save();
        return redirect()->to('customer/user')
            ->with('success','Customer updated successfully');
    }

    public function addresspassword(Request $request)
    {
        $this->validate($request, [
            'street' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'country' => 'required',
            'language' => 'required',
            'timezone' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'dateformat' => 'required',
            'timeformat' => 'required',
        ]);

        if($request->input('password') != $request->input('password_confirmation')) {
            Session::flash('error', 'Password and confirm password does not match.');
            return redirect()->to('customer/home');
        }

        $customerId = Auth::guard('customers')->user()->id;


        $attachmentName = "";
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $attachmentName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/user_photo');
            $image->move($destinationPath, $attachmentName);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['photo'] = $attachmentName;

        $input['last_login'] = now();
        $input['password_changed'] = 1;

        $customer = Customer::find($customerId);
        $customer->update($input);

        return redirect()->to('customer/home')
            ->with('success','Address & password updated successfully');
    }

    public function profile()
    {
        $dateFormat = dateFormat();
        $timeFormat = timeFormat();

        $countryList = getCountryList();

        $timezones = getTimeZoneList();
        $language = Language::pluck('language_name','country_code');
        $language->prepend('Select Language','');

        $customer = Customer::find(Auth::guard('customers')->user()->id);
        return view('customer.user.profile',compact('timezones','language', 'dateFormat', 'timeFormat', 'countryList', 'customer'));
    }

    public function updateaccount(Request $request)
    {
        $customerId = Auth::guard('customers')->user()->id;

        $this->validate($request, [
            'first_name'=>'required',
            'last_name'=>'required',
            'company_name'=>'required',
            'email' => 'required|email|unique:customers,email,'.$customerId,

            'street' => 'required',
            'street_no' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'country' => 'required',
            'language' => 'required',
            'timezone' => 'required',
            'dateformat' => 'required',
            'timeformat' => 'required',
        ]);


        $customer = Customer::find($customerId);
        $input = $request->all();

        if($request->input('password')!='' && $request->input('password_confirmation')!='') {
            $this->validate($request, [
                'password' => 'required',
                'password_confirmation' => 'required',
            ]);

            if($request->input('password') != $request->input('password_confirmation')) {

                Session::flash('error', 'Password and confirm password does not match.');
                return redirect()->to('customer/profile');
            }

            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }

        $attachmentName = "";
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $attachmentName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/user_photo');
            $image->move($destinationPath, $attachmentName);
        } else {
            $attachmentName = $customer->photo;
        }

        $input['photo'] = $attachmentName;

        $customer->update($input);

        return redirect()->to('customer/profile')
            ->with('success','Address updated successfully');
    }


    public function changepassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        if($request->input('password') != $request->input('password_confirmation')) {
            Session::flash('error', 'Password and confirm password does not match.');
            return redirect()->to('customer/profile');
        }

        $customerId = Auth::guard('customers')->user()->id;

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $customer = Customer::find($customerId);
        $customer->update($input);

        return redirect()->to('customer/profile')
            ->with('success','Password updated successfully');
    }
}
