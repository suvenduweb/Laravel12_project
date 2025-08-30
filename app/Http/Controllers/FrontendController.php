<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FrontendController extends Controller
{
    public function OurTeam(){
        return view('home.team.team_page');
    }

    public function AboutUs(){
        return view('home.about.about_us');
    }

    public function getAboutUs(){
        $about = About::find(1);
        return view('admin.backend.about.get_about',compact('about'));
    }



}
