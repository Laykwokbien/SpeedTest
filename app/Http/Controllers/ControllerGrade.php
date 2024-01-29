<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\trains;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllerGrade extends Controller
{
    public function index()
    {

        $page = array(
            'halaman' => 'grade',
            'delete' => false,
            'data' => grade::get(),
        );

        return view('grade.index', compact('page'));
    }
    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'simbol' => 'required:grades|max:2',
            'max_speed' => 'required|numeric',
        ], [
            'simbol.required' => 'Simbol harus diisi',
            'simbol.max' => 'Maksimal kata kurang atau sama dengan 2',
            'max_speed.required' => 'maksimal speed harus diisi',
            'max_speed.numeric' => 'maksimal speed hanya bisa diisi dengan angka saja',
        ]);
        if ($validator->fails()) {
            return back()->with('messages', $validator->messages()->get('*'));
        }

        grade::create([
            'simbol' => request()->input('simbol'),
            'max_speed' => request()->input('max_speed'),
        ]);

        return redirect('/grade/create')->with('success', 'New Record has been successfully created');
    }
    public function view($id)
    {

        $id = grade::find($id);

        $page = array(
            [
                'halaman' => 'update',
            ]
        );

        return view('grade.update', compact('id', 'page'));
    }

    public function update($id)
    {
        $validator = Validator::make(request()->all(), [
            'simbol' => 'required:grades|max:2',
            'max_speed' => 'required|numeric',
        ], [
            'simbol.required' => 'Simbol harus diisi',
            'simbol.max' => 'Maksimal kata kurang atau sama dengan 2',
            'max_speed.required' => 'maksimal speed harus diisi',
            'max_speed.numeric' => 'maksimal speed hanya bisa diisi dengan angka saja',
        ]);
        if ($validator->fails()) {
            return back()->with('messages', $validator->messages()->get('*'));
        }

        grade::where('id', $id)->update([
            'simbol' => request()->input('simbol'),
            'max_speed' => request()->input('max_speed'),
        ]);

        return redirect('/grade/create')->with('success', 'Record has been successfully updated');
    }

    public function confirm($id)
    {
        $page = array(
            'halaman' => 'grade',
            'delete' => true,
            'data' => grade::get(),
        );
        return view('grade.index', compact('page'));
    }

    public function delete($id)
    {
        $grade = grade::with('trains')->find($id);

        if (count($grade->trains) >= 1) {
            return redirect('/grade/create')->with('delete', 'Tidak dapat menghapus grade ini karena telah memiliki Trains');
        }

        grade::where('id', $id)->delete();

        return redirect('/grade/create')->with('success', 'Record has been successfully deleted');
    }
}
