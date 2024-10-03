<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


trait TraitCRUD
{
    public function index()
    {
        $data = $this->model
            ->when(!empty($this->relations), function (Builder $query) {
                $query->with($this->relations);
            })
            ->latest()->paginate(10);

        return view('admin.' . $this->model->getTable() . '.' . __FUNCTION__, compact('data'));
    }
    public function create()
    {

        $data = $this->model
            ->when(!empty($this->relations), function (Builder $query) {
                $query->with($this->relations);
            })
            ->get();

        return view('admin.' . $this->model->getTable() . '.' . __FUNCTION__, compact('data'));
    }
    public function store(Request $request)
    {
        $data = $request->all();


        $data['is_active'] = $request->has('is_active') ? 1 : 0;// Xử lý lại...

        foreach ($data as $key => $value) {
            if (Str::startsWith($key, 'image_')) {
                $data[$key] = Storage::put($this->model->getTable(), $request->file($key));
            }
        }

        $this->model->create($data);
        return redirect()->route($this->model->getTable() . '.index')->with('success', __('Thêm dữ liệu thành công'));
    }
    public function show($id)
    {
        $data = $this->model
            ->when(!empty($this->relations), function (Builder $query) {
                $query->with($this->relations);
            })
            ->get();
        $data = $this->model
            ->when(!empty($this->relations), function (Builder $query) {
                $query->with($this->relations);
            })
            ->findOrFail($id);
        return view('admin.' . $this->model->getTable() . '.' . __FUNCTION__, compact('data'));
    }
    public function edit($id)
    {
        $data = $this->model
            ->when(!empty($this->relations), function (Builder $query) {
                $query->with($this->relations);
            })
            ->get();
        $dataID = $this->model
            ->when(!empty($this->relations), function (Builder $query) {
                $query->with($this->relations);
            })
            ->findOrFail($id);

        return view('admin.' . $this->model->getTable() . '.' . __FUNCTION__, compact('data', 'dataID'));
    }
    public function update(Request $request, $id)
    {
         $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        foreach ($data as $key => $value) {
            if (Str::startsWith($key, 'image_') && $request->hasFile($key)) {
                $data[$key] = Storage::put($this->model->getTable(),$request->file($key));
            }
        }


        $this->model->findOrFail($id)->update($data);
        return redirect()->route($this->model->getTable() . '.index')->with('success', __('Cập nhật dữ liệu thành công'));
    }
    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();
        return redirect()->route($this->model->getTable() . '.index')->with('success', __('Xóa dữ liệu thành công'));
    }
}
