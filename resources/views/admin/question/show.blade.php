@extends('layouts.app')

@section('title', 'Users Question Show')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title"> Ratings - {{ $question->user->name }} </h4>
                        </div>
                        <div class="row px-md-3 px-2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-left">
                                                {{-- <a href="#"> --}}
                                                <p class="bg-primary"
                                                    style="padding: 0 .5rem; border-radius: 5px; margin: 1rem 0 0 0;">Q</p>
                                                {{-- </a> --}}
                                            </div>
                                            <div class="media-body">
                                                <div class="ml-4 mt-1">{{ $question->question }}</div>
                                                <div class="text-right">
                                                    <span>{{ $question->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($answers->count()>0)
                                @foreach ($answers as $answer)

                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-left">
                                                    <p class="bg-warning"
                                                        style="padding: 0 .5rem; border-radius: 5px;">A</p>
                                                    {{-- </a> --}}
                                                </div>
                                                <div class="media-body">
                                                    <div class="ml-4 mt-1">
                                                        {{ $answer->answer }}
                                                    </div>
                                                    <div class="text-right">
                                                        <a href="{{ route('admin.answer.destory', $answer->id) }}" class="badge badge-danger">Delete</a>
                                                    </div>
                                                    <div class="text-right">
                                                        <span>{{ $answer->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="text-center">Answer Not Found</h3>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('admin.answer') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id"
                                                value="{{ Auth::check() ? Auth::user()->id : '' }}">
                                            <input type="hidden" name="item_id" value="{{ $question->item->id }}">
                                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                                            <div class="form-group">
                                                <textarea name="answer" rows="3" class="form-control"></textarea>
                                                <button type="submit" class="btn btn-success">Answer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
