<div>
    <h1 class="text-gray-800 mb-8 text-center text-4xl md:text-4xl">Tic Tac Toe</h1>
    
    <div class="mb-6 text-center">
        <div class="text-lg text-gray-700">
            <span class="font-semibold">Player X:</span> {{ $playerX ?? 'Waiting...' }}
        </div>
        <div class="text-lg {{ $playerO ? 'text-gray-700' : 'text-gray-500 italic' }}">
            <span class="font-semibold">Player O:</span> 
            {{ $playerO ?? 'Waiting for player to join...' }}
        </div>
    </div>
    
    @if($winner === 'draw')
        <div class="mb-4 text-xl text-gray-600">Game Over - It's a Draw!</div>
    @elseif($winner)
        <div class="mb-4 text-xl text-gray-600">Game Over - {{ $this->getWinnerName() }} Wins!</div>
    @elseif(!$playerO)
        <div class="mb-4 text-xl text-gray-600">Waiting for Player O to join...</div>
    @else
        <div class="mb-4 text-xl text-gray-600">{{ $this->getCurrentPlayerName() }}'s Turn</div>
    @endif

    <div class="grid grid-cols-3 gap-2.5 max-w-[400px] w-[90%] aspect-square p-2.5 bg-white rounded-lg shadow-md mx-auto">
        @foreach($board as $index => $value)
            <div 
                wire:click="makeMove({{ $index }})" 
                class="relative w-full pb-[100%] bg-white border-2 border-gray-200 rounded-lg cursor-pointer transition-all hover:bg-gray-50 hover:border-gray-600 {{ ($gameOver || !$playerO || ($currentPlayer === 'O' && !$playerO)) ? 'cursor-not-allowed' : '' }}"
            >
                <div class="absolute inset-0 flex justify-center items-center text-4xl md:text-3xl font-bold text-gray-800">
                    {{ $value }}
                </div>
            </div>
        @endforeach
    </div>

    @if($gameOver)
        <div class="flex justify-center mt-8">
            <button 
                wire:click="resetGame"
                class="px-6 py-3 text-base bg-green-500 text-white border-none rounded-md cursor-pointer transition-colors hover:bg-green-600"
            >
                Play Again
            </button>
        </div>
    @endif
</div>
