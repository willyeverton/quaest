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
        $categories = array_group_by( $profiles, "category", "profile", "year");

        foreach($categories as $category => $profiles) {
            foreach($profiles as $profile => $years) {
                foreach($years as $year => $months) {
                    foreach($months as $value) {

                        $fb_followers         [] = $value->fb_followers;
                        $fb_number_likes      [] = $value->fb_number_likes;
                        $fb_number_comments   [] = $value->fb_number_comments;
                        $fb_number_posts      [] = $value->fb_number_posts;
                        $insta_followers      [] = $value->insta_followers;
                        $insta_number_comments[] = $value->insta_number_comments;
                        $insta_number_posts   [] = $value->insta_number_posts;
                        $insta_number_likes   [] = $value->insta_number_likes;
                        $twitter_fans         [] = $value->twitter_fans;
                        $twitter_number_posts [] = $value->twitter_number_posts;
                        $twitter_number_likes [] = $value->twitter_number_likes;
                        $twitter_retweets     [] = $value->twitter_retweets;
                    }

                    $rgb = $this->randomRGB();
                    $response["Seguidoras Facebook - $category 20$year"][] = [
                        'label'           => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor'     => $rgb,
                        'data'            => $fb_followers
                    ];

                    $rgb = $this->randomRGB();
                    $response["Custidas Facebook - $category 20$year"][] = [
                        'label' => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor' => $rgb,
                        'data' => $fb_number_likes
                    ];

                    $rgb = $this->randomRGB();
                    $response["Comentários Facebook - $category 20$year"][] = [
                        'label' => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor' => $rgb,
                        'data' => $fb_number_comments
                    ];

                    $rgb = $this->randomRGB();
                    $response["Postagens Facebook - $category 20$year"][] = [
                        'label' => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor' => $rgb,
                        'data' => $fb_number_posts
                    ];

                    $rgb = $this->randomRGB();
                    $response["Seguidoras Instagram - $category 20$year"][] = [
                        'label' => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor' => $rgb,
                        'data' => $insta_followers
                    ];

                    $rgb = $this->randomRGB();
                    $response["Custidas Instagram - $category 20$year"][] = [
                        'label' => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor' => $rgb,
                        'data' => $insta_number_likes
                    ];

                    $rgb = $this->randomRGB();
                    $response["Comentários Instagram - $category 20$year"][] = [
                        'label' => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor' => $rgb,
                        'data' => $insta_number_comments
                    ];

                    $rgb = $this->randomRGB();
                    $response["Postagens Instagram - $category 20$year"][] = [
                        'label' => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor' => $rgb,
                        'data' => $insta_number_posts
                    ];

                    $rgb = $this->randomRGB();
                    $response["Fans Twitter - $category 20$year"][] = [
                        'label' => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor' => $rgb,
                        'data' => $twitter_fans
                    ];

                    $rgb = $this->randomRGB();
                    $response["Custidas Twitter - $category 20$year"][] = [
                        'label' => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor' => $rgb,
                        'data' => $twitter_number_likes
                    ];

                    $rgb = $this->randomRGB();
                    $response["Retweets Twitter - $category 20$year"][] = [
                        'label' => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor' => $rgb,
                        'data' => $twitter_retweets
                    ];

                    $rgb = $this->randomRGB();
                    $response["Postagens Twitter - $category 20$year"][] = [
                        'label' => $profile,
                        'backgroundColor' => $rgb,
                        'borderColor' => $rgb,
                        'data' => $twitter_number_posts
                    ];

                    $fb_followers          = null;
                    $fb_number_likes       = null;
                    $fb_number_comments    = null;
                    $fb_number_posts       = null;
                    $insta_followers       = null;
                    $insta_number_comments = null;
                    $insta_number_posts    = null;
                    $insta_number_likes    = null;
                    $twitter_fans          = null;
                    $twitter_number_posts  = null;
                    $twitter_number_likes  = null;
                    $twitter_retweets      = null;
                }
            }
        }

        return $this->app()->response()->json($response);
    }

    private function randomRGB(){
        $rgbColor = array();
        foreach(array('r', 'g', 'b') as $color){
            //Generate a random number between 0 and 255.
            $rgbColor[$color] = mt_rand(0, 255);
        }
        $rgb = implode(',', $rgbColor);
        return "rgb($rgb)";

    }
}
