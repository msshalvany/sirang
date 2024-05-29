<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\UserBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',

        ], [
            'username.required' => 'فیلد شناسه کاربر الزامی است.',
            'password.required' => 'فیلد عنوان الزامی است.',
        ]);
        $data = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($data)) {
            // احراز هویت موفق
            return redirect()->route('bookListAdmin');
        }
        // احراز هویت ناموفق
        return redirect()->back()->with('loginErr', 1);
    }

}
