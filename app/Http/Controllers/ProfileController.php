<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $employee = $user->employee;  // Get the associated employee record

        // if (!$employee) {
        //     return redirect()->route('employee.create')->with('error', 'Please complete your employee information.');
        // }

        return view('profile.edit', compact('user', 'employee'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'salary' => 'required|numeric',
            'manager_name' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();
        $employee = $user->employee; // Get the associated employee record

        // // If there's no associated employee, return an error or redirect
        // if (!$employee) {
        //     return redirect()->route('employee.create')->with('error', 'Please complete your employee information.');
        // }

        // Update user data
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : $user->password,
        ]);

        // Update employee data
        $employee->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'salary' => $request->input('salary'),
            'manager_name' => $request->input('manager_name'),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
