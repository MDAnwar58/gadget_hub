@extends('layouts.frontend')
@section('title', 'Contact')

@section('content')
    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <!-- row -->
            <div class="row" style="display: flex; justify-content: center; margin: 5rem 0 10rem 0;">

                <!-- Products tab & slick -->
                <div class="col-md-5">
                    <div class="thumbnail">
                        <div class="caption" style="padding: 1rem;">
                            <h4 class="text-center">Contact Me</h4>
                            <hr>
                            <form action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" name="email" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Subject</label>
                                    <input type="text" name="subject" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Subject</label>
                                    <textarea name="message" id="message" class="form-control" rows="5"></textarea>
                                </div>
                                <div style="text-align: right;">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /container -->
        </div>
    </div>
    <!-- /SECTION -->
@endsection
