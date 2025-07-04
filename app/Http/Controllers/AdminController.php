<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\UserData;



class AdminController extends Controller
{
    public function adminHome() : View
    {        
        $users = UserData::latest()->paginate(5);
        
        return view('admin.adminHome',compact('users'));
                    
    }

  
    /**
     * Display the specified resource.
     */
    public function adminShow(User $users): View
    {
       return view('admin.adminShow',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users): View
    {
        return view('admin.adminEdit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $users): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'type' => 'required',
        ]);
        
        $users->update($request->all());
        
        return redirect()->route('admin.adminHome')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $users): RedirectResponse
    {
         $users->delete();
         
        return redirect()->route('/adminHome')
                        ->with('success','User deleted successfully');
    }
}
