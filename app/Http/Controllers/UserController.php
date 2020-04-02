<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\User;
use App\Role;
use App\Provinsi;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    //return datatables object
    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $user = User::with(['roles', 'provinsi'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'users.*',
        ])->get();

        $data_user = Datatables::of($user)

            ->addColumn('roles', function (User $user) {
                    return $user->roles->map(function($role) {
                        return str_limit($role->name, 30, '...');
                    })->implode('<br>');
            })
            ->addColumn('provinsi_nama_provinsi', function($user){
                return $user->provinsi ? $user->provinsi->nama_provinsi : NULL;
            })
        ;

        if ($keyword = $request->get('search')['value']) {
            $data_user->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $data_user->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role_options = Role::all();
        $provinsi_options = Provinsi::all();
        return view('user.create')
            ->with('provinsi_options', $provinsi_options)
            ->with('role_options', $role_options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->email;
        $user->type = 'internal';
        $user->password = bcrypt('12345');
        $user->provinsi_id = $request->provinsi_id;
        $user->save();

        $role_user = [
            ['role_id'=>$request->role_id, 'user_id'=>$user->id],
        ];
        \DB::table('role_user')->insert($role_user);
        return redirect('user/'.$user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.show')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $provinsi_options = Provinsi::all();
        return view('user.edit')
            ->with('provinsi_options', $provinsi_options)
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->provinsi_id = $request->provinsi_id;
        $user->save();
        return redirect('user/'.$id)
            ->with('successMessage', 'User updated');
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
