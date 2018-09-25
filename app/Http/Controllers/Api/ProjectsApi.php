<?php

namespace App\Http\Controllers\Api;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class ProjectsApi extends Controller
{
    /**
     * method get_all_projects
     */
    public function get_all_projects() {
        $all_projects = Project::WithCount(['tasks', 'comments'])->orderBy('id')->paginate(2);
        return response(['all_projects' => $all_projects]);
    }
}
