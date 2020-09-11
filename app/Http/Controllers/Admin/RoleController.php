<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Roles;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Role::join('users','users.id','=','roles.created_by','LEFT')
                ->select('roles.*','users.first_name','users.surname')
                ->latest()->get();
            //$data = Role::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('userName', function ($row) {
                    return $row->first_name.' '.$row->surname;
                    //return $row->users()->first()->first_name; //.' '.$row->users()->surname;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.url('admin/role/'.$row->id.'/edit').'" class=""><i class="icon-pencil"></i> </a>&nbsp;&nbsp;';
                    $btn .= '<a href="'.url('admin/role/destroy/'.$row->id).'" class="danger" onclick="return confirm(\'Are you sure to delete?\')"><i class="icon-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('admin.role.create',compact('permission'));
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'created_by' => Auth::user()->id
        ]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->to('admin/role')
            ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();


        return view('admin.role.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('admin.role.edit',compact('role','permission','rolePermissions'));
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
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->description = $request->input('description');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->to('admin/role')
            ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objCheckRole = DB::table("model_has_roles")->where("role_id",$id)->count();

        if($objCheckRole > 0) {
            return redirect()->to('admin/role')
                ->with('danger','Role can not be deleted. Users are mapped with the role.');
        } else {
            Role::find($id)->delete();
            return redirect()->to('admin/role')
                ->with('success','Role deleted successfully');
        }

    }
}
