<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\AgencyInvitation;
use App\Models\User;

class AgencyInvitationController extends Controller
{
    /**
     * Send an invitation to an email.
     */
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $agency = auth()->user()->ownedAgency;

        if (!$agency) {
            return response()->json(['message' => 'You do not own an agency'], 403);
        }

        $token = Str::random(40);

        $invitation = AgencyInvitation::create([
            'agency_id' => $agency->id,
            'email' => $request->email,
            'token' => hash('sha256', $token),
            'expires_at' => now()->addDays(2),
            'status' => 'pending',
        ]);

        $link = url("/accept-invitation?token=$token&email=".$request->email);

        return response()->json([
            'message' => 'Invitation sent successfully',
            'link' => $link,
        ]);
    }

    /**
     * Accept an invitation and create a user.
     */
   public function accept(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'token' => 'required',
        'password' => 'required|confirmed',
    ]);

    // Find the invitation by email and token together
    $invitation = AgencyInvitation::where('email', $request->email)
        ->where('token', hash('sha256', $request->token))
        ->first();

    if (!$invitation) {
        return response()->json(['message' => 'Invalid or expired invitation'], 400);
    }

    // Check expiration
    /*if ($invitation->expires_at->isPast()) {
        return response()->json(['message' => 'Invitation expired'], 400);
    }*/

    // Prevent duplicate users
    if (User::where('email', $request->email)->exists()) {
        return response()->json([
            'message' => 'User already exists for this email',
        ], 400);
    }

    // Create user
    $user = User::UpdateOrCreate([
        'name' => 'Agency Admin',
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'account_type' => 'agency',
        'agency_id' => $invitation->agency_id,
        'is_agency_admin' => true,
    ]);

    // Mark invitation as accepted
    $invitation->update([
        'status' => 'accepted',
    ]);

    return response()->json([
        'message' => 'Invitation accepted successfully',
        'user' => $user,
    ]);
}
}