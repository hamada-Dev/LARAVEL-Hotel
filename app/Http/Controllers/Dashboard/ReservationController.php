<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends BackEndController
{
    protected $room;
    protected $reserveDetail;
    public function __construct(Reservation $model, Room $room, ReservationDetail $reserveDetail)
    {
        parent::__construct($model);
        $this->room             = $room;
        $this->reserveDetail    = $reserveDetail;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        // return $request;
        $nuberOfPerson =  $this->checkRoomPlace($request); // this method return number of person in this room at date Between 

        $checkVal      = $this->checkAvilablePlaceInThisDate($nuberOfPerson, $request->room_id);

        if($checkVal['status']){
            if($checkVal['avilable'] < $request->person_number){
                return redirect()->back()->withInput()->with(['error' => "you want to Reservation $request->person_number and avilabel is {$checkVal['avilable']} "  ]);
            } 
        }else{
            return redirect()->back()->withInput()->with(['error' => "you want to Reservation $request->person_number and avilabel is {$checkVal['avilable']} "  ]);
        }       

        return $request;

        $request_reserve             =  $request->only(['user_id', 'paid']);
        $request_reserve['added_by'] =  $this->userId;

        $request_reserve_detail            =  $request->only(['room_id', 'person_number', 'start_at', 'end_at',]);
        $request_reserve_detail['price']   = 99;

        $reserve = $this->model->create($request_reserve);

        $reserve->reservationsDetails()->create($request_reserve_detail);

        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
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
    public function update(ReservationRequest $request, $id)
    {
        $type   = $this->model->findOrFail($id);
        $request_data         =  $request->except(['_token', 'image',]);

        if ($request->image) {
            if ($type->image != null) {
                $this->deleteImage($this->getSingularModelName(), $type->image);
            }
            $request_data['image'] = $this->uploadImage($this->getSingularModelName(), $request->image);
        } //end of if

        $type->update($request_data);
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    public function destroy($id, Request $request)
    {
        $type = $this->model->findOrFail($id);
        if ($type->image != null) {
            $this->deleteImage($this->getSingularModelName(), $type->image);
        }
        $type->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    protected function checkRoomPlace($request)
    {
        $from = date('Y-m-d', strtotime($request->start_at));
        $to   = date('Y-m-d', strtotime($request->end_at));

        $num =  $this->reserveDetail
            ->where('room_id', $request->room_id)
            ->whereBetween('start_at',  [$from, $to])
            ->OrwhereBetween('end_at',  [$from, $to])
            ->get()->sum('person_number');

        return $num;
    }

    protected function checkAvilablePlaceInThisDate($personNum, $roomId){
        $maxNumebrOfPerson = $this->room->find($roomId)->person_number;
        $data = ['avilable' => 0 , 'status' => false];
        if($personNum < $maxNumebrOfPerson){
            $data = ['avilable' => $maxNumebrOfPerson - $personNum, 'status' => true];  
        }
        return $data;
    }
}
