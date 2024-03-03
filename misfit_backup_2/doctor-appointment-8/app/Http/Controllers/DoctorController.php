<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index(){
        return Doctor::all();
    }
    
    public function profile()
    {
        $doctor = Doctor::find(1); // Replace 1 with the actual doctor ID
        return view('doctor.profile', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::find($id); // Replace $id with the actual doctor ID
        return view('doctor.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        // Find the doctor record by ID
        $doctor = Doctor::find($id); // Replace $id with the actual doctor ID

        // Update the doctor's information with the data from the form
        $doctor->name = $request->input('name');
        $doctor->email = $request->input('email');
        $doctor->phone = $request->input('phone');
        $doctor->address = $request->input('address');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the previous image if it exists
            if ($doctor->image) {
                // Make sure to include the "public" folder in the path
                $imagePath = 'public/uploads/doctors/' . $doctor->image;
                Storage::delete($imagePath);
            }

            // Get the uploaded file
            $uploadedImage = $request->file('image');

            // Generate a unique filename for the image
            $filename = uniqid() . '.' . $uploadedImage->getClientOriginalExtension();

            // Move the uploaded image to the "public/uploads/doctors" folder
            $uploadedImage->move(public_path('uploads/doctors'), $filename);

            // Update the image path in the doctor record
            $doctor->image = $filename;
        }

        // Save the updated doctor information
        $doctor->save();

        return redirect()->route('doctor.profile')->with('success', 'Profile updated successfully.');
    }
}
