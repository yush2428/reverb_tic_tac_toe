<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InputEntered implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $index;
    public $player;
    public $gameId;
    public $playerX;
    public $playerO;

    /**
     * Create a new event instance.
     */
    public function __construct(array $gameData)
    {
        $this->index = $gameData['index'];
        $this->player = $gameData['player'];
        $this->gameId = $gameData['gameId'];
        $this->playerX = $gameData['playerX'];
        $this->playerO = $gameData['playerO'] ?? null;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('game-room.' . $this->gameId),
        ];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'index' => $this->index,
            'player' => $this->player,
            'gameId' => $this->gameId,
            'playerX' => $this->playerX,
            'playerO' => $this->playerO
        ];
    }
}
