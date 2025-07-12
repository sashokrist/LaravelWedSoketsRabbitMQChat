@extends('layouts.app')

@section('content')
<h2>Chat Room</h2>

<form id="chat-form">
    @csrf
    <input type="text" id="message" name="message" placeholder="Type message..." required>
    <button type="submit">Send</button>
</form>

<ul id="chat-box"></ul>
<script src="/sanctum/csrf-cookie"></script>

@vite('resources/js/app.js')
@endsection

@push('scripts')
    @vite('resources/js/app.js')
    <script>
        document.getElementById('chat-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = document.getElementById('message').value;

            await fetch('/send-message', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ message })
            });

            document.getElementById('message').value = '';
        });

        Echo.channel('chat')
    .listen('MessageSent', (e) => {
        console.log('📩 PUBLIC Message received:', e);
        const box = document.getElementById('chat-box');
        const item = document.createElement('li');
        item.textContent = `${e.user.name}: ${e.message}`;
        box.appendChild(item);
    });

    </script>
    <script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'user' => auth()->user(),
    ]) !!};
</script>
@endpush
