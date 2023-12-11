<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;
use Twilio\Rest\Client;

class DialpadController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
    }

    public function index()
    {
        return view('dialpad');
    }

    public function handleDial(Request $request)
{
    try {
        $phoneNumber = $request->input('digit');

        // Log the received phone number for debugging
        \Log::info("Received phone number: $phoneNumber");

        // Your existing logic...

        // Log success for debugging
        \Log::info('Call initiated successfully.');

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error("Error: {$e->getMessage()}");

        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
}

    // Twilio voice endpoint
    public function twilioVoice()
    {
        \Log::info('Twilio Voice Endpoint Hit');
        $response = new VoiceResponse();
        $response->say('Hello, this is a dynamic message.');
    
        return response($response)->header('Content-Type', 'text/xml');
    }
    

    // You can add more robust validation logic based on your requirements
    private function isValidPhoneNumber($phoneNumber)
    {
        return is_numeric($phoneNumber) && strlen($phoneNumber) >= 10;
    }
}
