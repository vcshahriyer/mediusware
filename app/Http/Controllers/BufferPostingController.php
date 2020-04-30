<?php

namespace Bulkly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Bulkly\BufferPosting;

class BufferPostingController extends Controller
{
    public function index()
    {
        $q = Input::get ('query');
        $date = Input::get ('postDate');
        $type = Input::get('type');

        $posts = DB::table('buffer_postings')
        ->leftJoin('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
        ->leftJoin('social_accounts','social_accounts.account_id', '=', 'buffer_postings.id')
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
                $query->where('buffer_postings.sent_at','like',"%".$date."%");
            }
        })
        ->select('social_post_groups.name','social_post_groups.type as group_type','buffer_postings.post_text',
        'buffer_postings.sent_at','social_accounts.avatar','social_accounts.type')
        ->paginate(1)
        ->appends(["query"=>$q,"postDate"=>$date,"type"=>$type]);
        if($posts)
            return view("pages.bufferPosting",['posts'=>$posts]);

        return view("pages.bufferPosting",['posts'=>""]);
    }
}