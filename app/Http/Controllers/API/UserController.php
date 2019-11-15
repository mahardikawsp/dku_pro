<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image as Image;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');
        return User::allJoin();
    }

    public function joinwp()
    {
        $this->authorize('isAdmin');
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'          => 'required|string|max:191',
            'email'         => 'required|string|email|max:191|unique:users',
            'password'      => 'required|string|min:6',
            'no_hp'         => 'required|string|min:11',
            'id_location'   => 'required',
            'id_position'   => 'required',
            'id_jamker'     => 'required',
            'tipe'        => 'required',
        ]);
        return User::create([
            'name'        => $request['name'],
            'email'       => $request['email'],
            'password'    => Hash::make($request['password']),
            'no_hp'       => $request['no_hp'],
            'id_location' => $request['id_location'],
            'id_leader'   => $request['id_leader'],
            'id_position' => $request['id_position'],
            'id_jamker'   => $request['id_jamker'],
            'tipe'      => $request['tipe']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return auth('api')->user();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user           = auth('api')->user();

        $this->validate($request,[
            'name'          => 'required|string|max:191',
            'email'         => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'      => 'sometimes|string|min:6'
        ]);

        $currentPhoto   = $user->photo;
         if( $request->photo != $currentPhoto ){
            
          $name=time().'.'. explode('/', explode(':',substr($request->photo,0,strpos($request->photo,';')))[1])[1];
          \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);
          //new poto name marege to request form
          $userPhoto = public_path('img/profile/').$currentPhoto;
          if(file_exists($userPhoto)){
            @unlink($userPhoto); 
          }
        }
        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
        return ['message' => 'berhasil'];
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request,[
            'name'          => 'required|string|max:191',
            'email'         => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'      => 'sometimes|string|min:6'
        ]);

        $user->update([
            'name'        => $request['name'],
            'email'       => $request['email'],
            'password'    => Hash::make($request['password']),
            'no_hp'       => $request['no_hp'],
            'id_location' => $request['id_location'],
            'id_leader'   => $request['id_leader'],
            'id_position' => $request['id_position'],
            'id_jamker'   => $request['id_jamker'],
            'imei'        => $request['imei'],
            'tipe'      => $request['tipe']
        ]);
        return ['message' => 'Update berhasil'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $user = User::where('id', '=', $id)->delete();
        return ['message' => 'terhapus'];
    }
    public $successStatus = 200;

    public function search(){
        if($search = \Request::get('q')){
            $users = DB::table('users')
            ->leftJoin('positions', 'users.id_position', '=', 'positions.id_position')
            ->leftJoin('locations','users.id_location', '=', 'locations.id_location')
            ->leftJoin('jamkers','users.id_jamker','=','jamkers.id_jamker')
            ->where('users.name','LIKE','%'.$search.'%')->paginate(10);
        } else {
            $users = User::latest()->paginate(10);
        }
        return $users;
    }
}