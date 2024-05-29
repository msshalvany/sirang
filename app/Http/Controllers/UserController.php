<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function loginUser(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',

        ], [
            'username.required' => 'فیلد شناسه کاربر الزامی است.',
            'password.required' => 'فیلد عنوان الزامی است.',
        ]);
        $data = $request->only('username', 'password');
        if (Auth::guard('user')->attempt($data)) {
            // احراز هویت موفق
            return redirect()->route('bookList');
        }
        // احراز هویت ناموفق
        return redirect()->back()->with('loginErr', 1);
    }
    public function panel()
    {
        $user = Auth::user();
        $books = UserBook::where('user_id',$user->id)->get();
        return view('book.panel',compact('books'));
    }
}
