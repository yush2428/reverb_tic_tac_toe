<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInviteLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GameInviteController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $gameId = $this->generateGameId();
        $link = url('/game/' . $gameId);

        return response()->json([
            'game_id' => $gameId,
            'link' => $link,
            'message' => 'Game invite link generated successfully',
            'status' => 'success'
        ], 200);
    }

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
            return response()->json([
                'message' => 'Failed to send invitation',
                'status' => 'error'
            ], 500);
        }
    }

    private function generateGameId()
    {
        $userName = str_replace(' ', '', Auth::user()->name);
        $gId = Str::random(6);
        $gameId = $userName . '/'. $gId;
        return $gameId;
    }
}
