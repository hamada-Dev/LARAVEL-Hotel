<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\ReservationDetail;
use Illuminate\Http\Request;

class ReservationDetailController extends BackEndController
{

    public function __construct(ReservationDetail $model)
    {
        parent::__construct($model);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'time';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return 'time';
    }

    public function destroy($id, Request $request)
    {
       return 'time';
    }
}
