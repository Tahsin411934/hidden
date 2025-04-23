<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
   
 // SignatureController.php
public function create()
{
    // Check for existing admin signature
    $signature = Signature::where('branch', 'admin')->first();
    
    return view('central.signatures.create', [
        'existingSignature' => $signature
    ]);
}
public function branchcreate()
{
    $branch = session('branch');
    $branch_id = $branch['id'];
    $signature = Signature::where('branch', $branch_id)->first();
    
    return view('branch.signatures.create', [
        'existingSignature' => $signature
    ]);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'branch' => 'required|string|max:100',
        'signature' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        // Check if signature exists for this branch
        $existingSignature = Signature::where('branch', $validated['branch'])->first();
        
        // Store the signature image
        $signaturePath = $request->file('signature')->store('branch/signatures', 'public');
        
        if ($existingSignature) {
            // Delete old image
            Storage::delete('public/'.$existingSignature->signature_image_path);
            
            // Update existing record
            $existingSignature->update(['signature_image_path' => $signaturePath]);
            $signature = $existingSignature;
            $message = 'Signature updated successfully';
            $status = 200;
        } else {
            // Create new record
            $signature = Signature::create([
                'branch' => $validated['branch'],
                'signature_image_path' => $signaturePath,
            ]);
            $message = 'Signature created successfully';
            $status = 201;
        }

        return response()->json([
            'message' => $message,
            'data' => $signature,
            'signature_url' => asset('storage/'.$signaturePath)
        ], $status);
        
    } catch (\Exception $e) {
        // Delete the uploaded file if record creation failed
        if (isset($signaturePath)) {
            Storage::delete('public/'.$signaturePath);
        }
        
        return response()->json([
            'message' => 'Error processing signature',
            'error' => $e->getMessage()
        ], 500);
    }
}
   
public function branchstore(Request $request)
{
    $validated = $request->validate([
        'signature' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $branch = session('branch');
    if (!$branch || !isset($branch['id'])) {
        return response()->json([
            'message' => 'Branch information not found in session'
        ], 400);
    }

    $branch_id = $branch['id'];
    
    try {
        // Check if signature exists for this branch
        $existingSignature = Signature::where('branch', $branch_id)->first();
        
        // Store the signature image
        $signaturePath = $request->file('signature')->store('branch/signatures', 'public');
        
        if ($existingSignature) {
            try {
                // Delete old image if it exists
                if ($existingSignature->signature_image_path) {
                    Storage::delete('public/'.$existingSignature->signature_image_path);
                }
                
                // Update existing record
                $existingSignature->update(['signature_image_path' => $signaturePath]);
                $signature = $existingSignature;
                $message = 'Signature updated successfully';
                $status = 200;
            } catch (\Exception $e) {
                // Delete the new image if update failed
                Storage::delete('public/'.$signaturePath);
                throw $e;
            }
        } else {
            try {
                // Create new record
                $signature = Signature::create([
                    'branch' => $branch_id,
                    'signature_image_path' => $signaturePath,
                ]);
                $message = 'Signature created successfully';
                $status = 201;
            } catch (\Exception $e) {
                // Delete the new image if creation failed
                Storage::delete('public/'.$signaturePath);
                throw $e;
            }
        }

        return response()->json([
            'message' => $message,
            'data' => $signature,
            'signature_url' => asset('storage/'.$signaturePath)
        ], $status);
        
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error processing signature',
            'error' => $e->getMessage()
        ], 500);
    }
}
   
   
   
  
}