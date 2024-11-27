<?php

namespace App\Http\Controllers;

use App\Mail\RecieptEmail;
use App\Models\Booking;
use App\Models\Pool;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{

    //Room Controller
    public function roomPendingBooking()
    {
        $bookings = Booking::with(['user', 'room'])
            ->where('booking_status', 'Pending')
            ->whereNotNull('room_id') //
            ->paginate(7);

        return view('bookings.rooms.view_pending_room', compact('bookings'));
    }

    public function roomPendingShow($id)
    {
        $booking = Booking::with(['user', 'room'])->findOrFail($id);

        return view('bookings.rooms.show_pending_room', compact('booking'));
    }

    public function roomBookingEdit($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        $rooms = Room::whereNotNull('room_type')
            ->whereNotNull('room_capacity')
            ->get();
        return view('bookings.rooms.edit_room_booking', compact('booking', 'rooms'));
    }

    public function roomBookingApprove($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->booking_status = 'Approved';
        $booking->save();

        return redirect()->route('room.pending.booking', $booking->booking_id)->with('success', 'Booking approved successfully.');
    }

    public function roomApprovedBooking()
    {
        $bookings = Booking::with(['user', 'room'])
            ->where('booking_status', 'Approved')
            ->whereNotNull('room_id') //
            ->paginate(7);

        return view('bookings.rooms.view_approved_room', compact('bookings'));
    }

    public function roomApprovedPayment($id)
    {
        $booking = Booking::with(['user', 'room'])->findOrFail($id);

        return view('bookings.rooms.show_approved_room', compact('booking'));
    }

    public function approveRoomPayment($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->payment_status = 'Fully Paid';
        $booking->save();

        return redirect()->route('room.approved.payment', $booking->booking_id)->with('success', 'Booking approved successfully.');
    }

    public function roomCancelBooking()
    {
        $bookings = Booking::with(['user', 'room'])
            ->where('booking_status', 'Declined')
            ->whereNotNull('room_id') //
            ->paginate(7);

        return view('bookings.rooms.view_canceled_rooms', compact('bookings'));
    }


    //Cottages
    public function cottagePendingBooking()
    {
        $bookings = Booking::with(['user', 'pool'])
            ->where('booking_status', 'Pending')
            ->whereNotNull('pool_id') //
            ->paginate(7);

        return view('bookings.cottages.view_pending_cottage', compact('bookings'));
    }

    public function cottagePendingShow($id)
    {
        $booking = Booking::with(['user', 'pool'])->findOrFail($id);

        return view('bookings.cottages.show_pending_cottage', compact('booking'));
    }

    public function cottageBookingApprove($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->booking_status = 'Approved';
        $booking->save();

        return redirect()->route('cottage.pending.show', $booking->booking_id)->with('success', 'Booking approved successfully.');
    }

    public function cottageApproveBooking()
    {
        $bookings = Booking::with(['user', 'pool'])
            ->where('booking_status', 'Approved')
            ->whereNotNull('pool_id') //
            ->paginate(7);

        return view('bookings.cottages.view_approved_cottage', compact('bookings'));
    }

    public function cottageCancelBooking()
    {
        $bookings = Booking::with(['user', 'pool'])
            ->where('booking_status', 'Declined')
            ->whereNotNull('pool_id') //
            ->paginate(7);

        return view('bookings.cottages.view_cancelled_cottages', compact('bookings'));
    }


    public function cottageApprovePayment($id)
    {
        $booking = Booking::with(['user', 'pool'])->findOrFail($id);

        return view('bookings.cottages.show_approved_cottage', compact('booking'));
    }

    public function approveCottagePayment($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->payment_status = 'Fully Paid';
        $booking->save();

        return redirect()->route('cottage.approve.payment', $booking->booking_id)->with('success', 'Booking approved successfully.');
    }

    //Activity Bookings
    public function activityApproveBooking()
    {
        $bookings = Booking::with(['user', 'activity'])
            ->where('booking_status', 'Approved')
            ->whereNotNull('activity_id') //
            ->paginate(7);

        return view('bookings.activity.view_approved_activity', compact('bookings'));
    }

    public function activityApprovePayment($id)
    {
        $booking = Booking::with(['user', 'activity'])->findOrFail($id);

        return view('bookings.activity.show_approved_activity', compact('booking'));
    }

    public function approveActivityPayment($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->payment_status = 'Fully Paid';
        $booking->save();

        return redirect()->route('activity.approve.payment', $booking->booking_id)->with('success', 'Booking approved successfully.');
    }

    public function activityPendingBooking()
    {
        $bookings = Booking::with(['user', 'activity'])
            ->where('booking_status', 'Pending')
            ->whereNotNull('activity_id') //
            ->paginate(7);

        return view('bookings.activity.view_pending_activity', compact('bookings'));
    }

    public function activityPendingShow($id)
    {
        $booking = Booking::with(['user', 'activity'])->findOrFail($id);

        return view('bookings.activity.show_pending_activity', compact('booking'));
    }

    public function activityBookingApprove($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->booking_status = 'Approved';
        $booking->save();

        return redirect()->route('activity.pending.show', $booking->booking_id)->with('success', 'Booking approved successfully.');
    }

    public function activityCancelBooking()
    {
        $bookings = Booking::with(['user', 'activity'])
            ->where('booking_status', 'Declined')
            ->whereNotNull('activity_id') //
            ->paginate(7);

        return view('bookings.activity.view_cancelled_activity', compact('bookings'));
    }

    //Function Hall Booking
    public function functionApproveBooking()
    {
        $bookings = Booking::with(['user', 'hall'])
            ->where('booking_status', 'Approved')
            ->whereNotNull('hall_id') //
            ->paginate(7);

        return view('bookings.function_hall.view_approved_function', compact('bookings'));
    }

    public function functionApprovePayment($id)
    {
        $booking = Booking::with(['user', 'hall'])->findOrFail($id);

        return view('bookings.function_hall.show_approved_function', compact('booking'));
    }

    public function approveFunctionPayment($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->payment_status = 'Fully Paid';
        $booking->save();

        return redirect()->route('function.approve.payment', $booking->booking_id)->with('success', 'Booking approved successfully.');
    }

    public function functionPendingBooking()
    {
        $bookings = Booking::with(['user', 'hall'])
            ->where('booking_status', 'Pending')
            ->whereNotNull('hall_id') //
            ->paginate(7);

        return view('bookings.function_hall.view_pending_function', compact('bookings'));
    }

    public function functionPendingShow($id)
    {
        $booking = Booking::with(['user', 'hall'])->findOrFail($id);

        return view('bookings.function_hall.show_pending_function', compact('booking'));
    }

    public function functionBookingApprove($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->booking_status = 'Approved';
        $booking->save();

        return redirect()->route('function.pending.show', $booking->booking_id)->with('success', 'Booking approved successfully.');
    }

    public function functionCancelBooking()
    {
        $bookings = Booking::with(['user', 'hall'])
            ->where('booking_status', 'Declined')
            ->whereNotNull('hall_id') //
            ->paginate(7);

        return view('bookings.function_hall.view_cancelled_function', compact('bookings'));
    }

    //Delete Bookings
    public function destroy($booking_id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($booking_id);

        // Delete the booking record
        $booking->delete();

        // Redirect back to the previous page with a success message
        return back()->with('success', 'Booking deleted successfully!');
    }

    //Overall
    public function approvedBookings()
    {
        $bookings = Booking::where('payment_status', 'Fully Paid')
            ->where('booking_status', 'Approved')
            ->with(['user', 'room', 'pool', 'activity', 'hall']) // Eager load relationships
            ->get();

        return view('bookings.approve_booking', ['bookings' => $bookings]);
    }

    public function pendingBookings()
    {
        $bookings = Booking::where(function ($query) {
            $query->where('payment_status', 'Partial')
                ->where('booking_status', 'Pending')
                ->orWhere(function ($query) {
                    $query->where('payment_status', 'Partial')
                        ->where('booking_status', 'Approved');
                });
        })
            ->with(['user', 'room', 'pool', 'activity', 'hall']) // Eager load relationships
            ->get();

        return view('bookings.pending_booking', ['bookings' => $bookings]);
    }


    //Overall Report
    public function approvedBookingsReport()
    {
        // Fetch all approved bookings with relationships
        $bookings = Booking::where('booking_status', 'Approved')
            ->with(['user', 'room', 'pool', 'activity', 'hall']) // Eager load relationships
            ->get();

        // Calculate total payment
        $totalPayments = $bookings->sum('total_amount');

        return view('bookings.reports.approved_bookings_report', [
            'bookings' => $bookings,
            'totalPayments' => $totalPayments
        ]);
    }

    //Send Email
    public function sendEmail(Request $request, $id)
    {
        // Retrieve the booking with all possible relationships, including 'cottage'
        $booking = Booking::with(['user', 'room', 'pool', 'activity', 'hall'])->findOrFail($id);

        // Define a mapping of booking types to their relationships, redirect routes, and required parameters
        $bookingTypes = [
            'room' => [
                'relation' => 'room',
                'route' => 'bookings.show', // Requires 'booking_id'
                'params' => ['booking_id' => $booking->booking_id],
            ],
            'activity' => [
                'relation' => 'activity',
                'route' => 'approvedActivity.show', // Ensure this matches your route name
                'params' => ['booking_id' => $booking->booking_id],
            ],
            'functionHall' => [
                'relation' => 'hall',
                'route' => 'functionHall.approved', // No parameters needed
            ],
            'pool' => [
                'relation' => 'pool',
                'route' => 'cottage.approve.payment',
                'params' => ['booking_id' => $booking->booking_id],
            ],
            // Add more booking types as needed
        ];

        $bookingType = null;
        $redirectRoute = 'dashboard'; // Default route if booking type is unknown
        $routeParams = []; // Default empty parameters

        // Determine the booking type based on which relationship is set
        foreach ($bookingTypes as $type => $info) {
            if ($booking->{$info['relation']} !== null) {
                $bookingType = $type;
                $redirectRoute = $info['route'];
                $routeParams = $info['params'] ?? []; // Assign parameters if they exist
                break;
            }
        }

        if (!$bookingType) {
            // Handle unknown booking type
            return redirect()->route('dashboard')->with('error', 'Unknown booking type.');
        }

        // Optional: Add any additional information you want to include in the email
        $additionalInfo = "We have updated your booking for " . ucfirst($bookingType) . ". Please check the details above.";

        try {
            // Send the email using the BookingStatusEmail Mailable
            Mail::to($booking->user->email)->send(new RecieptEmail($booking, $additionalInfo));

            // Redirect to the appropriate route with a success message
            return redirect()->route($redirectRoute, $routeParams)->with('success', 'Email sent successfully to the customer.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Email Sending Error: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route($redirectRoute, $routeParams)->with('error', 'Failed to send email.');
        }
    }


}
