<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyInfo;
use App\Models\About;
use App\Models\Service;
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

        // Support login via email or username 'admin'
        if ($credentials['email'] === 'admin') {
            $user = User::where('name', 'admin')->orWhere('email', 'admin@miransh.jp')->first();
            if ($user && \Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);
                return redirect()->intended(route('admin.dashboard'));
            }
        }

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
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
     * Admin Dashboard with tabs for Company Info, Services, About
     */
    public function dashboard(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $company = CompanyInfo::first() ?? new CompanyInfo();
        $about = About::first() ?? new About();
        $services = Service::orderBy('sort_order', 'asc')->get();
        $activeTab = $request->query('tab', 'company');

        return view('admin.dashboard', compact('company', 'about', 'services', 'activeTab'));
    }

    /**
     * Update Company Information
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

        return redirect()->route('admin.dashboard', ['tab' => 'company'])->with('success', 'Company Information updated successfully!');
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
        $service->desc_en = $request->desc_en;
        $service->desc_ja = $request->desc_ja;
        $service->items_en = is_array($request->items_en) ? $request->items_en : $parseList($request->items_en);
        $service->items_ja = is_array($request->items_ja) ? $request->items_ja : $parseList($request->items_ja);
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
        $service->desc_en = $request->desc_en;
        $service->desc_ja = $request->desc_ja;
        $service->items_en = $parseList($request->items_en);
        $service->items_ja = $parseList($request->items_ja);
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

        return redirect()->route('admin.dashboard', ['tab' => 'services'])->with('success', 'Service deleted successfully!');
    }
}
