<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminLessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function __invoke(Request $request)
    {
        $lessons = Lesson::with(['student', 'school', 'creator.user', 'car'])
            ->latest()->simplePaginate();
        return AdminLessonResource::collection($lessons);
    }
}
