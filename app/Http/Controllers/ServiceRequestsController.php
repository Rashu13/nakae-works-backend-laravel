<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequestModel;
use Illuminate\Http\Request;

class ServiceRequestsController extends Controller
{
    public function serviceRequests()
    {
        $serviceRequests = ServiceRequestModel::with(['user', 'vendor', 'category', 'subCategory'])->latest()->get();

        return view('serviceRequests', compact('serviceRequests'));
    }
    public function serviceRequestView($id)
    {
        $req = ServiceRequestModel::with([
            'user.state',
            'user.city',
            'vendor.state',
            'vendor.city',
            'category',
            'subCategory',
            'address',
            'requestImages',
            'messages.customer',
            'messages.vendor',
            'messages.admin'
        ])->findOrFail($id);

        return view('serviceView', compact('req'));
    }
}
