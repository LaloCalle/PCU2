<?php

namespace PCU\Http\Controllers;

use Illuminate\Http\Request;

use PCU\Http\Requests;
use PCU\Http\Requests\UserRequest;
use PCU\Http\Requests\UserUpdateRequest;
use PCU\Http\Controllers\Controller;
use PCU\User;
use Auth;
use Redirect;
use Session;
use Illuminate\Routing\Route;

class UserController extends Controller
{
    public function __construct(){
        $this->beforeFilter('@find',['only'=>['show','edit','update','destroy']]);
    }

    public function find(Route $route){
        $this->user = User::find($route->getParameter('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('name','asc')
                ->paginate(25);

        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::create($request->all());

        Session::flash('message-success',trans('strings.adduseralert'));
        return Redirect::to('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show',['user'=>$this->user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->user->p_superadmin == 1){
            $this->user->p_superadmin = "checked";
        }else{
            $this->user->p_superadmin = "";
        }
        if($this->user->p_admin == 1){
            $this->user->p_admin = "checked";
        }else{
            $this->user->p_admin = "";
        }
        if($this->user->p_document == 1){
            $this->user->p_document = "checked";
        }else{
            $this->user->p_document = "";
        }

        return view('users.edit',['user'=>$this->user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $this->user->fill($request->all());

        if($request->p_superadmin == ""){
            $this->user->p_superadmin = 0;
        }
        if($request->p_admin == ""){
            $this->user->p_admin = 0;
        }
        if($request->p_document == ""){
            $this->user->p_document = 0;
        }

        $this->user->save();

        Session::flash('message-success',trans('strings.edituseralert'));
        
        return Redirect::to('/users/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->delete();

        Session::flash('message-success',trans('strings.deleteuseralert'));

        return response()->json([
            "mensaje" => "borrado"
        ]);
    }
}
