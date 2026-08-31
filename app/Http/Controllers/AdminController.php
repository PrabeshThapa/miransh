<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyInfo;
use App\Models\About;
use App\Models\Service;
use App\Models\Story;
use App\Models\Faq;
use App\Models\Inquiry;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Handle login submission
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = trim($credentials['email']);
        $password = $credentials['password'];

        // Search user by email or name
        $user = User::where('email', $loginInput)
            ->orWhere('name', $loginInput)
            ->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($password, $user->password)) {
            Auth::login($user, true);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    /**
     * Admin Dashboard with tabs for Company Info, Services, About, Stories, FAQs, Inquiries, AI
     */
    public function dashboard(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $company = CompanyInfo::first() ?? new CompanyInfo();
        $about = About::first() ?? new About();
        $services = Service::orderBy('sort_order', 'asc')->get();
        $stories = Story::orderBy('sort_order', 'asc')->get();
        $faqs = Faq::orderBy('sort_order', 'asc')->get();
        $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        $activeTab = $request->query('tab', 'company');

        return view('admin.dashboard', compact('company', 'about', 'services', 'stories', 'faqs', 'inquiries', 'activeTab'));
    }

    /**
     * Update Company Information & Executive Media
     */
    public function updateCompany(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $company = CompanyInfo::first();
        if (!$company) {
            $company = new CompanyInfo();
        }

        $company->fill($request->all());
        $company->save();

        return redirect()->route('admin.dashboard', ['tab' => 'company'])->with('success', 'Company Information & Media updated successfully!');
    }

    /**
     * Update About Section
     */
    public function updateAbout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $about = About::first();
        if (!$about) {
            $about = new About();
        }

        $about->fill($request->all());
        $about->save();

        return redirect()->route('admin.dashboard', ['tab' => 'about'])->with('success', 'About Section updated successfully!');
    }

    /**
     * Store new Service
     */
    public function storeService(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'title_en' => 'required',
            'title_ja' => 'required',
            'desc_en' => 'required',
            'desc_ja' => 'required',
        ]);

        $parseList = function ($str) {
            if (empty($str)) return [];
            return array_values(array_filter(array_map('trim', explode("\n", $str))));
        };

        $service = new Service();
        $service->number_label = $request->number_label ?? '01';
        $service->title_en = $request->title_en;
        $service->title_ja = $request->title_ja;
        $service->subtitle_en = $request->subtitle_en;
        $service->subtitle_ja = $request->subtitle_ja;
        $service->icon = $request->icon ?? 'users';
        $service->image = $request->image ?? '/images/caregiving.jpg';
        $service->desc_en = $request->desc_en;
        $service->desc_ja = $request->desc_ja;
        $service->full_content_en = $request->full_content_en ?? $request->desc_en;
        $service->full_content_ja = $request->full_content_ja ?? $request->desc_ja;
        $service->items_en = is_array($request->items_en) ? $request->items_en : $parseList($request->items_en);
        $service->items_ja = is_array($request->items_ja) ? $request->items_ja : $parseList($request->items_ja);
        $service->workflow_steps_en = is_array($request->workflow_steps_en) ? $request->workflow_steps_en : $parseList($request->workflow_steps_en);
        $service->workflow_steps_ja = is_array($request->workflow_steps_ja) ? $request->workflow_steps_ja : $parseList($request->workflow_steps_ja);
        $service->sort_order = (int) ($request->sort_order ?? 0);
        $service->save();

        return redirect()->route('admin.dashboard', ['tab' => 'services'])->with('success', 'New service published successfully!');
    }

    /**
     * Update existing Service
     */
    public function updateService(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $service = Service::findOrFail($id);

        $parseList = function ($str) {
            if (is_array($str)) return $str;
            if (empty($str)) return [];
            return array_values(array_filter(array_map('trim', explode("\n", $str))));
        };

        $service->number_label = $request->number_label ?? $service->number_label;
        $service->title_en = $request->title_en;
        $service->title_ja = $request->title_ja;
        $service->subtitle_en = $request->subtitle_en ?? $service->subtitle_en;
        $service->subtitle_ja = $request->subtitle_ja ?? $service->subtitle_ja;
        $service->icon = $request->icon ?? $service->icon;
        $service->image = $request->image ?? $service->image;
        $service->desc_en = $request->desc_en;
        $service->desc_ja = $request->desc_ja;
        $service->full_content_en = $request->full_content_en ?? $service->full_content_en;
        $service->full_content_ja = $request->full_content_ja ?? $service->full_content_ja;
        $service->items_en = $parseList($request->items_en);
        $service->items_ja = $parseList($request->items_ja);
        $service->workflow_steps_en = $parseList($request->workflow_steps_en);
        $service->workflow_steps_ja = $parseList($request->workflow_steps_ja);
        $service->sort_order = (int) ($request->sort_order ?? 0);
        $service->save();

        return redirect()->route('admin.dashboard', ['tab' => 'services'])->with('success', 'Service #' . $service->number_label . ' updated successfully!');
    }

    /**
     * Delete Service
     */
    public function deleteService($id)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'services'])->with('success', 'Service deleted successfully.');
    }

    /**
     * Store new Story / Case Study
     */
    public function storeStory(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'title_en' => 'required',
            'title_ja' => 'required',
            'summary_en' => 'required',
            'summary_ja' => 'required',
        ]);

        $story = new Story();
        $story->title_en = $request->title_en;
        $story->title_ja = $request->title_ja;
        $story->category_en = $request->category_en ?? 'Recruitment Story';
        $story->category_ja = $request->category_ja ?? '採用事例';
        $story->summary_en = $request->summary_en;
        $story->summary_ja = $request->summary_ja;
        $story->content_en = $request->content_en ?? $request->summary_en;
        $story->content_ja = $request->content_ja ?? $request->summary_ja;
        $story->image = $request->image ?? '/images/story1.jpg';
        $story->published_date = $request->published_date ?? date('Y.m.d');
        $story->author = $request->author ?? 'MIRANSH Editorial Team';
        $story->featured = $request->has('featured');
        $story->sort_order = (int) ($request->sort_order ?? 0);
        $story->save();

        return redirect()->route('admin.dashboard', ['tab' => 'stories'])->with('success', 'New Story / Case Study created successfully!');
    }

    /**
     * Update existing Story
     */
    public function updateStory(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $story = Story::findOrFail($id);
        $story->title_en = $request->title_en;
        $story->title_ja = $request->title_ja;
        $story->category_en = $request->category_en ?? $story->category_en;
        $story->category_ja = $request->category_ja ?? $story->category_ja;
        $story->summary_en = $request->summary_en;
        $story->summary_ja = $request->summary_ja;
        $story->content_en = $request->content_en ?? $story->content_en;
        $story->content_ja = $request->content_ja ?? $story->content_ja;
        $story->image = $request->image ?? $story->image;
        $story->published_date = $request->published_date ?? $story->published_date;
        $story->author = $request->author ?? $story->author;
        $story->featured = $request->has('featured');
        $story->sort_order = (int) ($request->sort_order ?? 0);
        $story->save();

        return redirect()->route('admin.dashboard', ['tab' => 'stories'])->with('success', 'Story updated successfully!');
    }

    /**
     * Delete Story
     */
    public function deleteStory($id)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $story = Story::findOrFail($id);
        $story->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'stories'])->with('success', 'Story deleted successfully.');
    }

    /**
     * Store new FAQ
     */
    public function storeFaq(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'question_ja' => 'required',
            'answer_ja' => 'required',
        ]);

        $faq = new Faq();
        $faq->category_ja = $request->category_ja ?? '特定技能・在留資格';
        $faq->category_en = $request->category_en ?? 'Specified Skilled Worker (SSW)';
        $faq->question_ja = $request->question_ja;
        $faq->question_en = $request->question_en ?? $request->question_ja;
        $faq->answer_ja = $request->answer_ja;
        $faq->answer_en = $request->answer_en ?? $request->answer_ja;
        $faq->sort_order = (int) ($request->sort_order ?? 0);
        $faq->save();

        return redirect()->route('admin.dashboard', ['tab' => 'faqs'])->with('success', 'FAQ question created successfully!');
    }

    /**
     * Update existing FAQ
     */
    public function updateFaq(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $faq = Faq::findOrFail($id);
        $faq->category_ja = $request->category_ja ?? $faq->category_ja;
        $faq->category_en = $request->category_en ?? $faq->category_en;
        $faq->question_ja = $request->question_ja;
        $faq->question_en = $request->question_en ?? $request->question_ja;
        $faq->answer_ja = $request->answer_ja;
        $faq->answer_en = $request->answer_en ?? $request->answer_ja;
        $faq->sort_order = (int) ($request->sort_order ?? 0);
        $faq->save();

        return redirect()->route('admin.dashboard', ['tab' => 'faqs'])->with('success', 'FAQ updated successfully!');
    }

    /**
     * Delete FAQ
     */
    public function deleteFaq($id)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'faqs'])->with('success', 'FAQ deleted successfully.');
    }

    /**
     * Update Inquiry Status (read/replied)
     */
    public function updateInquiryStatus(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $inquiry = Inquiry::findOrFail($id);
        $inquiry->status = $request->status ?? 'read';
        $inquiry->save();

        return redirect()->route('admin.dashboard', ['tab' => 'inquiries'])->with('success', 'Inquiry marked as ' . $inquiry->status);
    }

    /**
     * Handle Image Upload API for CEO portrait, hero banner, service icons, etc.
     */
    public function uploadImage(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'error' => 'Unauthorized access. Please login first.'
            ], 401);
        }

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first('image')
            ], 422);
        }

        if (!$request->hasFile('image')) {
            return response()->json([
                'success' => false,
                'error' => 'No image file provided in request.'
            ], 400);
        }

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension() ?: 'png';
        $filename = 'img_' . time() . '_' . \Illuminate\Support\Str::random(8) . '.' . strtolower($extension);
        
        $destinationPath = public_path('uploads');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $filename);
        $fullFilePath = $destinationPath . '/' . $filename;
        $size = file_exists($fullFilePath) ? filesize($fullFilePath) : 0;
        $relativePath = '/uploads/' . $filename;

        // Auto-save to company_info if target_field is specified
        if ($request->filled('target_field')) {
            $targetField = $request->input('target_field');
            if (in_array($targetField, ['ceo_image', 'hero_image'])) {
                $company = CompanyInfo::first();
                if (!$company) {
                    $company = new CompanyInfo();
                }
                $company->$targetField = $relativePath;
                $company->save();
            }
        }

        return response()->json([
            'success' => true,
            'url' => $relativePath,
            'filename' => $filename,
            'size' => $size,
            'auto_saved' => $request->filled('target_field')
        ]);
    }
}
