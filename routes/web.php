<?php

use App\Exports\ApprovedBookingsExport;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CottageController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ReportController;


Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'] )->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

      Route::delete('/bookings/{id}/refund', [RoomController::class, 'refundRoom'])->name('bookings.refund');

    //Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    //Employee
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employees.store');
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('employees.update');


    //Rooms
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::get('/rooms/{room_id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');


    //Activity
    Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');
    Route::get('/activity/create', [ActivityController::class, 'create'])->name('activity.create');
    Route::get('/activity/{activity_id}/edit', [ActivityController::class, 'edit'])->name('activity.edit');
    Route::post('/activities', [ActivityController::class, 'store'])->name('activity.store');
    Route::put('/activity/{activity}', [ActivityController::class, 'update'])->name('activity.update');
    Route::delete('/activity/{activity}', [ActivityController::class, 'destroy'])->name('activity.destroy');


    //Cottages
    Route::get('/cottage', [CottageController::class, 'index'])->name('cottage.index');
    Route::get('/cottage/create', [CottageController::class, 'create'])->name('cottage.create');
    Route::get('/cottage/{pool_id}/edit', [CottageController::class, 'edit'])->name('cottage.edit');
    Route::post('/cottages', [CottageController::class, 'store'])->name('cottages.store');
    Route::delete('/cottages/{cottages}', [CottageController::class, 'destroy'])->name('cottages.destroy');
    Route::put('/cottages/{cottages}', [CottageController::class, 'update'])->name('cottage.update');

    //Function Hall
    Route::get('/function_hall', [HallController::class, 'index'])->name('hall.index');
    Route::get('/function_hall/create', [HallController::class, 'create'])->name('hall.create');
    Route::get('/function_hall/{hall_id}/edit', [HallController::class, 'edit'])->name('hall.edit');
    Route::post('/function_hall', [HallController::class, 'store'])->name('hall.store');
    Route::put('/function_hall/{hall}', [HallController::class, 'update'])->name('hall.update');

    //Room Bookings
    Route::get('/bookings/room/approved', [BookingController::class, 'roomApprovedBooking'])->name('room.approved.booking');
    Route::get('/bookings/room/approved/{booking_id}', [BookingController::class, 'roomApprovedPayment'])->name('room.approved.payment');
    Route::put('/bookings/room/{booking_id}/fullpaid', [BookingController::class, 'approveRoomPayment'])->name('approve.room.payment');
    Route::get('/bookings/room/pending', [BookingController::class, 'roomPendingBooking'])->name('room.pending.booking');
    Route::get('/bookings/room/pending/{booking_id}', [BookingController::class, 'roomPendingShow'])->name('room.pending.show');
    Route::get('/bookings/room/{booking_id}/edit', [BookingController::class, 'roomBookingEdit'])->name('room.booking.edit');
    Route::put('/bookings/room/{booking_id}/approve', [BookingController::class, 'roomBookingApprove'])->name('room.booking.approve');
    Route::get('/booking/room/canceled', [BookingController::class, 'roomCancelBooking'])->name('room.cancel.booking');
    Route::delete('booking/room/approved/{id}', [BookingController::class, 'deleteApproved'])->name('room.approved.delete');


    //Cottage Bookings
    Route::get('/booking/cottage/approved', [BookingController::class, 'cottageApproveBooking'])->name('cottage.approved.booking');
    Route::get('/bookings/cottages/approved/{booking_id}', [BookingController::class, 'cottageApprovePayment'])->name('cottage.approve.payment');
    Route::put('/bookings/cottage/{booking_id}/fullpaid', [BookingController::class, 'approveCottagePayment'])->name('approve.cottage.payment');
    Route::get('/bookings/cottage/pending', [BookingController::class, 'cottagePendingBooking'])->name('cottage.pending.booking');
    Route::get('/booking/cottage/pending/{booking_id}', [BookingController::class, 'cottagePendingShow'])->name('cottage.pending.show');
    Route::put('/booking/cottage/{booking_id}/approve', [BookingController::class, 'cottageBookingApprove'])->name('cottage.booking.approve');
    Route::get('/booking/cottage/canceled', [BookingController::class, 'cottageCancelBooking'])->name('cottage.cancel.booking');
    Route::delete('booking/cottages/{id}', [BookingController::class, 'cottageDestroy'])->name('cottages.destroy.booking');

    //Activity Bookings
    Route::get('/booking/activity/approved', [BookingController::class, 'activityApproveBooking'])->name('activity.approved.booking');
    Route::get('/bookings/activity/approved/{booking_id}', [BookingController::class, 'activityApprovePayment'])->name('activity.approve.payment');
    Route::put('/bookings/activity/{booking_id}/fullpaid', [BookingController::class, 'approveActivityPayment'])->name('approve.activity.payment');
    Route::get('/bookings/activity/pending', [BookingController::class, 'activityPendingBooking'])->name('activity.pending.booking');
    Route::get('/booking/activity/pending/{booking_id}', [BookingController::class, 'activityPendingShow'])->name('activity.pending.show');
    Route::put('/booking/activity/{booking_id}/approve', [BookingController::class, 'activityBookingApprove'])->name('activity.booking.approve');
    Route::get('/booking/activity/canceled', [BookingController::class, 'activityCancelBooking'])->name('activity.cancel.booking');
    Route::delete('booking/activity/{id}', [BookingController::class, 'activityDestroy'])->name('activity.destroy.booking');

    //Function Hall
    Route::get('/booking/function_hall/approved', [BookingController::class, 'functionApproveBooking'])->name('function.approved.booking');
    Route::get('/bookings/function_hall/approved/{booking_id}', [BookingController::class, 'functionApprovePayment'])->name('function.approve.payment');
    Route::put('/bookings/function_hall/{booking_id}/fullpaid', [BookingController::class, 'approveFunctionPayment'])->name('approve.function.payment');
    Route::get('/bookings/function_hall/pending', [BookingController::class, 'functionPendingBooking'])->name('function.pending.booking');
    Route::get('/booking/function_hall/pending/{booking_id}', [BookingController::class, 'functionPendingShow'])->name('function.pending.show');
    Route::put('/booking/function_hall/{booking_id}/approve', [BookingController::class, 'functionBookingApprove'])->name('function.booking.approve');
    Route::get('/booking/function_hall/canceled', [BookingController::class, 'functionCancelBooking'])->name('function.cancel.booking');
    Route::delete('booking/function_hall/{id}', [BookingController::class, 'functionDestroy'])->name('function.destroy.booking');

    //Delete All Bookings
    Route::delete('/booking/{booking_id}', [BookingController::class, 'destroy'])->name('booking.destroy');

    //OverAll
    Route::get('/bookings/approved', [BookingController::class, 'approvedBookings'])->name('bookings.approved');
    Route::get('/bookings/refund', [BookingController::class, 'refundBookings'])->name('bookings.refund');

    //Reports
    Route::get('/approved-bookings-report', [BookingController::class, 'approvedBookingsReport'])->name('approvedBookingsReport');
    Route::get('approved-bookings-export', [ReportController::class, 'downloadApprovedReport'])->name('approvedBookingsExport');

    //Email
    Route::post('/email/{id}/email', [BookingController::class, 'sendEmail'])->name('bookings.email');

    //Feedback
    Route::get('feedbacks', [FeedbackController::class, 'feedbacks'])->name('feedbacks');

    //Notif
    Route::get('/notifications', [AdminController::class, 'getNotifications']);

    Route::get('/announcement', [AdminController::class, 'announcementIndex'])->name('announce.admin');
    Route::post('/announcement', [AdminController::class, 'announcementStore'])->name('announcements.store');

});


Route::view('/', 'index')->name('login');
Route::post('/login', [AdminController::class, 'store']);
