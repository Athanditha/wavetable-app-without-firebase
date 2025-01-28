<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Storage;

class FirebaseService
{
    protected $database;
    protected $storage;

    public function __construct()
    {
        // Corrected this line, removed the extra semicolon.
        $firebase = (new Factory)
            ->withServiceAccount(storage_path('firebase_credentials.json')) // Correct file path
            ->create();

        $this->database = $firebase->getDatabase();
        $this->storage = $firebase->getStorage();
    }

    public function uploadImage($image)
    {
        // Get the storage bucket
        $storageBucket = $this->storage->getBucket();
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension(); // Generate a unique name for the file

        // Upload the image to Firebase Storage
        $storageBucket->upload($image->getRealPath(), [
            'name' => 'items/' . $fileName // Path in Firebase Storage
        ]);

        // Get the public URL for the uploaded file
        $imageUrl = $this->storage->getBucket()->object('items/' . $fileName)->signedUrl(now()->addMinutes(5));

        return $imageUrl; // Return URL for storing in Firebase Realtime Database or Firestore
    }

    public function seedData($data)
    {
        // Assuming 'items' is the name of the collection/table you want to add data to
        $newItem = $this->database->getReference('items')->push($data);
        return $newItem->getKey(); // Return the Firebase generated key for the item
    }
}
