<?php

namespace App\Controllers;

use App\Models\Profile;

class DashboardController extends Controller
{

    public function index()
    {

        return $this->app()->view('chart', []);
    }

    public function chart()
    {
        $query = $this->app()->database;

        $profiles = $query->on(Profile::class)->selectAll();

        $data = array_group_by( $profiles, "category", "profile", "year", "month");

        foreach($data as $category => $profile) {
            foreach($profile as $year => $month) {
                $response[] = [
                    'label' => "$category: $profile ($year)",
                    'backgroundColor'=> 'rgb(255, 99, 132)',
                    'borderColor'=> 'rgb(255, 99, 132)',
                    'data'=> [0, 10, 5, 2, 20, 30, 45]
                ];
            }
        }

        return $this->app()->response()->json($response);
    }
}
