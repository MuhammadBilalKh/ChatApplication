      <div class="adverts-options beehive-filters">
          <div class="adverts-list adverts-bg-hover mt-4">

              <div class="advert-item advert-item-col-1 animate-item slideInUp advert-id-337 advert-is-featured"
                  style="visibility: visible; animation-name: slideInUp;">
                  <div class="advert-item-inner">

                      @forelse ($pendingAdverts as $key => $value)
                          <div class="advert-overview">
                              <a href="{{ route('adverts.view', ['id' => $value->advertisment_id]) }}" class="advert-img">
                                  <img decoding="async"
                                      src="{{ asset('/storage/' . $value->getAdvertMedia[0]->media_path) }}"
                                      target="_blank" alt="{{ $value->advertisment_title }}" class="advert-item-grow">
                              </a>
                              <div class="ad-info">

                                  <h4 class="adverts-title"><a href="#" type="button"
                                          title="Jacob &amp; Co. Astronomia Sky Platinum">{{ $value->advertisment_title }}</a>
                                  </h4>
                                  <p class="ad-excerpt">{{ \Illuminate\Support\Str::limit($value->description, 50) }},
                                      […]
                                  </p>

                                  <p class="address mute"><i class="uil-location-point"></i>{{ $value->location }}</p>
                                  <p><i class="uil-link-broken"></i>{{ $value->advertisment_code }}</p>
                              </div>
                          </div>

                          <div class="action">
                              <div class="price advert-price color-primary">${{ number_format($value->price) }}</div>
                              <a href="{{ route('adverts.view', ['id' => $value->advertisment_id]) }}" target="_blank"
                                  class="button small">Detail</a>
                              <a type="button" id="{{ $value->advertisment_code }}" onclick="MarkFeatured(this)"
                                  data-toggle="modal" data-target="#modalMarkFeatured" class="button small mt-1">Mark
                                  Featured</a>
                          </div>
                      @empty
                          <div class="advert-overview">
                              <span class="h4">No Pending Advertisments Found..</span>
                          </div>
                      @endforelse

                  </div>
              </div>
          </div>
      </div>


      <div class="modal fade" id="modalMarkFeatured" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Mark Featured</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <span>Please Select The Package:</span>
                      <form method="{{ FORM_METHOD_POST }}" action="{{ route('adverts.mark_advertisment_for_featured') }}">
                          @csrf
                          <div class="row">
                              <div class="col-sm-5">
                                  <div class="form-group">
                                      <input type="hidden" name="advertisment_id" id="txtAdvertismentID" />
                                  <select name="package" id="slctFeaturedPackage" class="form-control">
                                      @foreach ($packages as $key => $value)
                                      <option value="{{ $value->package_id }}">{{ $value->package_name }}
                                          (${{ $value->price }}) - {{ $value->duration_days }} days</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <input type="submit" value="Mark Featured" class="btn btn-success" />
                                </div>
                            </div>
                        </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
