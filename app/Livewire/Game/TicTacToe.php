<?php

namespace App\Livewire\Game;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\InputEntered;

class TicTacToe extends Component
{
    public $board = ['', '', '', '', '', '', '', '', ''];
    public $currentPlayer = 'X';
    public $gameId;
    public $winner = null;
    public $gameOver = false;
    public $playerX;
    public $playerO;

    private $winningCombinations = [
        [0, 1, 2], // top row
        [3, 4, 5], // middle row
        [6, 7, 8], // bottom row
        [0, 3, 6], // left column
        [1, 4, 7], // middle column
        [2, 5, 8], // right column
        [0, 4, 8], // diagonal top-left to bottom-right
        [2, 4, 6]  // diagonal top-right to bottom-left
    ];

    public function mount($gameId)
    {

        \Log::info('Mount: ', [$gameId]);
        $this->gameId = $gameId;
        $this->playerX = auth()->user()->username;
        $this->playerO = null;
    }

    public function makeMove($index)
    {
        if ($this->gameOver || $this->board[$index] !== '') {
            return;
        }

        $currentUserName = auth()->user()->username;

        // If playerO is not set and current user is not playerX, set them as playerO
        if (!$this->playerO && $currentUserName !== $this->playerX) {
            $this->playerO = $currentUserName;
        }

        // Ensure the current user is the current player
        $currentPlayerName = $this->currentPlayer === 'X' ? $this->playerX : $this->playerO;

        if ($currentUserName !== $currentPlayerName) {
            return;
        }

        $this->board[$index] = $this->currentPlayer;

        broadcast(new InputEntered([
            'index' => $index,
            'player' => $this->currentPlayer,
            'gameId' => $this->gameId,
            'playerX' => $this->playerX,
            'playerO' => $this->playerO
        ]));

        $this->checkWinner();
        
        if (!$this->gameOver) {
            $this->currentPlayer = $this->currentPlayer === 'X' ? 'O' : 'X';
        }
    }

    public function getCurrentPlayerName()
    {
        return $this->currentPlayer === 'X' ? $this->playerX : $this->playerO;
    }

    public function getWinnerName()
    {
        if ($this->winner === 'draw') {
            return null;
        }
        return $this->winner === 'X' ? $this->playerX : $this->playerO;
    }

    public function checkWinner()
    {
        // Check for winner
        foreach ($this->winningCombinations as $combination) {
            [$a, $b, $c] = $combination;
            if ($this->board[$a] !== '' &&
                $this->board[$a] === $this->board[$b] &&
                $this->board[$a] === $this->board[$c]) {
                $this->winner = $this->board[$a];
                $this->gameOver = true;
                return;
            }
        }

        // Check for draw
        if (!in_array('', $this->board)) {
            $this->gameOver = true;
            $this->winner = 'draw';
        }
    }

    public function resetGame()
    {
        $this->board = ['', '', '', '', '', '', '', '', ''];
        $this->currentPlayer = 'X';
        $this->winner = null;
        $this->gameOver = false;
        $this->playerO = null;
    }

    #[On('echo-private:game-room.{gameId},InputEntered')]
    public function handleInput($data)
    {
        if (isset($data['index']) && isset($data['player'])) {
            $this->board[$data['index']] = $data['player'];
            $this->playerX = $data['playerX'];
            $this->playerO = $data['playerO'];
            $this->checkWinner();
            if (!$this->gameOver) {
                $this->currentPlayer = $data['player'] === 'X' ? 'O' : 'X';
            }
        }
    }

    public function render()
    {
        return view('livewire.game.tic-tac-toe');
    }
}
