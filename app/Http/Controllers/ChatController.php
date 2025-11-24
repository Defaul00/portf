<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Show chat interface
     */
    public function index()
    {
        $messages = Auth::user()->chatMessages()->latest()->take(50)->orderBy('created_at', 'asc')->get();
        return view('chat.index', compact('messages'));
    }

    /**
     * Send message and get AI response
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = $request->message;
        $response = $this->generateAIResponse($userMessage);

        ChatMessage::create([
            'user_id' => Auth::id(),
            'message' => $userMessage,
            'response' => $response,
            'is_ai' => true,
        ]);

        return response()->json([
            'success' => true,
            'response' => $response,
        ]);
    }

    /**
     * Generate AI response (simple rule-based for now)
     */
    private function generateAIResponse($message)
    {
        $message = strtolower($message);
        
        $responses = [
            'hi' => 'Hello! Welcome to our flight booking assistance service. How can I help you?',
            'hello' => 'Hello! How can I assist you with your flight booking?',
            'book' => 'To make a booking, please select an available flight and fill in passenger details. Do you have any questions about flights?',
            'price' => 'Ticket prices vary depending on route, class, and date. Please use the search feature to see available prices.',
            'cancel' => 'To cancel a booking, you can click the "Cancel" button on your booking details in the My Bookings page.',
            'class' => 'We provide 3 classes: Economy, Business, and First Class.',
            'pay' => 'Payment can be made through various methods available after you make a booking.',
            'contact' => 'For further assistance, please contact us via email or phone available on the contact page.',
            'thank' => 'You\'re welcome! Have a safe flight! If you have any other questions, feel free to ask.',
            'thanks' => 'You\'re welcome! Have a safe flight!',
            'default' => 'Thank you for your question. Please provide more specific details so I can help you better. You can ask about booking, prices, classes, or ticket cancellation.'
        ];

        // Find matching response
        foreach ($responses as $key => $value) {
            if ($key !== 'default' && str_contains($message, $key)) {
                return $value;
            }
        }

        return $responses['default'];
    }
}
