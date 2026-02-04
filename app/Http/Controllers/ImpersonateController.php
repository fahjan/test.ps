<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class ImpersonateController extends Controller
{


    // @if(Session::has('original_user_id'))
    //     <a href="{{ url('/leave-impersonation') }}" class="btn btn-danger">Leave Impersonation</a>
    // @endif

    public function impersonate(string $id)
    {
        $mainUser = Auth::user();

        // Store the original user's ID in the session
        Session::put('original_user_id', $mainUser->id);

        // Log in as the new user
        $otherUser = User::select(['id'])->findOrFail($id);
        Auth::login($otherUser);

        // Redirect to the new user's dashboard or home page
        // TODO(fahjan): redirect to home page for user
        return redirect()->route('home');
    }

    public function leaveImpersonation()
    {
        // Retrieve the original user's ID from the session
        $originalUserId = Session::pull('original_user_id');

        if ($originalUserId) {
            $originalUser = User::find($originalUserId);

            if ($originalUser) {
                // Log back in as the original user
                Auth::login($originalUser);
                // Redirect to the main user's dashboard (e.g., admin dashboard)
                return redirect()->route('home');
            }
        }

        // If no original user ID is found, redirect to a default location (e.g., login)
        return redirect()->route('login');
    }


}
