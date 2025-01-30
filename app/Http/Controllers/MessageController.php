<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index(Request $request)
{
    $userId = session('user_id'); // Get user ID from session
    $users = DB::table('users')->select('id', 'name')->get();
    $query = Message::where('recipient_id', $userId)->with('sender');

    // Apply search filter if input is provided
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('message_body', 'LIKE', "%$search%") // Corrected column name
              ->orWhereHas('sender', function ($q) use ($search) {
                  $q->where('name', 'LIKE', "%$search%");
              });
        });
    }

    $messages = $query->orderBy('created_at', 'desc')->get();

    return view('messages.test', compact('messages'));
}

    // Show the compose message form
    public function compose(Request $request)
    {
        $users = User::all(); // Fetch all users for the recipient dropdown
        return view('messages.compose', compact('users'));
    }

    // Send a message
    public function send(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message_body' => 'required|string',
        ]);

        $senderId = session('user_id'); // Get sender ID from session

        Message::create([
            'sender_id' => $senderId,
            'recipient_id' => $request->recipient_id,
            'subject' => $request->subject,
            'message_body' => $request->message_body,
        ]);
        session()->flash('success', 'Message sent successfully!');
        return redirect()->route('messages.index')->with('success', 'Message sent successfully!');
    }

    // View a specific message
    public function show(Request $request, $id)
    {
        $userId = session('user_id'); // Get user ID from session

        $message = Message::where('id', $id)
            ->where('recipient_id', $userId) // Ensure only the recipient can view the message
            ->firstOrFail();

        // Mark the message as read
        $message->update(['is_read' => true]);

        return view('messages.show', compact('message'));
    }
   
}