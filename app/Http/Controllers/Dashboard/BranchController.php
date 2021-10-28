<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends  BackEndController
{

    public function __construct(Branch $model)
    {
        parent::__construct($model);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
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
    public function update(BranchRequest $request, $id)
    {
        $branch   = $this->model->findOrFail($id);
        $request_data         =  $request->except(['_token', 'image',]);

        if ($request->image) {
            if ($branch->image != null) {
                $this->deleteImage($this->getSingularModelName(), $branch->image);
            }
            $request_data['image'] = $this->uploadImage($this->getSingularModelName(), $request->image);
        } //end of if

        $branch->update($request_data);
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    public function destroy($id, Request $request)
    {
        $branch = $this->model->findOrFail($id);
        if ($branch->image != null) {
            $this->deleteImage($this->getSingularModelName(), $branch->image);
        }
        $branch->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }
}
