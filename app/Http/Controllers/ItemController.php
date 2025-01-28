<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Str;
use Kreait\Firebase\Contract\Storage;
use App\Models\Item;

class ItemController extends Controller
{
    private $database;
    private $storage;

    public function __construct()
    {
        $this->database = Firebase::database();
        $this->storage = Firebase::storage();  // Initialize Firebase Storage
    }

    /**
     * Display a listing of the items.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $items = $this->database->getReference('items')->getValue();
        $formattedItems = [];
    
        if (!empty($items)) {
            foreach ($items as $id => $item) {
                $item['id'] = $id;
                $item['image'] = isset($item['image']) && !empty($item['image'])
                    ? $item['image']
                    : 'https://via.placeholder.com/150';
    
                $formattedItems[] = $item;
            }
        }
    
        // Return JSON for API requests
        if ($request->is('api/*')) {
            return response()->json($formattedItems, 200);
        }

        // Return view for web requests
        return view('items.itemview', compact('formattedItems'));
    }

    public function showOnCustomerHome()
    {
        // Fetch items from Firebase
        $items = $this->database->getReference('items')->getValue();
        $items = is_array($items) ? $items : [];
    
        // Process each item to include a valid image URL
        $processedItems = [];
        foreach ($items as $id => $item) {
            $item['id'] = $id; // Add the ID to each item
    
            // Check if the item has an image
            $item['image_url'] = isset($item['image']) && !empty($item['image']) 
                ? $item['image']  // Use Firebase image URL or signed URL
                : asset('images/default-image.jpg');  // Default image
    
            $processedItems[] = $item;
        }
    
        // Pass the processed items to the view
        return view('customer.home', ['items' => $processedItems]);
    }

    /**
     * Store a newly created item in Firebase.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate($this->getValidationRules());

        // Handle image upload and get the signed URL
        $imageUrl = $this->handleImageUpload($request);

        // Prepare the item data
        $itemData = array_merge($validatedData, ['image' => $imageUrl]);

        // Store the item in Firebase
        $newItem = $this->database->getReference('items')->push($itemData);

        $response = [
            'message' => 'Item created successfully!',
            'item' => $itemData,
            'id' => $newItem->getKey(),
        ];
    
        if ($request->is('api/*')) {
            return response()->json($response, 201);
        }

        return redirect()->route('items.index')->with('success', 'Item created successfully!');
    }

    public function show(Request $request, $id)
    {
        try {
            // Fetch item from Firebase
            $item = $this->database->getReference('items/' . $id)->getValue();
            
            // Add debugging information
            \Log::info('Fetching item:', [
                'id' => $id,
                'item' => $item,
                'request_type' => $request->is('api/*') ? 'API' : 'Web'
            ]);

            if (!$item) {
                if ($request->is('api/*')) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Item not found',
                        'id_requested' => $id
                    ], 404);
                }
                return abort(404, 'Item not found.');
            }

            // Add the ID to the item data
            $item['id'] = $id;

            // Handle image URL
            $imageUrl = isset($item['image']) && !empty($item['image'])
                ? $item['image']
                : 'https://via.placeholder.com/150';
            
            $item['image'] = $imageUrl;

            // Return JSON for API requests
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Item retrieved successfully',
                    'data' => $item
                ], 200);
            }

            // Return view for web requests
            return view('items.viewitem', compact('item', 'imageUrl'));
        } catch (\Exception $e) {
            Log::error('Error fetching item:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error retrieving item',
                    'error' => $e->getMessage()
                ], 500);
            }

            throw $e;
        }
    }
    
    /**
     * Update the specified item in Firebase.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate($this->getValidationRules());

        // Handle image upload and get the signed URL
        $imageUrl = $this->handleImageUpload($request);

        // If no new image is uploaded, retain the existing image URL
        $imageUrl = $imageUrl ?: $request->input('existing_image');

        $itemData = array_merge($validatedData, [
            'image' => $imageUrl
        ]);

        $this->database->getReference('items/' . $id)->update($itemData);

        $response = [
            'message' => 'Item updated successfully!',
            'item' => $itemData,
            'id' => $id,
        ];
    
        if ($request->is('api/*')) {
            return response()->json($response, 200);
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }

    /**
     * Handle image upload and return a signed URL.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
    
            $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
    
            // Upload the image to Firebase Storage
            $bucket = $this->storage->getBucket();
            $fileStream = fopen($file->getRealPath(), 'r');
            $object = $bucket->upload($fileStream, [
                'name' => 'itemimages/' . $fileName,
                'predefinedAcl' => 'publicRead', // Make the file public
            ]);
    
            // Generate the public URL
            $publicUrl = "https://storage.googleapis.com/{$bucket->name()}/itemimages/{$fileName}";
    
            return $publicUrl; // Return the public URL
        }
    
        return null; // No image uploaded
    }
    

    /**
     * Get the validation rules for storing/updating items.
     *
     * @return array
     */
    private function getValidationRules()
    {
        return [
            'brand' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sale_price' => 'required|numeric',
            'rental_rate' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function destroy(Request $request, $id)
    {
        $item = $this->database->getReference('items/' . $id)->getValue();
    
        if (!$item) {
            $errorResponse = [
                'status' => 'error',
                'message' => 'Item not found.',
            ];
            if ($request->is('api/*')) {
                return response()->json($errorResponse, 404);
            }
            return redirect()->route('items.index')->with('error', $errorResponse['message']);
        }
    
        if (!empty($item['image'])) {
            $this->deleteImageFromStorage($item['image']);
        }
    
        $this->database->getReference('items/' . $id)->remove();
    
        $response = [
            'status' => 'success',
            'message' => 'Item deleted successfully.',
        ];
    
        if ($request->is('api/*')) {
            return response()->json($response, 200);
        }
    
        return redirect()->route('items.index')->with('success', $response['message']);
    }
    
    public function edit($id)
    {
        // Fetch the specific item from Firebase
        $item = $this->database->getReference('items/' . $id)->getValue();
    
        if (!$item) {
            abort(404, 'Item not found.');
        }
    
        // Attach the 'id' to the item if it doesn't exist
        $item['id'] = $id;
    
        // Generate the image URL
        $imageUrl = isset($item['image']) && !empty($item['image'])
            ? $item['image']  // Use the existing Firebase image URL
            : 'https://via.placeholder.com/150';  // Default placeholder image
    
        // Pass the item and imageUrl to the view
        return view('items.edititem', compact('item', 'imageUrl'));
    }
    
    

    /**
     * Delete the image from Firebase Storage.
     *
     * @param string $imageUrl
     * @return void
     */
    private function deleteImageFromStorage($imageUrl)
    {
        // Extract the file name from the image URL
        $fileName = basename($imageUrl);

        // Delete the image from Firebase Storage
        $bucket = $this->storage->getBucket();
        $bucket->object('itemimages/' . $fileName)->delete();
    }
}
