<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedbacks()
    {
        $feedbacks = Feedback::with('user')->get();
        return view('bookings.feedback', compact('feedbacks'));
    }
}
