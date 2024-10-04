<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EskizService;

class SmsController extends Controller
{
    protected $eskizService;

    public function __construct(EskizService $eskizService)
    {
        $this->eskizService = $eskizService;
    }

    public function sendSms(Request $request)
    {
        
        $phoneNumber = $request->input('phone_number');
        $message = $request->input('message');

        $result = $this->eskizService->sendSms($phoneNumber, $message);
        
        if ($result && $result->status === 'success') {

            return response()->json(['message' => 'SMS successfully sent!']);

        }
        return response()->json(['message' => 'Failed to send SMS'], 500);
    }
}
