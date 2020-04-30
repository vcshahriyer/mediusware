{{-- {{ dd($posts) }} --}}
@extends('layouts.app')
@section('content')
<div class="container-fluid app-body">
    <h3>Recent Post Sent to buffer</h3>
<div class="row">
    <div class="col-md-12">
        <table class="table table-hover social-accounts"> 
            <form action="{{url('history')}}" method="get">
                <span class="fa fa-search"></span>
                <input type="text" name="query" placeholder="Search for Group name.." title="Group name">
                <input type="date" name="postDate" data-date-format="YYYY MMMM DD  ">
                <select name="type" id="group">
                    <option value="">All group</option>
                    <option value="upload">Content Upload</option>
                    <option value="curation">Content curation</option>
                    <option value="rss-automation">RSS Automation</option>
                  </select>
                <button>submit</button>
            </form>
            <thead> 
                <tr><th>Group Name</th> <th>Group type</th> <th>Account Name</th> <th>Post text</th> <th>Time</th> </tr> 
            </thead> 
            <tbody>
                @if($posts == "")
                    <tr>
                        <td colspan="5">No Item Found</td>
                    </tr>
                @else
                    @foreach ($posts->items() as $item)
                    <tr>
                        <td>
                        {{ $item->name}}
                        </td> 
                        <td>{{ $item->group_type }}</td> 
                        <td>
                            <div class="media">
                                <div class="media-left">
                                    <a href="">
                                        <span class="fa fa-{{$item->type}}"></span>
                                        <img width="50" class="media-object img-circle" src="{{$item->avatar}}" alt="Profile">
                                    </a>
                                </div>
                                <div class="media-body media-middle" style="width: 180px;">
                                    <h4 class="media-heading"></h4>
                                </div>
                            </div>
                        </td> 
                        <td>
                            {{ $item->post_text }}
                        </td> 
                        <td>
                            {{ $item->sent_at }}
                        </td> 
                    </tr>
                    @endforeach
                @endif
            </tbody> 
        </table>
        {{ $posts->links() }}
    </div>
</div>

</div>