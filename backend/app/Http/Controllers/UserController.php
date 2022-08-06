<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //

    const LOCAL_STORAGE_FOLDER = 'public/avatars/';
    private $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function saveAvatar($request){
        $avatar_name = time(). "." .$request->avatar->extension();

        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $avatar_name);
        return $avatar_name;
    }

    public function deleteAvatar($avatar_name){
        $avatar_path = self::LOCAL_STORAGE_FOLDER . $avatar_name;

        if(Storage::disk('local')->exists($avatar_path)){
            Storage::disk('local')->delete($avatar_path);
        }
    }

    public function showProfile(){
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.show')
        ->with('user',$user);
    }

    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.edit')->with('user', $user);
    }

    function update(Request $request){
        
        $validated = $request->validate([
            'name'      => 'required|min:1|max:50',
            'email'     => 'required|email|max:50|' . Rule::unique('users')->ignore(Auth::user()->id),
            'image'    => 'mimes:jpg,png,jpeg,gif|max:1048'
        ]);

        $user           = $this->user->find(Auth::user()->id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        
        if ($request->image) {
            $user->image = $this->saveAvatar($request, $user->image);
        }

        $user->save();

        return redirect()->route('profile.show');

    }
}
