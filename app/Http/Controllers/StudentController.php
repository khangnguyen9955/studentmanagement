<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function viewStudentProfile()
    {
        return view('pages.Student.student-profile');
    }
    public function viewStudentCalendar()
    {
        return view('pages.Student.student-calendar');
    }

    public function viewStudentGrade()
    {
        return view('pages.Student.student-grade');
    }


    public function viewAddStudentForm()
    {
        return view('pages.Admin.add-student-form');
    }






    public function addStudent()
    {
        $majors = Major::get();
        return view('pages.Admin.add-student', compact('majors'));
    }
    public function saveStudent(Request $request)
    {
        $student = new Student();
        $student->fullName = $request->fullName;
        $student->password = "12345678"; // password default will be 12345678
        $student->role = 2;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->major_id = $request->major_id;
        $user = new User();
        $user->name = $request->fullName;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->role = 2;
        $user->save();
        $student->save();
        return back()->with('student_add', 'Student added successfully!');
    }
    public function studentList()
    {

        $students = Student::with('major', 'classroom')->get();
        return view('pages.Admin.list-student')->with('students', $students);
    }

    public function studentList1()
    {

        $students = Student::with('major', 'classroom')->get();
        return view('pages.Student.list-student1')->with('students', $students);
    }

    public function studentList2()
    {

        $students = Student::with('major', 'classroom')->get();
        return view('pages.Lecturer.list-student2')->with('students', $students);
    }

    public function addStudentToClassroom()
    {
        $students = Student::where('class_id', '=', null)->get();
        $classrooms = Classroom::get();
        // return view('add-student-classroom', compact('students'), compact('classrooms'));
        return view('pages.Admin.add-student-classroom')->with(compact('students', 'classrooms'));
    }

    public function saveStudentToClassroom(Request $request)
    {

        $student = Student::where('id', '=', $request->student_id)->get();
        $classroom = Classroom::where('id', '=', $request->classroom_id)->get();
        if ($student[0]->major_id === $classroom[0]->major_id) {
            Student::where('id', $request->student_id)->update(array('class_id' => $request->classroom_id));
            return back()->with('student_classroom_add', 'Student ' . $student[0]->studentCode . ' has been added to ' . $classroom[0]->classCode . ' successfully!');
        } else {
            return back()->with('student_classroom_add', 'Student must been added to the class which has the same majority with them!');
        }
    }

    public function editStudent($id)
    {
        $students = Student::where('id', '=', $id)->first();
        $majors = Major::get();
        $classrooms = Classroom::get();

        return view('pages.Admin.edit-student')->with(compact('students', 'majors', 'classrooms'));
    }

    public function updateStudent(Request $request)
    {
        $id = $request->id;
        $fullName = $request->fullName;
        $email = $request->email;
        $phone = $request->phone;
        $majorID = $request->major_id;
        $classID = $request->classroom_id;


        Student::where('id', '=', $id)->update([
            'fullName' => $fullName,
            'email' => $email,
            'phone' => $phone,
            'major_id' => $majorID,
            'class_id' => $classID
        ]);
        return back()->with('student_edit', 'Student updated successfully!');
    }
    public function removeStudent($id)
    {
        // Student::where('id', '=', $id)->delete();
        $checkStudent = Attendance::where('student_id', '=', $id);
        if ($checkStudent !== null) {
            return redirect()->back()->with('delete_student_failure', 'This student has been added to a classroom, you cannot delete it from the system!');
        } else {
            Student::destroy($id);
            return redirect()->back()->with('delete_student_success', '
        Student removed successfully ');
        }
    }
}
