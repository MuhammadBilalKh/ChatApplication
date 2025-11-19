      <div class="adverts-options beehive-filters">
          <div class="adverts-list adverts-bg-hover mt-4">

              <div class="advert-item advert-item-col-1 animate-item slideInUp advert-id-337 advert-is-featured"
                  style="visibility: visible; animation-name: slideInUp;">
                  <div class="advert-item-inner">

                      @forelse ($pendingAdverts as $key => $value)
                          <div class="advert-overview">
                              <a href="{{ route('adverts.view', ['id' => $value->advertisment_id]) }}"
                                  class="advert-img">
                                  <img decoding="async"
                                      src="{{ asset('/storage/'.$value->getAdvertMedia[0]->media_path) }}"
                                      target="_blank"
                                      alt="{{ $value->advertisment_title }}" class="advert-item-grow">
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
                              <a href="{{ route('adverts.view', ['id' => $value->advertisment_id]) }}"
                                target="_blank"
                                  class="button small">Detail</a>
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
