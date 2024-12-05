<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInviteLink;

class GameInviteController extends Controller
{
    public function sendInvite(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'game_id' => 'nullable',
        ]);

        $gameId = $request->game_id ?? null;
        $email = $request->email;
        $link = url('/game/' . $gameId);

        try {
            Mail::to($email)->send(new SendInviteLink($email, $link));
            return response()->json([
                'message' => 'Invitation sent successfully',
                'status' => 'success'
            ], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json([
                'message' => 'Failed to send invitation',
                'status' => 'error'
            ], 500);
        }
    }
}
