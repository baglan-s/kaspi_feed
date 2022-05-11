<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ValidationRules\OrganizationRule;
use App\Helpers\FeedLinkHelper;
use App\Models\Organization;
use App\Http\Resources\OrganizationResource;

class OrganizationController extends Controller
{
    public function index()
    {
        return OrganizationResource::collection(Organization::all());
    }

    public function show($id)
    {
        return new OrganizationResource(Organization::findOrFail($id));
    }

    public function create(Request $request)
    {
        try {
            $organization = Organization::create($this->validate($request, OrganizationRule::createRule()));
            $organization->hash = FeedLinkHelper::generateUniqueLinkHash($organization);
            $organization->save();
            
            return new OrganizationResource($organization);

        } catch (\Exception $e) {

        }

        return response()->json(['message' => 'Error'], 500);
    }

    public function update($id, Request $request)
    {
        $organization = Organization::findOrFail($id);

        if ($organization->update($this->validate($request, OrganizationRule::updateRule()))) {
            return response()->json([
                'success' => true
            ]);
        }
    }

    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);
        
        if ($organization->delete()) {
            return response()->json([
                'success' => true
            ]);
        }
    }
}
