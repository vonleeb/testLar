@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                    <h2>Feedbacks</h2>
                    <p>
                    <form name="sortForm" action="/" method="get">
                        <select name="sorting" onchange="document.forms['sortForm'].submit()">
                            <option>select sort</option>
                            <option @if(\App\Http\Helpers\SortHelper::$sorting == "user_name+asc")
                                    selected
                                    @endif
                                    value="user_name+asc">Name A-Z</option>
                            <option @if(\App\Http\Helpers\SortHelper::$sorting == "user_name+desc")
                                    selected
                                    @endif
                                    value="user_name+desc">Name Z-A</option>
                            <option @if(\App\Http\Helpers\SortHelper::$sorting == "email+asc")
                                    selected
                                    @endif
                                    value="email+asc">Email A-Z</option>
                            <option @if(\App\Http\Helpers\SortHelper::$sorting == "email+desc")
                                    selected
                                    @endif
                                    value="email+desc">Email Z-A</option>
                            <option @if(\App\Http\Helpers\SortHelper::$sorting == "created_at+asc")
                                    selected
                                    @endif
                                    value="created_at+asc">Date oldest</option>
                            <option @if(\App\Http\Helpers\SortHelper::$sorting == "created_at+desc")
                                    selected
                                    @endif
                                    value="created_at+desc">Date newest</option>
                        </select>
                    </form>
                    </p>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Message</th>
                        <th>E-mail</th>
                        @if(!auth()->guest() && auth()->user()->isAdmin === 1)
                            <th>delete</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($feedbacks as $fb)
                        <tr style="height:100px;">
                            <td><img src="{{ asset('storage/' . $fb->photo_name) }}" alt="img"
                                     style="display: block;max-width: 100px; max-height: 100px; width: auto; height: auto;"></td>
                            <td>{{ $fb->user_name }}</td>
                            <td>{{ $fb->message }}</td>
                            <td>{{ $fb->email }}</td>
                            @if(!auth()->guest() && auth()->user()->isAdmin === 1)
                                <td><a href="/feedback/{{ $fb->id }}/delete">delete</a></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <form method="post" action="/feedback/send" class="form-fieldset" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br>
                    <h2>Leave feedback</h2>
                    <div class="form-group">
                        <label class="form-label">Name<span class="form-required">*</span></label>
                        <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror"
                               name="user_name" maxlength="50" value="{{ old('user_name') }}"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">E-mail<span class="form-required">*</span></label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message<span class="form-required">*</span></label>
                        <textarea id="message" class="form-control @error('message') is-invalid @enderror" rows="3"
                                  name="message" maxlength="200">{{ old('message') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="form-label">Upload a photo</label><br>
                        <input id="photo" type="file" name="photo" accept="image/jpeg,image/png,image/gif"/>
                    </div>
                    <button type="submit" class="btn btn-primary ml-auto">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection