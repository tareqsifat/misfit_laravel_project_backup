<?php

namespace App\Http\Controllers;

use App\Models\Course\Course;
use App\Models\Course\CourseBatches;
use App\Models\Course\CourseCategory;
use App\Models\CourseType;
use App\Models\Seminars\Seminars;
use Carbon\Carbon;
use Illuminate\Http\Request;


class WebsiteController extends Controller
{
    public function index()
    {
        $course_categories = CourseCategory::where('status', 'active')->get();
        $course_types = CourseType::where('status', 'active')->get();
        $courses = Course::active()->with(['course_batch' => function ($batch) {
            $batch->orderBY('id', 'desc')->take(1);
        }])->get();
        $seminar = Seminars::whereDate('date_time', '>', Carbon::today())->get();
        return view(
            'frontend.home',
            [
                'course_categories' => $course_categories,
                'course_types' => $course_types,

                'courses' => $courses,
                "seminar" => $seminar,
            ]
        );
    }

    public function all_types()
    {
        return CourseType::active()->get();
    }

    public function all_course()
    {
        $query = Course::select('id', 'title','slug', 'image')->active();
        if (request()->has('course_type')) {
            $query->whereExists(function ($query) {
                $query->from('course_course_types')
                    ->whereColumn('course_course_types.course_id', 'courses.id')
                    ->where('course_course_types.course_type_id', request()->course_type);
            });
        }
        $courses = $query->paginate(3);

        if (request()->has('course_type')) {
            $courses->appends('course_type', request()->course_type);
        }

        foreach ($courses as $course) {
            // $course->rest_days = $course
            $course->details = $course->course_batch()
                ->select([
                    'id', 'course_id', 'admission_end_date',
                    'batch_student_limit', 'seat_booked', 'course_price', 'after_discount_price', 'booked_percent'
                ])
                ->active()->orderBy('id', 'DESC')->first();
        }
        return response()->json($courses);
    }

    public function course_details($slug) {
        $data = Course::active()->where('slug',$slug)->first();
        return view('frontend.pages.course_details', ['data' => $data]);
    }

    public function type_wise_course()
    {
        // $courses = Course
        $seminar = Seminars::whereDate('date_time', '>', Carbon::today())->get();
        return view('frontend.home', compact('seminar'));
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function courses()
    {
        return view('frontend.pages.courses');
    }

    public function gallery()
    {
        return view('frontend.pages.gallery');
    }

    public function blog()
    {
        return view('frontend.pages.blog');
    }

    public function seminar()
    {
        $seminars = Seminars::whereDate('date_time', '>', Carbon::today())->get();
        return view('frontend.pages.seminar', compact('seminars'));
    }

    public function it_solution_services()
    {
        return view('frontend.pages.it_solution_services');
    }
    public function myCourse(){
        return view('frontend.pages.mycouse');
    }
}
