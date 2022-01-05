<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllDiscipline()
    {
        return Discipline::with("students")->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createDiscipline(Request $request)
    {
        $request->validate([
            'discipline_type' => 'required',
            'date_time' => 'required',
            'explaination' => 'required',
        ]);
        $discipline = new Discipline();
        $discipline->student_id = $request->student_id;
        $discipline->discipline_type = $request->discipline_type;
        $discipline->date_time = $request->date_time;
        $discipline->explaination = $request->explaination;
        $discipline->save();

        return response()->json(['message' => 'Discipline created successfully', 'data' => $discipline], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function f($id)
    // {

    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDiscipline(Request $request, $id)
    {
        $request->validate([
            'discipline_type' => 'required',
            'date_time' => 'required',
            'explaination' => 'required',
        ]);
        $discipline = Discipline::findOrFail($id);
        $discipline->update($request->all());

        $discipline->save();

        return response()->json(['message' => 'discipline updated successfully', 'student' => $discipline], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDiscipline($id)
    {
        $isDeleted = Discipline::destroy($id);
        if($isDeleted == 1){
            return response()->json(['message'=> 'deleted'], 200);
        }else{
            return response()->json(['message'=> 'ID Not Found'], 200);
        }
    }
    public function search($student_name)
    {
        return Discipline::where('student_name', 'like', '%' . $student_name . '%')->get();
    }
}
