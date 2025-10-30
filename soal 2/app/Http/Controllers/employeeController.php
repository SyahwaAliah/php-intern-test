<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|unique:employees',
            'nama' => 'required',
            'jabatan' => 'nullable',
            'talahir' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $photoUrl = null;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
   
            $photoUrl = Storage::url($path);
        }

        $employee = Employee::create([
            'nomor' => $request->nomor,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'talahir' => $request->talahir,
            'photo_upload_path' => $photoUrl,
            'created_on' => Carbon::now(),
        ]);

        Redis::set("emp_{$employee->nomor}", json_encode($employee));

        return redirect()->route('employees.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
            $employee->photo_upload_path = Storage::url($path);
        }

        $employee->update($request->except('photo'));
        $employee->updated_on = Carbon::now();
        $employee->save();

        Redis::set("emp_{$employee->nomor}", json_encode($employee));

        return redirect()->route('employees.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        Redis::del("emp_{$employee->nomor}");

        return redirect()->route('employees.index')->with('success', 'Data berhasil dihapus!');
    }
}
