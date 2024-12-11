<div data-dialog-backdrop="share-invite-dialog" data-dialog-backdrop-close="true"
    class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
    <div data-dialog="share-invite-dialog" class="relative mx-auto w-full max-w-[24rem] rounded-lg overflow-hidden shadow-sm">
        <div class="relative flex flex-col bg-white">
            <div class="relative m-2 items-center flex justify-center text-white h-12 rounded-md bg-slate-800">
                <h3 class="text-2xl">
                    Enter Email
                </h3>
            </div>
            <form id="inviteForm" class="flex flex-col">
                <div class="flex flex-col gap-4 p-6">
                    <div class="w-full max-w-sm min-w-[200px]">
                        <label class="block mb-2 text-sm text-slate-600">
                            Email
                        </label>
                        <input type="email" name="email" id="invite-email" required
                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            placeholder="Enter Email to invite" />
                    </div>
                    {{-- <input type="hidden" name="game_id" value="{{ $game->id }}"> --}}
                    <input type="hidden" name="invite_link" id="invite_link" value="{{ $link }}">
                </div>
                <div class="p-6 pt-0 flex justify-end">
                    <button type="submit" id="send_invite"
                        class="w-5/6 rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        Send Invite
                    </button>
                    <button type="button" id="copyLinkBtn"
                        class="w-1/6 rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inviteForm = document.getElementById('inviteForm');
        const copyLinkBtn = document.getElementById('copyLinkBtn');
        const sendBtn = document.getElementById('send_invite');

        // Change button text on click
        sendBtn.addEventListener('click', function() {
            sendBtn.textContent = 'Sending...';
        });

        inviteForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('invite-email').value;

            $.ajax({
                url: '{{ route("game.invite") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email,
                    inviteLink: $('#invite_link').val()
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Invitation sent successfully!',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = data.link;
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: 'Failed to send invitation. Please try again.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Failed to send invitation. Please try again.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            });
        });

        // function is not working
        copyLinkBtn.addEventListener('click', function() {
            const gameUrl = window.location.href;

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(gameUrl).then(() => {
                    alert('Game link copied to clipboard!');
                });
            } else {
                const textarea = document.createElement('textarea');
                textarea.value = gameUrl;
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    document.execCommand('copy');
                    alert('Game link copied to clipboard!');
                } catch (err) {
                    console.error('Failed to copy: ', err);
                    alert('Failed to copy game link. Please try again.');
                } finally {
                    document.body.removeChild(textarea);
                }
            }
        });
    });
</script>
