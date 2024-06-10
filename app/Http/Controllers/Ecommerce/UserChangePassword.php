<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class UserChangePassword extends Controller
{
    public function update(Request $request)
    {
        $this->validate($request, [
            'password_old' => 'required|min:6',
            'new_password' => 'required|min:6|required_with:new_password_confirm|same:new_password_confirm',
            'new_password_confirm' => 'min:6',
        ]);

        try {
            $id = Auth::guard('customer')->user()->id;
            $password = Auth::guard('customer')->user()->password;

            if(!Hash::check($request->password_old, $password)){
                throw new \Exception('Change Password Failed, Password Old Incorrect');
            }

            Customer::where('id', $id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return redirect()->to('/my-account')->with('success', 'Change Password Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
