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
    public function delete()
    {
        $data = $this->model
            ->when(!empty($this->relations), function (Builder $query) {
                $query->with($this->relations);
            })
            ->onlyTrashed()
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

        // dd($data);
        foreach ($data as $key => $value) {
            if (Str::startsWith($key, 'is_')) {
                $data[$key] = $request->input($key);
            } elseif (Str::startsWith($key, 'img_') && $request->hasFile($key)) {
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
        $dataID = $this->model
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
        $dataID = $this->model->findOrFail($id);

        foreach ($data as $key => $value) {
            if (Str::startsWith($key, 'is_')) {
                $data[$key] = $request->input($key);
            } elseif (Str::startsWith($key, 'img_')) {
                $data[$key] = $dataID->$key;
                if ($request->hasFile($key)) {
                    Storage::delete($dataID->$key);
                    $data[$key] = Storage::put($this->model->getTable(), $request->file($key));
                }
            }
        }


        $this->model->findOrFail($id)->update($data);
        return redirect()->route($this->model->getTable() . '.index')->with('success', __('Cập nhật dữ liệu thành công'));
    }
    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();
        return redirect()->back()->with('success', __('Xóa dữ liệu thành công'));
    }
    public function restore($id)
    {
        $this->model->withTrashed()->findOrFail($id)->restore();
        return redirect()->back()->with('success', __('Khôi phục dữ liệu thành công'));
    }
    public function forceDelete($id)
    {

        $dataID = $this->model->withTrashed()->findOrFail($id);

        if (Storage::exists($dataID->img_path)) {
            Storage::delete($dataID->img_path);
        }
        $dataID->forceDelete();
        return redirect()->back()->with('success', __('Xóa vĩnh viễn dữ liệu thành công'));
    }
}
