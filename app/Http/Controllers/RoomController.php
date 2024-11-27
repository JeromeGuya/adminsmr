<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::orderBy('created_at', 'desc')->paginate(5);
        return view('rooms.view_rooms', compact('rooms'));
    }

    /**
     * Show the form for creating a new room.
     */
    public function create()
    {
        return view('rooms.add_rooms');
    }

    /**
     * Store a newly created room in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'room_type'      => 'required|string|max:255',
            'rate'          => 'required|numeric|min:0',
            'availability'   => 'required|integer|min:0',
            'description'    => 'nullable|string',
            'image_url'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Single image
        ]);

        $image = $request->file('image_url');


        $imageExtension = $image->getClientOriginalExtension();
        $imageName = $validated['room_type'] . '.' . $imageExtension;
        $folderPath = 'images/' . $imageName;


        $fileContents = file_get_contents($image->getPathname());

        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY');
        $bucketName = 'ecolodgesmr';

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $supabaseKey,
            ])
                ->attach('file', $fileContents, $imageName) // Correct file upload method
                ->post("{$supabaseUrl}/storage/v1/object/{$bucketName}/{$folderPath}");

            if ($response->successful()) {
                $publicUrl = "{$supabaseUrl}/storage/v1/object/public/{$bucketName}/{$folderPath}";
                $validated['image_url'] = $publicUrl;
            } else {
                return redirect()->back()->withErrors(['image' => 'Failed to upload image to Supabase']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
        }

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }


    public function edit($id)
    {
        $room = Room::findOrFail($id); // Find the specific room being edited
        $roomTypes = Room::select('name')->distinct()->pluck('name');
        $roomAmenities = $room->amenities ? explode(',', $room->amenities) : []; // Decode stored amenities (if JSON)

        return view('rooms.edit_rooms', compact('room', 'roomAmenities', 'roomTypes'));
    }


    public function update(Request $request, Room $room)
    {
        // Validate the inputs
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'room_type'     => 'required|string|max:255',
            'availability'  => 'required|integer|min:0',
            'description'   => 'nullable|string',
            'rate'          => 'required|numeric|min:0',
            'image_url'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Single image
        ]);

        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY');
        $bucketName = 'ecolodgesmr';

        // Handle image upload if a new file is provided
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = $validated['room_type'] . '.' . $imageExtension; // No timestamp
            $folderPath = 'images/' . $imageName;

            $fileContents = file_get_contents($image->getPathname());

            try {
                // Delete old image if it exists
                if ($room->image_url) {
                    $oldImagePath = str_replace(
                        "{$supabaseUrl}/storage/v1/object/public/{$bucketName}/",
                        '',
                        $room->image_url
                    );

                    $deleteResponse = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $supabaseKey,
                    ])->delete("{$supabaseUrl}/storage/v1/object/{$bucketName}/{$oldImagePath}");

                    if (!$deleteResponse->successful()) {
                        logger('Failed to delete old image: ' . $deleteResponse->body());
                    }
                }

                // Upload the new image to Supabase
                $uploadResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $supabaseKey,
                ])->attach('file', $fileContents, $imageName)
                    ->post("{$supabaseUrl}/storage/v1/object/{$bucketName}/{$folderPath}");

                if ($uploadResponse->successful()) {
                    $publicUrl = "{$supabaseUrl}/storage/v1/object/public/{$bucketName}/{$folderPath}";
                    $validated['image_url'] = $publicUrl;
                } else {
                    return redirect()->back()->withErrors([
                        'image' => 'Failed to upload image to Supabase: ' . $uploadResponse->body()
                    ]);
                }
            } catch (\Exception $e) {
                return redirect()->back()->withErrors([
                    'image' => 'Failed to process image: ' . $e->getMessage()
                ]);
            }
        }

        // Update the room with the validated data
        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }


    /**
     * Remove the specified room from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();

        // Redirect with success message
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
