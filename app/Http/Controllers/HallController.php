<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HallController extends Controller
{
    public function index()
    {
        $hall = Hall::orderBy('created_at', 'desc')->paginate(5);
        return view('function_hall.view_function_hall', compact('hall'));
    }

    public function create()
    {
        return view('function_hall.add_function_hall');
    }


    public function edit($id)
    {
        $hall = Hall::findOrFail($id);
        return view('function_hall.edit_function_hall', compact('hall'));
    }


    public function store(Request $request)
    {
        // Validate the input fields for the function hall
        $validated = $request->validate([
            'hall_name'        => 'required|string|max:255',
            'hall_type'        => 'nullable|string|max:255',
            'rate'             => 'required|numeric|min:0',
            'description'      => 'nullable|string',
            'availability'     => 'required|integer|min:0',
            'image_url'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Single image for the hall
        ]);

        // Supabase configuration
        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY');
        $bucketName = 'ecolodgesmr';  // Your Supabase bucket name

        // Handle image upload if provided
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = $validated['hall_name'] . '.' . $imageExtension; // Unique image name
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
                    // Store the public URL of the uploaded image
                    $publicUrl = "{$supabaseUrl}/storage/v1/object/public/{$bucketName}/{$folderPath}";
                    $validated['image_url'] = $publicUrl;
                } else {
                    // If the upload fails, return with an error
                    return redirect()->back()->withErrors(['image' => 'Failed to upload image to Supabase']);
                }
            } catch (\Exception $e) {
                // Handle any exception during the image upload
                return redirect()->back()->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
            }
        }

        // Save the validated data to the 'function_halls' table
        Hall::create($validated);

        // Redirect to the function halls index with a success message
        return redirect()->route('hall.index')->with('success', 'Function Hall added successfully.');
    }


    public function update(Request $request, Hall $hall)
    {
        // Validate the inputs
        $validated = $request->validate([
            'hall_name'            => 'required|string|max:255',
            'hall_type'            => 'required|string|max:255',
            'rate'                 => 'required|numeric|min:0',
            'availability'         => 'required|integer|min:0',
            'description'          => 'nullable|string',
            'image_url'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Single image
        ]);

        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY');
        $bucketName = 'ecolodgesmr';  // You can adjust this depending on the bucket you're using

        // Handle image upload if a new file is provided
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = $validated['hall_name'] . '.' . $imageExtension;
            $folderPath = 'images/' . $imageName;

            $fileContents = file_get_contents($image->getPathname());

            try {
                // Delete old image if it exists
                if ($hall->image_url) {
                    $oldImagePath = str_replace(
                        "{$supabaseUrl}/storage/v1/object/public/{$bucketName}/",
                        '',
                        $hall->image_url
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

        // Update the function hall with the validated data
        $hall->update($validated);

        return redirect()->route('hall.index')->with('success', 'Function Hall updated successfully.');
    }



}
