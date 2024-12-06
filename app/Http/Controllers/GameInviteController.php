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

        
        // return response()->json([
        //     'game_id' => $gameId,
        //     'link' => $link,
        //     'message' => 'Game invite link generated successfully',
        //     'status' => 'success'
        // ], 200);
    }

    public function sendInvite(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'inviteLink' => 'required',
        ]);

        // $gameId = $request->game_id ?? null;
        $email = $request->email;
        $link = $request->inviteLink;

        try {
            Mail::to($email)->send(new SendInviteLink($email, $link));
            return response()->json([
                'message' => 'Invitation sent successfully',
                'link' => $link,
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
        $userName = Auth::user()->username;
        $gId = Str::random(8);
        $gameId = $userName . '-'. $gId;
        return $gameId;
    }
}
