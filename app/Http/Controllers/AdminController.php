<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $fullyPaidCount = Booking::where('payment_status', 'Fully Paid')
            ->where('booking_status', 'Approved')
            ->count();

        $pendingCount = Booking::where(function ($query) {
            $query->where('payment_status', 'Fully Paid')
                ->orWhere('payment_status', 'Partial');
        })
            ->where('booking_status', 'Pending')
            ->count();

        // Retrieve the average rating and count of feedback
        $averageRating = Feedback::selectRaw('AVG(CAST(rating AS FLOAT)) as avg_rating')
            ->value('avg_rating');
        $feedbackCount = Feedback::count();

        return view('admin.admin_dashboard', compact(
            'fullyPaidCount',
            'pendingCount',
            'averageRating',
            'feedbackCount'
        ));
    }

    public function store()
    {
        $validate = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (!Auth::guard('admin')->attempt($validate)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        request()->session()->regenerate();

        return redirect('/dashboard');

    }

    public function logout(Request $request)
    {
        // Logout the user
        Auth::logout();

        // Invalidate the session and regenerate the CSRF token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the home page or any other page after logout
        return redirect('/');
    }



}
