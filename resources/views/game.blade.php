<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe Game</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[url('/public/assets/beams.jpg')] min-h-screen flex flex-col justify-center items-center bg-gray-100 font-sans">
    <livewire:game.tic-tac-toe :gameId="$gameId" />
    <div class="flex justify-end">
        <div class="py-6 text-gray-900 dark:text-gray-100">
            <button data-dialog-target="share-invite-dialog" id="generate_link"
            {{-- onclick="generateInvitation()" --}}
            class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Share Invite</button>
        </div>

        {{-- <div class="py-6 px-4 text-gray-900 dark:text-gray-100">
            <a href="{{ route('game') }}"><button class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Start Game</button></a>
        </div> --}}
    </div>
    @include('livewire.game.share-modal')

    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/dialog.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/soft-ui-dashboard.js') }}"></script>
</body>
</html>
