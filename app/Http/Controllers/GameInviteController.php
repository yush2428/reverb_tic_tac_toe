<?php

namespace App\Http\Controllers;

use App\Enums\MatchEnums;
use App\Models\GameMatch;
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

        // Here, create a record in GameMatch Table with the provided data
        $match = GameMatch::create([
            'user_id'      => $user->id,
            'opponent_id'  => null,
            'match_id'     => $gameId,
            'link'         => $link,
            'match_status' => MatchEnums::PENDING,
        ]);
        // dump($match);

        return redirect("game/{$gameId}"); //->with(['user', 'gameId', 'link']);
        // return view("game", compact('user', 'gameId', 'link'));
    }

    public function show($gameId){
        $url = GameMatch::select('link')->whereMatchId($gameId)->first();
        $link = $url->link;
        return view('game', compact('link', 'gameId'));
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
