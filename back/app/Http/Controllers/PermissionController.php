<?php

namespace App\Http\Controllers;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPermission()
    {
        return Permission::with("students")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPermission(Request $request)
    {
        $request-> validate([

            'description'=> 'required|min:5',
        ]);

        $permission = new Permission();
        $permission->student_id = $request->student_id;
        $permission->start_date = $request->start_date;
        $permission->end_date = $request->end_date;
        $permission->leave_type = $request->leave_type;
        $permission->description = $request->description;
        $permission->save();

        return response()->json(['message' => 'Permission created successfully', 'data' => $permission], 201);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePermission(Request $request, $id)
    {
        $request-> validate([
            
            'description'=> 'required|min:5',
        ]);

        $permission = Permission::findOrFail($id);
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

        $permission->save();


        return response()->json(['message' => 'Permission updated successfully', 'permission' => $permission], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePermission($id)
    {
        $isDeleted = Permission::destroy($id);
        if($isDeleted == 1){
            return response()->json(['message'=> 'deleted'], 200);
        }else{
            return response()->json(['message'=> 'ID Not Found'], 200);
        }
    }
    public function search($student_name)
    {
        return Permission::where('student_name', 'like', '%' . $student_name . '%')->get();
    }
}
