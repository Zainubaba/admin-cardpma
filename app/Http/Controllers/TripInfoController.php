<?php

namespace App\Http\Controllers;

use App\Models\TripInfo;
use App\Http\Requests\StoreTripInfoRequest;
use App\Http\Requests\UpdateTripInfoRequest;

class TripInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTripInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTripInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TripInfo  $tripInfo
     * @return \Illuminate\Http\Response
     */
    public function show(TripInfo $tripInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TripInfo  $tripInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(TripInfo $tripInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTripInfoRequest  $request
     * @param  \App\Models\TripInfo  $tripInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTripInfoRequest $request, TripInfo $tripInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TripInfo  $tripInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TripInfo $tripInfo)
    {
        //
    }
}
