<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\StateModel;
use App\Models\CityModel;

class CityController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $states = StateModel::with('cities')
            ->orderBy('name')
            ->get();

        return view('addState', compact('states'));
    }
    public function state_home($id)
    {
        $state = StateModel::findOrFail($id);

        if ($state->in_home == 1) {
            $state->in_home = 0;
        } else {
            $state->in_home = 1;
        }
        $state->save();
        return redirect()->back()->with('success', 'State Home Status Updated Successfully.');
    }
    public function city_home($id)
    {
        $city = CityModel::findOrFail($id);

        if ($city->in_home == 1) {
            $city->in_home = 0;
        } else {
            $city->in_home = 1;
        }
        $city->save();
        return redirect()->back()->with('success', 'City Home Status Updated Successfully.');
    }
    public function cityIndex(Request $request)
    {
        $states = StateModel::orderBy('name')->get();

        $query = CityModel::with('state');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('city_name', 'like', "%{$search}%")
                    ->orWhereHas('state', function ($sq) use ($search) {
                        $sq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('state_id')) {
            $query->where('state_id', $request->state_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $cities = $query->orderBy('city_name')->paginate(25)->withQueryString();

        $totalCities = CityModel::count();
        $activeCities = CityModel::where('status', 1)->count();
        $inactiveCities = CityModel::where('status', 0)->count();
        $homeFeaturedCities = CityModel::where('in_home', 1)->count();

        return view('addCity', compact('states', 'cities', 'totalCities', 'activeCities', 'inactiveCities', 'homeFeaturedCities'));
    }
    public function cityByState($state_id)
    {
        $cities = CityModel::where('state_id', $state_id)
            ->where(function($q) {
                $q->where('status', 1)->orWhere('status', '1')->orWhereNull('status');
            })
            ->orderBy('city_name')
            ->get([
                'id',
                'city_name'
            ]);

        return response()->json([
            'success' => true,
            'data' => $cities
        ]);
    }

    public function getStateData(Request $request)
    {
        $state = StateModel::find($request->id);

        if (!$state) {

            return response()->json([
                'success' => false,
                'message' => 'State Not Found'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $state
        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | STATE CRUD
    |--------------------------------------------------------------------------
    */

    // Store State
    public function storeState(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:states,name',
            'status' => 'required|in:0,1',
        ]);

        StateModel::create([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        return back()->with('success', 'State Added Successfully.');
    }

    // Edit State
    public function editState($id)
    {
        $state = StateModel::findOrFail($id);

        return response()->json($state);
    }

    // Update State
    public function updateState(Request $request, $id)
    {
        $state = StateModel::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('states', 'name')->ignore($state->id),
            ],
            'status' => 'required|in:0,1',
        ]);

        $state->update([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        return back()->with('success', 'State Updated Successfully.');
    }

    // Delete State
    public function deleteState($id)
    {
        $state = StateModel::findOrFail($id);

        if ($state->cities()->count() > 0) {
            return back()->with('error', 'Cannot delete this state. Cities exist.');
        }

        $state->delete();

        return back()->with('success', 'State Deleted Successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | CITY CRUD
    |--------------------------------------------------------------------------
    */

    // Store City
    public function storeCity(Request $request)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id',

            'city_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('cities')->where(function ($query) use ($request) {
                    return $query->where('state_id', $request->state_id);
                }),
            ],

            'status' => 'required|in:0,1',
        ]);

        CityModel::create([
            'state_id' => $request->state_id,
            'city_name' => $request->city_name,
            'status' => $request->status,
        ]);

        return back()->with('success', 'City Added Successfully.');
    }

    // Edit City
    public function editCity($id)
    {
        $city = CityModel::findOrFail($id);

        return response()->json($city);
    }

    // Update City
    public function updateCity(Request $request, $id)
    {
        $city = CityModel::findOrFail($id);

        $request->validate([
            'state_id' => 'required|exists:states,id',

            'city_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('cities')
                    ->where(function ($query) use ($request) {
                        return $query->where('state_id', $request->state_id);
                    })
                    ->ignore($city->id),
            ],

            'status' => 'required|in:0,1',
        ]);

        $city->update([
            'state_id' => $request->state_id,
            'city_name' => $request->city_name,
            'status' => $request->status,
        ]);

        return back()->with('success', 'City Updated Successfully.');
    }

    // Delete City
    public function deleteCity($id)
    {
        $city = CityModel::findOrFail($id);

        $city->delete();

        return back()->with('success', 'City Deleted Successfully.');
    }

    public function getCityData(Request $request)
    {
        $city = CityModel::find($request->id);

        if (!$city) {
            return response()->json([
                'success' => false,
                'message' => 'City Not Found'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $city
        ]);
    }
}
