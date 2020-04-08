<?php

namespace Bulkly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class BufferPostingController extends Controller
{
    public function index()
    {

        $posts = DB::table('buffer_postings')
        ->join('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
        ->join('social_accounts', 'social_accounts.user_id', '=', 'buffer_postings.user_id')
        ->select('social_post_groups.name','social_post_groups.type as group_type','buffer_postings.post_text',
        'buffer_postings.sent_at','social_accounts.avatar','social_accounts.type')
        ->paginate(10);

        return view("pages.bufferPosting",['posts'=>$posts]);
    }
    public function filter(Request $request) {
        $q = Input::get ('query');
        $date = Input::get ('postDate');
        $type = Input::get('type');

        $posts = DB::table('buffer_postings')
        ->join('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
        ->join('social_accounts', 'social_accounts.user_id', '=', 'buffer_postings.user_id')
        ->where(function ($query) use ($q, $type) {
            if ($q) {
                $query->where('social_post_groups.name',"like",$q."%");
            }
            if ($type) {
                $query->where('social_post_groups.type',$type);
            }
        })
        ->where(function ($query) use ($date) {
            if ($date) {
                $query->where('buffer_postings.sent_at','like',$date."%");
            }
        })
        ->select('social_post_groups.name','social_post_groups.type as group_type','buffer_postings.post_text',
        'buffer_postings.sent_at','social_accounts.avatar','social_accounts.type')
        ->paginate(10);
        if($posts)
            return view("pages.bufferPosting",['posts'=>$posts])->withQuery($q,$date,$type);

        return view("pages.bufferPosting",['posts'=>""])->withQuery($q,$date,$type);



        // if($q){
        //     $posts = DB::table('buffer_postings')
        //     ->join('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
        //     ->join('social_accounts', 'social_accounts.user_id', '=', 'buffer_postings.user_id')
        //     ->where('social_post_groups.name',"like","%".$q."%")
        //     ->select('social_post_groups.name','social_post_groups.type as group_type','buffer_postings.post_text',
        //     'buffer_postings.sent_at','social_accounts.avatar','social_accounts.type')
        //     ->paginate(10);
        //     $pagination = $posts->appends ( ['search'=> $q] );
        //     return view("pages.bufferPosting",['posts'=>$posts])->withQuery($q);

        // }
        // elseif($date){
        //     $posts = DB::table('buffer_postings')
        //     ->join('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
        //     ->join('social_accounts', 'social_accounts.user_id', '=', 'buffer_postings.user_id')
        //     ->where('buffer_postings.sent_at','like',$date."%")
        //     ->select('social_post_groups.name','social_post_groups.type as group_type','buffer_postings.post_text',
        //     'buffer_postings.sent_at','social_accounts.avatar','social_accounts.type')
        //     ->paginate(10);
        //     $pagination = $posts->appends ( ['search'=> $date] );
        //     return view("pages.bufferPosting",['posts'=>$posts])->withQuery($date);
        // }
        // elseif($type){
        //     // dd($type);

        //     $posts = DB::table('buffer_postings')
        //     ->join('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
        //     ->join('social_accounts', 'social_accounts.user_id', '=', 'buffer_postings.user_id')
        //     ->where('social_post_groups.type',$type)
        //     ->select('social_post_groups.name','social_post_groups.type as group_type','buffer_postings.post_text',
        //     'buffer_postings.sent_at','social_accounts.avatar','social_accounts.type')
        //     ->paginate(10);
        //     $pagination = $posts->appends ( ['search'=> $type] );
        //     return view("pages.bufferPosting",['posts'=>$posts])->withQuery($type);
        // }
    }
}
