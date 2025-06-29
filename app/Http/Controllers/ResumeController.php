<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    //


    public function index(){
        $resume = Storage::disk('resumes')->get('resume.json');

        $data = json_decode($resume, true);

        //return view('resume', ['resume' => $resumeData]);

        return view('resume', [
            'basics' => $data['basics'],
            'skills' => $data['skills'],
            'languages' => $data['languages'],
            'work' => $data['work'],
            'education' => $data['education'],
            'projects' => $data['projects'],
            'certificates' => $data['certificates'],
        ]);

    }

}
