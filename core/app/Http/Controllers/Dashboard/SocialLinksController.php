<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Models\WebmasterSection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use App\Helpers\Helper;

class SocialLinksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (!@Auth::user()->permissionsGroup->settings_status || !Helper::GeneralWebmasterSettings("settings_status")) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info('SocialLinksController@index called');
        $socialLinks = SocialLink::ordered()->get();
        Log::info('Social links retrieved', ['count' => $socialLinks->count()]);
        return response()->json($socialLinks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('SocialLinksController@store called', $request->all());
        
        $request->validate([
            'name' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'url' => 'nullable|string|max:500',
            'is_active' => 'nullable'
        ]);

        try {
            // Get the next sort order
            $maxOrder = SocialLink::max('sort_order') ?? 0;

            $socialLink = SocialLink::create([
                'name' => $request->name,
                'icon_class' => $request->icon_class,
                'url' => $request->url,
                'is_active' => (bool)($request->is_active === 'true' || $request->is_active === true || $request->is_active === 'on' || $request->is_active == 1),
                'sort_order' => $maxOrder + 1
            ]);

            Log::info('Social link created successfully', ['id' => $socialLink->id, 'name' => $socialLink->name]);

            return response()->json([
                'success' => true,
                'message' => 'Social link created successfully',
                'data' => $socialLink
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to create social link', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to create social link: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Log::info('SocialLinksController@update called', ['id' => $id, 'data' => $request->all()]);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'url' => 'nullable|string|max:500',
            'is_active' => 'nullable'
        ]);

        try {
            $socialLink = SocialLink::findOrFail($id);
            
            $socialLink->update([
                'name' => $request->name,
                'icon_class' => $request->icon_class,
                'url' => $request->url,
                'is_active' => (bool)($request->is_active === 'true' || $request->is_active === true || $request->is_active === 'on' || $request->is_active == 1)
            ]);
            
            Log::info('Social link updated successfully', ['id' => $socialLink->id, 'name' => $socialLink->name]);

            return response()->json([
                'success' => true,
                'message' => 'Social link updated successfully',
                'data' => $socialLink
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update social link'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->delete();

        return response()->json([
            'success' => true,
            'message' => 'Social link deleted successfully'
        ]);
    }

    /**
     * Update the sort order of social links
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'links' => 'required|array',
            'links.*.id' => 'required|exists:smartend_social_links,id',
            'links.*.sort_order' => 'required|integer'
        ]);

        foreach ($request->links as $link) {
            SocialLink::where('id', $link['id'])
                ->update(['sort_order' => $link['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sort order updated successfully'
        ]);
    }

    /**
     * Toggle the active status of a social link
     */
    public function toggleStatus($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->update(['is_active' => !$socialLink->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'data' => $socialLink
        ]);
    }
}
