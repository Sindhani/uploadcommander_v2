<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Hash;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = User::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {
                    $a = json_decode($row->getRoleNames(),true);
                    return $a;

//                    return $row->getRoleName()->name;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="'.url('admin/user/'.$row->id.'/edit').'" class=""><i class="icon-pencil"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('admin/user/destroy/'.$row->id).'" class="danger" onclick="return confirm(\'Are you sure to delete?\')"><i class="icon-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $timezones = getTimeZoneList();

        $roles = Role::pluck('name','name');
        $roles->prepend('Select Role','');
        return view('admin.user.create',['roles'=>$roles, 'timezones'=>$timezones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required',
            'timezone' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $attachmentName = "";
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $attachmentName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/user_photo');
            $image->move($destinationPath, $attachmentName);
            $input['photo'] = $attachmentName;
        }

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->to('admin/user')
            ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timezones = getTimeZoneList();

        $user = User::find($id);
        $roles = Role::pluck('name','name');
        $roles->prepend('Select Role','');
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.user.edit',compact('user','roles','userRole', 'timezones'));
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
        $this->validate($request, [
            'first_name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required',
            'timezone' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }

        $user = User::find($id);

        $attachmentName = "";
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $attachmentName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/user_photo');
            $image->move($destinationPath, $attachmentName);
            $input['photo'] = $attachmentName;
        } else {
            $attachmentName = $user->photo;
        }

        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->to('admin/user')
            ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->to('admin/user')
            ->with('success','User deleted successfully');
    }
}
