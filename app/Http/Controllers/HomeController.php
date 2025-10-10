<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Dynamic;
use App\Models\Package;
use App\Mail\ContactUsMail;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function home()
    {
        $monthlyPackages =  Package::where('type', 'monthly')->get();
        $yearlyPackages = Package::where('type', 'yearly')->get();
        $banners = Banner::all();
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        return view('user.home', compact('banners','monthlyPackages','yearlyPackages','testimonials'));
    }

    public function pricing()
    {
        $monthlyPackages =  Package::where('type', 'monthly')->get();
        $yearlyPackages = Package::where('type', 'yearly')->get();
        return view('user.pricing', compact('monthlyPackages','yearlyPackages','yearlyPackages'));
    }

    public function faqs()
    {
        $faqs= Faq::all();
        return view('user.faqs',compact('faqs'));
    }
    public function blog()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(6);
        return view('user.blog', compact('blogs'));
    }
    

    public function blogDetails($id)
    {
        $blog = Blog::findOrFail($id);
        return view('user.blog_details',compact('blog'));
    }
    public function contact()
    {
        return view('user.contact');
    }
    public function contactstore(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:contacts,email',
            'phone' => 'required|string|max:15|unique:contacts,phone',
            'message' => 'nullable|string|max:500',
        ]);
    
        do {
            $refId = mt_rand(10000, 99999);
        } while (Contact::where('refId', $refId)->exists());
        Contact::create([
            'refId' => $refId,
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'] ?? null,
        ]);
    
        return back()->with('message', 'Thank you! A member of our team will be in touch.');
    }
    public function testimonial()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        return view('user.testimonial',compact('testimonials'));
    }
    public function about()
    {
        return view('user.about');
    }
    public function page($slug)
    {
        $dynamic = Dynamic::where('slug', $slug)->first();
        return view('user.about', compact('dynamic'));
    }
    public function termsAndCondition()
    {
        return view('user.terms_and_condition');
    }
    public function policy()
    {
        return view('user.policy');
    }
    

}
