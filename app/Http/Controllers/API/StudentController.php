<?php

namespace App\Http\Controllers\Api;

use App\Entities\Student;
use App\User;
use App\Http\Requests\Api\Student\StoreStudentRequest;
use App\Http\Requests\Api\Student\UpdateStudentRequest;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentStatus;
use App\Http\Controllers\Api\Traits\StudentAvatar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use Storage;
use DB;

class StudentController extends Controller
{
    use StudentAvatar;
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::all();
        return new StudentCollection($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\Student\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());
        return response()->json(["data"=>[
            'id' => $student->id,
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'address' => $student->address,
            'grade' => $student->grade,
            'teacher_name' => $student->teacher_name,
            'special_disabilities' => $student->special_disabilities,
            'guardian_name' => $student->guardian_name,
            'guardian_contact' => $student->guardian_contact,
            'avatar_url' => $student->avatar_url,
            'avatar_path' => $student->avatar_path,
            'created_at' => $student->created_at,
            'updated_at' => $student->updated_at
        ]]);

        // return new StudentResource($student);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Student $Student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student, $id = null)
    {
        return new StudentResource($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Student\UpdateStudentRequest  $request
     * @param  \App\Entities\Student $Student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());

        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->destroy();
    }
}
