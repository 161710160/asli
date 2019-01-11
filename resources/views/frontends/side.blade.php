<div class="our-recent-post mt--60">
                                <h2 class="section-title-2">LATEST POST</h2>
                                <div class="our-recent-post-wrap">
                                    <!-- Start Single Post -->
                                    @foreach($recent as $data)
                                    <div class="single-recent-post">
                                        <div class="recent-thumb">
                                            <a href="/blogdetails/{{ $data->slug }}"><img src="{{ asset ('assets/img/artikel/' .$data->gambar. '' ) }}" style="margin-top: 10px; max-width: 150px; max-height: 150px;"></a>
                                        </div>
                                        <div class="recent-details">
                                            <div class="recent-post-dtl">
                                                <h6><a href="/blogdetails/{{ $data->slug }}">{!!$data->deskripsi!!}</a></h6>
                                            </div>
                                            <div class="recent-post-time">
                                                <p>{{$data->created_at}}</p>
                                            </div>
                                        </div>
                                    </div>@endforeach
                                    <!-- End Single Post -->
                                    <!-- Start Single Post -->

                                    <!-- End Single Post -->
                                </div>
                            </div>