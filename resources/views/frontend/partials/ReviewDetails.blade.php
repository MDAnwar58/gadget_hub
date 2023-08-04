  <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                          aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title text-center" id="myModalLabel">Users Review</h4>
              </div>
              <div class="modal-body">
                  <div class="row">
                      @if ($ratings->count() > 0)
                          @foreach ($ratings as $rating)
                              <div class="col-xs-12">
                                  <div class="thumbnail">
                                      <div class="caption">
                                          <div class="media">
                                              <div class="media-left">
                                                  {{-- <a href="#"> --}}
                                                  <img class="media-object"
                                                      src="{{ asset('frontend/img/user_img1.png') }}"
                                                      style="width: 70px; height: 70px;" alt="...">
                                                  {{-- </a> --}}
                                              </div>
                                              <div class="media-body">
                                                  <h4 class="media-heading">{{ $rating->user->name }}</h4>
                                                  <div class="user_rateyo_user"
                                                      data-rateyo-rating="{{ $rating->rating }}"></div>
                                                  {{ $rating->des }}
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          @endforeach
                      @else
                          <div class="col-xs-12">
                              <div class="thumbnail">
                                  <div class="caption">
                                      <div class="media">
                                          <div class="media-body">
                                              <h4 class="media-heading">Rating not found</h4>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      @endif
                      <div class="col-xs-12" style="margin: 5rem 0 3rem 0;">
                          <form action="{{ route('rating.store') }}" method="POST">
                              @csrf
                              <div class="row">
                                  <div class="col-xs-12">
                                      <div class="thumbnail">
                                          <div class="caption">
                                              <input type="hidden" name="user_id"
                                                  @if (Auth::check()) value="{{ Auth::user()->id }}" @else value="" @endif">
                                              <input type="hidden" name="item_id" value="{{ $item->id }}">
                                              <div class="form-group d-flex rating_input">
                                                  <label for="">Rating:</label>
                                                  <div id="rateYo_rating_user"></div>
                                                  <span class="rating_user"></span>
                                                  <input type="hidden" name="rating" id="rating" value="">
                                              </div>
                                              <div class="form-group">
                                                  <textarea name="des" id="des" rows="4" class="form-control"></textarea>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="submit-form">
                                  <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
              </div>
          </div>
      </div>
  </div>
