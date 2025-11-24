@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-6">💬 AI Chat Assistant</h1>

    <div class="bg-white rounded-lg shadow-lg" style="height: 600px; display: flex; flex-direction: column;">
        <!-- Chat Header -->
        <div class="bg-blue-600 text-white p-4 rounded-t-lg">
            <h2 class="text-xl font-bold">AI Travel Assistant</h2>
            <p class="text-sm opacity-90">I'm ready to help you with flight bookings</p>
        </div>

        <!-- Chat Messages -->
        <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4" style="max-height: 450px;">
            @forelse($messages as $message)
                <!-- User Message -->
                <div class="flex justify-end mb-4">
                    <div class="bg-blue-600 text-white rounded-lg px-4 py-2 max-w-xs lg:max-w-md">
                        <p class="text-sm">{{ $message->message }}</p>
                        <p class="text-xs opacity-75 mt-1">{{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}</p>
                    </div>
                </div>

                <!-- AI Response -->
                @if($message->response)
                    <div class="flex justify-start mb-4">
                        <div class="bg-gray-200 text-gray-800 rounded-lg px-4 py-2 max-w-xs lg:max-w-md">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-lg">🤖</span>
                                <span class="text-xs font-semibold text-blue-600">AI Assistant</span>
                            </div>
                            <p class="text-sm">{{ $message->response }}</p>
                            <p class="text-xs opacity-75 mt-1">{{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}</p>
                        </div>
                    </div>
                @endif
            @empty
                <div class="flex justify-center items-center h-full">
                    <div class="text-center text-gray-500">
                        <p class="text-lg mb-2">👋 Hello!</p>
                        <p>Start a conversation by typing a message below</p>
                        <div class="mt-4 text-left text-sm space-y-1">
                            <p class="font-semibold">Example questions:</p>
                            <p>• How to book a ticket?</p>
                            <p>• What classes are available?</p>
                            <p>• How to cancel a booking?</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Chat Input -->
        <div class="border-t p-4">
            <form id="chat-form" class="flex gap-2">
                @csrf
                <input type="text" id="message-input" placeholder="Type your message..." required class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium transition">
                    Send
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('chat-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value.trim();
    
    if (!message) return;
    
    const messagesContainer = document.getElementById('chat-messages');
    
    // Add user message to chat
    const userMessageDiv = document.createElement('div');
    userMessageDiv.className = 'flex justify-end mb-4';
    userMessageDiv.innerHTML = `
        <div class="bg-blue-600 text-white rounded-lg px-4 py-2 max-w-xs lg:max-w-md">
            <p class="text-sm">${message}</p>
            <p class="text-xs opacity-75 mt-1">${new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })}</p>
        </div>
    `;
    messagesContainer.appendChild(userMessageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
    
    // Clear input
    messageInput.value = '';
    
    // Show loading indicator
    const loadingDiv = document.createElement('div');
    loadingDiv.className = 'flex justify-start mb-4';
    loadingDiv.id = 'loading-message';
    loadingDiv.innerHTML = `
        <div class="bg-gray-200 text-gray-800 rounded-lg px-4 py-2">
            <p class="text-sm">Thinking...</p>
        </div>
    `;
    messagesContainer.appendChild(loadingDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
    
    // Send message to server
    fetch('{{ route("chat.send") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ message: message })
    })
    .then(response => response.json())
    .then(data => {
        // Remove loading indicator
        document.getElementById('loading-message').remove();
        
        // Add AI response
        const aiMessageDiv = document.createElement('div');
        aiMessageDiv.className = 'flex justify-start mb-4';
        aiMessageDiv.innerHTML = `
            <div class="bg-gray-200 text-gray-800 rounded-lg px-4 py-2 max-w-xs lg:max-w-md">
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-lg">🤖</span>
                    <span class="text-xs font-semibold text-blue-600">AI Assistant</span>
                </div>
                <p class="text-sm">${data.response}</p>
                <p class="text-xs opacity-75 mt-1">${new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })}</p>
            </div>
        `;
        messagesContainer.appendChild(aiMessageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loading-message').remove();
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'flex justify-start mb-4';
        errorDiv.innerHTML = `
            <div class="bg-red-100 text-red-800 rounded-lg px-4 py-2">
                <p class="text-sm">Sorry, an error occurred. Please try again.</p>
            </div>
        `;
        messagesContainer.appendChild(errorDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    });
});
</script>
@endsection
