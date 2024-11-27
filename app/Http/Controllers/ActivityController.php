<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActivityController extends Controller
{
    public function index()
    {
        $activity = Activity::orderBy('created_at', 'desc')->paginate(5);
        return view('activity.view_activity', compact('activity'));
    }

    public function create()
    {
        return view('activity.add_activity');
    }

    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('activity.edit_activity', compact('activity'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_name'        => 'required|string|max:255',
            'activity_description' => 'nullable|string',
            'availability'         => 'required|integer|min:0',
            'rate'                 => 'required|numeric|min:0',
            'package'              => 'nullable|string|max:255',
            'inclusions'           => 'nullable|string',
            'image_url'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Single image
        ]);

        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY');
        $bucketName = 'ecolodgesmr';

        // Handle image upload if provided
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = $validated['activity_name'] . '.' . $imageExtension; // Unique image name
            $folderPath = 'images/' . $imageName;

            $fileContents = file_get_contents($image->getPathname());

            try {
                // Upload image to Supabase storage
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
        }

        // Save activity details to the database
        Activity::create($validated);

        return redirect()->route('activity.index')->with('success', 'Activity added successfully.');
    }

    public function update(Request $request, Activity $activity)
    {
        // Validate the inputs
        $validated = $request->validate([
            'activity_name'        => 'required|string|max:255',
            'activity_description' => 'required|string',
            'availability'         => 'required|integer|min:0',
            'rate'                 => 'required|numeric|min:0',
            'package'              => 'nullable|string|max:255',
            'inclusions'           => 'nullable|string',
            'image_url'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Single image
        ]);

        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY');
        $bucketName = 'ecolodgesmr';

        // Handle image upload if a new file is provided
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = $validated['activity_name'] . '.' . $imageExtension;
            $folderPath = 'images/' . $imageName;

            $fileContents = file_get_contents($image->getPathname());

            try {
                // Delete old image if it exists
                if ($activity->image_url) {
                    $oldImagePath = str_replace(
                        "{$supabaseUrl}/storage/v1/object/public/{$bucketName}/",
                        '',
                        $activity->image_url
                    );

                    logger('Attempting to delete old image at path: ' . $oldImagePath);

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

        // Update the activity with the validated data
        $activity->update($validated);

        return redirect()->route('activity.index')->with('success', 'Activity updated successfully.');
    }


    public function destroy(Activity $activity)
    {
        // Delete the activity
        $activity->delete();

        // Redirect back to the activity index page with a success message
        return redirect()->route('activity.index')->with('success', 'Activity deleted successfully!');
    }

}
