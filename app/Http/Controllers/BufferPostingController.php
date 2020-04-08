<?php

namespace Bulkly\Http\Controllers;

use Illuminate\Http\Request;
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
        if($request->query){
            $posts = DB::table('buffer_postings')
            ->join('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
            ->join('social_accounts', 'social_accounts.user_id', '=', 'buffer_postings.user_id')
            ->where('social_post_groups.name',"like","%".$request->input('query')."%")
            ->select('social_post_groups.name','social_post_groups.type as group_type','buffer_postings.post_text',
            'buffer_postings.sent_at','social_accounts.avatar','social_accounts.type')
            ->paginate(10);
        return view("pages.bufferPosting",['posts'=>$posts]);

        }
    }
}
