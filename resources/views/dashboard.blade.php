<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between">
                    <div class="px-6 py-8 text-gray-900 dark:text-gray-100 text-xl font-bold">
                        {{ __("Invite your friend to Play Game") }}
                    </div>
                
                    <div class="flex justify-end">
                        <div class="py-6 text-gray-900 dark:text-gray-100">
                            <button data-dialog-target="share-invite-dialog" id="generate_link" onclick="generateInvitation()" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Share Invite</button>
                        </div>
    
                        <div class="py-6 px-4 text-gray-900 dark:text-gray-100">
                            <a href="{{ route('game') }}"><button class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Start Game</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.game.share-modal')
</x-app-layout>

<script src="https://unpkg.com/@material-tailwind/html@latest/scripts/dialog.js"></script>
<script>
    // this function will generate game id and invite link
    function generateInvitation() {
        // alert(24);
        $.ajax({
            url: "{{ route('game.generate-link') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(data) {
                console.log(data);
                console.log(data.game_id);
                console.log(data.link);
            },
            error: function(error) {
                console.error('Error:', error);
                alert('Failed to send invitation. Please try again.');
            }
        });
    }
</script>