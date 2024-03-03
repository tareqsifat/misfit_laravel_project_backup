<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\SeekerProfile\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::get();
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->take(10)->get();
        $cities = DB::table('cities')->take(10)->get();
        return view('web.job_seeker.address.create', compact('countries', 'states', 'cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_line' => 'required|string|max:256',
            'place_mark' => 'nullable|string|max:256',
            'city_id' => 'required|integer',
            'state_id' => 'required|integer',
            'country_id' => 'required|integer',
        ]);

        Address::create([
            'address_line' => $request->input('address_line'),
            'place_mark' => $request->input('place_mark'),
            'city_id' => $request->input('city_id'),
            'state_id' => $request->input('state_id'),
            'country_id' => $request->input('country_id'),
            'creator' => Auth::guard('user_account')->id(),
            'user_account_id' => Auth::guard('user_account')->id(),
            'slug' => \Illuminate\Support\Str::slug($request->address_line),
            'status' => 1,
        ]);

        return redirect()->route('auth_user')
            ->with('success', 'Address created successfully');
    }

    public function edit($id)
    {
        $address = $this->findAddressOrFail($id);
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->take(10)->get();
        $cities = DB::table('cities')->take(10)->get();
        return view('web.job_seeker.address.edit', compact('address','countries', 'states', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'address_line' => 'required|max:256',
            'place_mark' => 'nullable|max:256',
            'city_id' => 'required|integer',
            'state_id' => 'required|integer',
            'country_id' => 'required|integer',
        ]);

        $address = $this->findAddressOrFail($id);

        $address->update([
            'address_line' => $request->input('address_line'),
            'place_mark' => $request->input('place_mark'),
            'city_id' => $request->input('city_id'),
            'state_id' => $request->input('state_id'),
            'country_id' => $request->input('country_id'),
            'slug' => \Illuminate\Support\Str::slug($request->address_line)
        ]);

        return redirect()->route('addresses.index')
            ->with('success', 'Address updated successfully');
    }

    public function destroy($id)
    {
        $address = $this->findAddressOrFail($id);
        $address->delete();

        return redirect()->route('addresses.index')
            ->with('success', 'Address deleted successfully');
    }

    private function findAddressOrFail($id)
    {
        $address = Address::find($id);

        if (!$address) {
            abort(404, 'Address not found');
        }

        return $address;
    }
}
