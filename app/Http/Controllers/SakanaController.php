<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SakanaService;
use Illuminate\Support\Facades\Auth;

class SakanaController extends Controller
{
    protected SakanaService $sakanaService;

    public function __construct(SakanaService $sakanaService)
    {
        $this->sakanaService = $sakanaService;
    }

    /**
     * Chat endpoint for client floating widget
     */
    public function chat(Request $request)
    {
        $messages = $request->input('messages', []);
        $language = $request->input('language', 'ja');
        $context = $request->input('context', []);

        if (empty($messages) && $request->has('message')) {
            $messages = [['role' => 'user', 'content' => $request->input('message')]];
        }

        $result = $this->sakanaService->chat($messages, $language, $context);
        return response()->json($result);
    }

    /**
     * Sector specific consultation
     */
    public function serviceConsult(Request $request)
    {
        $query = $request->input('query', '');
        $sector = $request->input('sector', 'Nursing Care / 介護分野');
        $language = $request->input('language', 'ja');

        $result = $this->sakanaService->generateSectorConsultation($query, $sector, $language);
        return response()->json($result);
    }

    /**
     * Job Description Translation & Localization
     */
    public function translateJob(Request $request)
    {
        $title = $request->input('title', '');
        $content = $request->input('content', '');
        $direction = $request->input('direction', 'ja_to_en');

        $result = $this->sakanaService->translateJob($title, $content, $direction);
        return response()->json($result);
    }

    /**
     * Get Sakana status and public config
     */
    public function getStatus()
    {
        $config = $this->sakanaService->getConfig();
        return response()->json([
            'status' => 'operational',
            'model' => $config['model'],
            'maskedKey' => $config['maskedApiKey'],
            'availableModels' => $config['availableModels'],
        ]);
    }

    /**
     * Admin: Test API connectivity
     */
    public function testConnection(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        $customKey = $request->input('apiKey');
        $customModel = $request->input('model');

        $result = $this->sakanaService->testConnection($customKey, $customModel);
        return response()->json($result);
    }

    /**
     * Admin: Update runtime config
     */
    public function updateConfig(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        $apiKey = $request->input('apiKey');
        $baseUrl = $request->input('baseUrl');
        $model = $request->input('model');

        $config = $this->sakanaService->updateConfig([
            'apiKey' => $apiKey,
            'baseUrl' => $baseUrl,
            'model' => $model,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sakana AI configuration updated successfully',
            'config' => $config,
        ]);
    }
}
