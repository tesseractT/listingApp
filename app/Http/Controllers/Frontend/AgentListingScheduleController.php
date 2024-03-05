<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\AgentListingScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ListingScheduleStoreRequest;
use App\Http\Requests\Admin\ListingScheduleUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Listing;
use App\Models\ListingSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;


class AgentListingScheduleController extends Controller
{
    public function index(AgentListingScheduleDataTable $listingScheduleDataTable, string $listing_id): View | JsonResponse
    {
        $listingScheduleDataTable->with('listing_id', $listing_id);
        $listingTitle = Listing::select('title')->where('id', $listing_id)->first();
        return $listingScheduleDataTable->render('frontend.dashboard.listing.schedule.index', compact('listing_id', 'listingTitle'));
    }

    function create(Request $request, string $listing_id): View
    {
        return view('frontend.dashboard.listing.schedule.create', compact('listing_id'));
    }

    function store(ListingScheduleStoreRequest $request, string $listing_id): RedirectResponse
    {
        $schedule = new ListingSchedule();
        $schedule->listing_id = $listing_id;
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->status = $request->status;
        $schedule->save();

        return to_route('user.listing-schedule.index', $listing_id)->with('success', 'Schedule has been added successfully');
    }

    function edit(string $id): View
    {
        $schedule = ListingSchedule::findOrFail($id);
        return view('frontend.dashboard.listing.schedule.edit', compact('schedule'));
    }

    function update(ListingScheduleUpdateRequest $request, string $id): RedirectResponse
    {
        $schedule = ListingSchedule::find($id);
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->status = $request->status;
        $schedule->save();

        return to_route('user.listing-schedule.index', $schedule->listing_id)->with('success', 'Schedule has been updated successfully');
    }

    function destroy(string $id): Response
    {
        try {
            $schedule = ListingSchedule::findOrFail($id);
            $schedule->delete();
            return response(['status' => 'success', 'message' => 'Schedule has been deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
