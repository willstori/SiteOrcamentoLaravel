<?php

namespace App\Http\Controllers\Admin\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\IUserService;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $_userService;

    public function __construct(IUserService $userService)
    {
        $this->_userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ViewData['users'] = User::where('email', '<>', "projetos@lovatel.com.br")->get();

        return view('admin.users.list', $ViewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $ViewData['user'] = $user;

        return view('admin.users.edit', $ViewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,  [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5'],
        ]);

        $this->_userService->storeUser($request);

        return redirect()->route('admin.users');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:5'],
        ]);

        $this->_userService->updateUser($request, $user);

        return redirect()->route('admin.users.edit', $user->id)->with('success', "As informaçõe de Usuário foram alteradas.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->_userService->destroyUser($user);

        return response()->json([
            'titulo' => "Sucesso!",
            'mensagem' => "Usuário removido.",
            'tipo' => "success"
        ], 200);
    }
}
