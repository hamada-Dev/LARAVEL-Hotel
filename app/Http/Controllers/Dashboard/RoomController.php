<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomReqest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends  BackEndController
{

    public function __construct(Room $model)
    {
        parent::__construct($model);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomReqest $request)
    {
        $request_data             =  $request->except(['_token', 'image',]);
        $request_data['added_by'] =  $this->userId;

        if ($request->image) {
            $request_data['image'] = $this->uploadImage($this->getSingularModelName(), $request->image);
        }

        $this->model->create($request_data);

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
    public function update(RoomReqest $request, $id)
    {
        $room   = $this->model->findOrFail($id);
        $request_data         =  $request->except(['_token', 'image',]);

        if ($request->image) {
            if ($room->image != null) {
                $this->deleteImage($this->getSingularModelName(), $room->image);
            }
            $request_data['image'] = $this->uploadImage($this->getSingularModelName(), $request->image);
        } //end of if

        $room->update($request_data);
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    public function destroy($id, Request $request)
    {
        $room = $this->model->findOrFail($id);
        if ($room->image != null) {
            $this->deleteImage($this->getSingularModelName(), $room->image);
        }
        $room->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }
}
