<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function create()
    {
        return view('admin.schedules.create');
    }

    // Simpan jadwal baru
    public function store(Request $request)
    {
        Schedule::create($request->all());
        return redirect('/dashboard');
    }

    // Form edit jadwal
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedules.edit', compact('schedule'));
    }

    // Update jadwal
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());
        return redirect('/dashboard');
    }

    // Hapus jadwal
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect('/dashboard');
    }
}
