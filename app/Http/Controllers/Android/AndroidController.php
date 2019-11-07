<?php

namespace App\Http\Controllers\Android;

use App\Android;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;

class AndroidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Android  $android
     * @return \Illuminate\Http\Response
     */
    public function show(Android $android)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Android  $android
     * @return \Illuminate\Http\Response
     */
    public function edit(Android $android)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Android  $android
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Android $android)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Android  $android
     * @return \Illuminate\Http\Response
     */
    public function destroy(Android $android)
    {
        //
    }

    /**
     * Login the specified user.
     *
     * @param  \App\Android  $android
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request){
        $cek = Android::where('no_hp', '=', $request->no_hp)->first();
        $user = DB::table('users')
            ->leftJoin('positions', 'users.id_position', '=', 'positions.id_position')
            ->leftJoin('locations','users.id_location', '=', 'locations.id_location')
            ->leftJoin('leaders','users.id', '=', 'leaders.id_employee')
            ->select('users.id','users.name','users.no_hp','users.photo','users.imei',
                    'users.id_location','users.id_position','users.id_leader',
                    'users.id_location','leaders.type',
                    'positions.position','locations.location','locations.latitude','locations.longitude')
            ->where('users.no_hp',$request->no_hp)
            ->first();

        $status = "error";
        $message = "";
        $data = null;
        $code = 401;
        $tipe = null;
        $this->validate($request,[
            'no_hp'     => 'required',
            'imei'  => 'required'
        ]);

        if($user){
            if(!$user->imei){
                $cek->update([
                    'imei'        => $request['imei']
                ]);
                
                if($request->imei == $user->imei){
                    $status  = 'success';
                    $message = 'Login sukses';
                    
                    // tampilkan data user menggunakan method toArray
                    $data = $user;
                    if($user->type == null){
                       $tipe = 'pegawai';
                    } else {
                       $tipe = $user->type;
                    }
                    $code = 200;
                }
            }
            elseif ($request->imei == $user->imei) {
                // generate token
                $status  = 'success';
                $message = 'Login sukses';
                
                // tampilkan data user menggunakan method toArray
                $data = $user;
                if($user->type == null){
                    $tipe = 'pegawai';
                } else {
                    $tipe = $user->type;
                 }
                $code = 200;
            }else{
                $message = "Login gagal, hp tidak sesuai";
            }
        } else{
                $message = "Login gagal, No hp tidak ada";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'tipe' => $tipe,
            'data' => $data], $code);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            ]);
           
        $status = "error";
        $message = "";
        $data = null;
        $code = 400;
        if ($validator->fails()) {
        $errors = $validator->errors();
        $message = $errors;
        } else{
            $user = Android::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'imei' =>$request->imei
            ]);
        if($user){
            //Auth::login($user); // hapus bari ini
            $status = "success";
            $message = "register successfully";
            $data = $user->toArray();
            $code = 200;
        } else{
            $message = 'register failed';
        }
    }
            return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
            ], $code);
    }

    public function detailUsers($id)
    {
        // $user = Android::where('id', '=', $request->id)->first();
        $user = Android::GetUser($id);
        $status = "error";
        $message = "";
        $data = null;
        $code = 401;

        if($user->toArray()){
            $status  = 'success';
            $message = 'success get data';
            
            // tampilkan data user menggunakan method toArray
            $data = $user->toArray();
            $code = 200;
        } else{
                $message = "get data fail";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data], $code);
    }

    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6',
    //         ]);
           
    //     $status = "error";
    //     $message = "";
    //     $data = null;
    //     $code = 400;
    //     if ($validator->fails()) {
    //     $errors = $validator->errors();
    //     $message = $errors;
    //     } else{
    //         $user = Android::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'imei' =>$request->imei
    //         ]);
    //     if($user){
    //         //Auth::login($user); // hapus bari ini
    //         $status = "success";
    //         $message = "register successfully";
    //         $data = $user->toArray();
    //         $code = 200;
    //     } else{
    //         $message = 'register failed';
    //     }
    // }
    //         return response()->json([
    //         'status' => $status,
    //         'message' => $message,
    //         'data' => $data
    //         ], $code);
    // }
}
