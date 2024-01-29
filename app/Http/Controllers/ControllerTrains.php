<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\trains;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllerTrains extends Controller
{
    public function index(){
        $page = array(
            'halaman' => 'trains',
            'data' => trains::with("grade")->get(),
            'grade' => grade::get(),
            'delete' => false,
        );
        return view('trains.index', compact('page'));
    }
    
    public function create(){
        $validator = Validator::make(request()->all(), [
            'grade_id' => 'required:trains',
            'name' => 'required|max:25',
        ], [
            'grade_id.required' => 'Grade tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal kurang atau sama dengan 25 karakter'
        ]);

        if($validator->fails()){
            return back()->with('messages', $validator->messages()->get('*'));
        }

        trains::create([
            'grade_id' => request()->input('grade_id'),
            'name' => request()->input('name'),
        ]);

        return redirect('/trains/create')->with('success', 'New Record has been successfully created');
    }

    public function view($id){
        $id = trains::find($id);

        $page = array(
            'halaman' => 'update',
            'grade' => grade::get(),
        );

        return view('trains.update', compact('id', 'page'));
    }

    public function update($id){
        $validator = Validator::make(request()->all(), [
            'grade_id' => 'required:trains',
            'name' => 'required|max:25',
        ], [
            'grade_id.required' => 'Grade tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal kurang atau sama dengan 25 karakter'
        ]);

        if($validator->fails()){
            return back()->with('messages', $validator->messages()->get('*'));
        }

        trains::where('id', $id)->update([
            'grade_id' => request()->input('grade_id'),
            'name' => request()->input('name'),
        ]);

        return redirect('/trains/create')->with('success', 'Record has been successfully updated');
    }

    public function confirm($id){
        $page = array(
            'halaman' => 'trains',
            'data' => trains::with("grade")->get(),
            'grade' => grade::get(),
            'delete' => true,
        );
        
        return view('trains.index', compact('page'));
    }
    public function delete($id){
        trains::where('id', $id)->delete();


        return redirect('/trains/create')->with('success', 'Record has been successfully deleted');
    }
}
