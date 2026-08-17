<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\VendorModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\StateModel;
use App\Models\CityModel;
use App\Models\ServiceRequestModel;

class AdminController extends Controller
{
    public function login_page()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else {

            return view("login");
        }
    }
    public function privacy_policy()
    {
       return view('privacy_policy');
    }
    public function terms()
    {
       return view('terms');
    }
    public function about()
    {
       return view('about');
    }
    public function account_deletion()
    {
       return view('accountDeletion');
    }
    public function submit_account_deletion(Request $request)
    {
        $request->validate([
            'user_type' => 'required',
            'phone_or_email' => 'required',
        ]);

        \App\Models\AccountDeletionRequestModel::create([
            'user_type' => $request->user_type,
            'phone_or_email' => $request->phone_or_email,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your account deletion request has been received. Our data privacy team will process and delete your data within 24-48 hours.');
    }

    public function adminDeletionRequestsList()
    {
        $requests = \App\Models\AccountDeletionRequestModel::latest()->get();
        return view('accountDeletionList', compact('requests'));
    }

    public function adminDeleteDeletionRequest($id)
    {
        $req = \App\Models\AccountDeletionRequestModel::findOrFail($id);
        $req->delete();
        return back()->with('success', 'Deletion request log removed successfully.');
    }





    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        // Find the user by username
        $admin = AdminModel::where('email', $email)->first();

        if ($admin) {
            // Check the password
            if ($password === $admin->password) {
                // Passwords match, manually log in the user
                Auth::guard('admin')->login($admin);

                return redirect()->route('admin.dashboard');
            }
        }

        // Invalid credentials
        return redirect()->route('adm.login.page')->with('error', 'Invalid credentials');
    }


    public function index()
    {

        if (Auth::guard('admin')->check()) {
            // ================= USERS =================
            $totalUsers     = User::count();
            $activeUsers    = User::where('status', 1)->count();
            $inactiveUsers  = User::where('status', 0)->count();
            $todayUsers     = User::whereDate('created_at', today())->count();

            // ================= VENDORS =================
            $totalVendors      = VendorModel::count();
            $verifiedVendors   = VendorModel::where('is_verified', 1)->count();
            $pendingVendors    = VendorModel::where('is_verified', 0)->count();

            $approvedVendors   = VendorModel::where('status', '1')->orWhere('status', 'approved')->count();
            $rejectedVendors   = VendorModel::where('status', 'rejected')->count();
            $blockedVendors    = VendorModel::where('status', 'blocked')->count();
            $todayVendors      = VendorModel::whereDate('created_at', today())->count();

            // ================= CATEGORY =================
            $totalCategories     = CategoryModel::count();
            $totalSubCategories  = SubCategoryModel::count();

            // ================= STATE & CITY =================
            $totalStates = StateModel::count();
            $totalCities = CityModel::count();

            // ================= SERVICE REQUESTS & FINANCIALS =================
            $totalRequests      = ServiceRequestModel::count();

            $pendingRequests    = ServiceRequestModel::whereIn('status', ['Pending', 'pending'])->count();
            $acceptedRequests   = ServiceRequestModel::whereIn('status', ['Accepted', 'accepted'])->count();
            $assignedRequests   = ServiceRequestModel::whereIn('status', ['Assigned', 'assigned'])->count();
            $completedRequests  = ServiceRequestModel::whereIn('status', ['Completed', 'completed'])->count();
            $cancelledRequests  = ServiceRequestModel::whereIn('status', ['Cancelled', 'cancelled'])->count();

            $todayRequests      = ServiceRequestModel::whereDate('created_at', today())->count();

            // FINANCIAL METRICS (Amounts in ₹)
            $totalRevenue       = ServiceRequestModel::whereNotNull('budget')->sum('budget') ?? 0;
            $completedRevenue   = ServiceRequestModel::whereIn('status', ['Completed', 'completed'])->whereNotNull('budget')->sum('budget') ?? 0;
            $todayRevenue       = ServiceRequestModel::whereDate('created_at', today())->whereNotNull('budget')->sum('budget') ?? 0;
            $avgBookingValue    = ServiceRequestModel::count() > 0 ? (ServiceRequestModel::whereNotNull('budget')->avg('budget') ?? 0) : 0;

            $serviceRequests = ServiceRequestModel::with([
                'user',
                'vendor',
                'category',
                'subCategory'
            ])->latest()->take(10)->get();

            return view('dashboard', compact(
                'totalUsers',
                'activeUsers',
                'inactiveUsers',
                'todayUsers',
                'totalVendors',
                'verifiedVendors',
                'pendingVendors',
                'approvedVendors',
                'rejectedVendors',
                'blockedVendors',
                'todayVendors',
                'totalCategories',
                'totalSubCategories',
                'totalStates',
                'totalCities',
                'totalRequests',
                'pendingRequests',
                'acceptedRequests',
                'assignedRequests',
                'completedRequests',
                'cancelledRequests',
                'todayRequests',
                'totalRevenue',
                'completedRevenue',
                'todayRevenue',
                'avgBookingValue',
                'serviceRequests'
            ));
        } else {
            return view("login");
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('adm.login.page');
    }
}
