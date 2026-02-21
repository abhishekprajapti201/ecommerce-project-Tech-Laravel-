<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorRegistration as VendorReg;
use App\Models\BuisnessMeeting as Meeting; 
use App\Models\Contact;

class FormDataController extends Controller
{
    public function indexVendors() {
        $vendors = VendorReg::latest()->get();
        return view('admin.FormData.vendorReg', compact('vendors'));
    }

    public function indexContacts() {
        $contacts = Contact::latest()->get();
        return view('admin.FormData.contactForm', compact('contacts'));
    }

    public function indexMeetings() {
        $meetings = Meeting::latest()->get();
        return view('admin.FormData.buisnessmeeting', compact('meetings'));
    }

    public function contactget(){
        $contacts = Contact::all();
        return view('admin.FormData.contactForm',compact('contacts'));
        
    }

}