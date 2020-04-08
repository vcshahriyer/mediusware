@extends('layouts.app')
@section('content')
<div class="container-fluid app-body">
    <h3>Recent Post Sent to buffer</h3>
    {{-- {{ dd($posts->items()) }} --}}
<div class="row">
    <div class="col-md-12">
        <table class="table table-hover social-accounts"> 
            <form action="{{url('history/filter')}}" method="post">
                {{ csrf_field() }}
                <span class="fa fa-search"></span>
                <input type="text" name="query" id="myInput" placeholder="Search for Group name.." title="Group name">
                <input type="date" id="date" name="postDate">
                <select id="group">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                  </select>
            </form>
            <thead> 
                <tr><th>Group Name</th> <th>Group type</th> <th>Account Name</th> <th>Post text</th> <th>Time</th> </tr> 
            </thead> 
            <tbody> 
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
            </tbody> 
        </table>
        {{ $posts->links() }}
    </div>
</div>

</div>