<?php

namespace App\Http\Controllers;

use App\Models\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CottageController extends Controller
{
    public function index()
    {
        $cottage = Pool::orderByRaw('created_at IS NULL, created_at DESC')->paginate(5);
        return view('cottages.view_cottages', compact('cottage'));
    }


    public function create()
    {
        return view('cottages.add_cottages');
    }

    public function edit($id)
    {
        $cottage = Pool::findOrFail($id);
        $cottageTypes = Pool::whereNotNull('cottage_type')
            ->select('cottage_type')
            ->distinct()
            ->pluck('cottage_type');
        return view('cottages.edit_cottage', compact('cottage', 'cottageTypes'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cottage_name'  => 'required|string|max:255',
            'cottage_type'  => 'required|string|max:255',
            'availability'  => 'required|integer|min:0',
            'description'   => 'nullable|string',
            'rate'          => 'required|numeric|min:0',
            'image_url'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Single image
        ]);

        // Handle image upload
        $image = $request->file('image_url');
        $imageExtension = $image->getClientOriginalExtension();
        $imageName = $validated['cottage_name'] . '.' . $imageExtension; // Unique image name
        $folderPath = 'images/' . $imageName;

        $fileContents = file_get_contents($image->getPathname());

        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_KEY');
        $bucketName = 'ecolodgesmr';

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

        // Save cottage details to the database
        Pool::create($validated);

        return redirect()->route('cottage.index')->with('success', 'Cottage added successfully.');
    }

    public function destroy(Pool $cottages)
    {
        $cottages->delete();

        // Redirect with success message
        return redirect()->route('cottage.index')->with('success', 'Cottage deleted successfully.');
    }

    public function update(Request $request, Pool $cottages)
    {
        // Validate the inputs
        $validated = $request->validate([
            'cottage_name'  => 'required|string|max:255',
            'cottage_type'  => 'required|string|max:255',
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
            $imageName = $validated['cottage_type'] . '.' . $imageExtension;
            $folderPath = 'images/' . $imageName;

            $fileContents = file_get_contents($image->getPathname());

            try {
                // Delete old image if it exists
                if ($cottages->image_url) {
                    $oldImagePath = str_replace(
                        "{$supabaseUrl}/storage/v1/object/public/{$bucketName}/",
                        '',
                        $cottages->image_url
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

        // Update the cottage with the validated data
        $cottages->update($validated);

        return redirect()->route('cottage.index')->with('success', 'Cottage updated successfully.');
    }


}
