      <div class="adverts-options beehive-filters">
          <form action="#" class="adverts-search-form" method="get">

              <div class="adverts-search">
                  <div class="advert-input advert-input-type-half advert-input-type-half-left">
                      <input type="text" name="query" id="query" placeholder="Keyword ...">
                  </div>
                  <div class="advert-input advert-input-type-half advert-input-type-half-right">
                      <input type="text" name="location" id="location" placeholder="Location ...">
                  </div>
              </div>


              <div class="adverts-options-left adverts-sorting-options adverts-js" style="display: block;">
                  <div class="option-wrapper">
                      <a href="/MIGVELv1/adverts/?display=grid" class="adverts-button-small adverts-switch-view light"
                          title="Grid"><i class="uil-grids"></i></a>
                      <a href="/MIGVELv1/adverts/?display=list" class="adverts-button-small adverts-switch-view light"
                          title="List"><i class="uil-list-ul"></i></a>
                      <div class="adverts-list-sort-wrap">
                          <a href="#" class="adverts-button-small adverts-list-sort-button"
                              title="Sort By: Publish Date - Newest First">
                              <span class="adverts-list-sort-label light">Publish Date</span>
                              <i class="uil-sort"></i>
                          </a>
                          <div id="adverts-list-sort-options-wrap" class="adverts-multiselect-holder">
                              <div class="adverts-multiselect-options adverts-list-sort-options">
                                  <span class="adverts-list-sort-option-header">
                                      <strong>Publish Date</strong>
                                  </span>
                                  <a href="/MIGVELv1/adverts/?adverts_sort=date-desc" class="adverts-list-sort-option">
                                      Newest First <i class="uil-check"></i>
                                  </a>
                                  <a href="/MIGVELv1/adverts/?adverts_sort=date-asc" class="adverts-list-sort-option">
                                      Oldest First </a>
                                  <span class="adverts-list-sort-option-header">
                                      <strong>Price</strong>
                                  </span>
                                  <a href="/MIGVELv1/adverts/?adverts_sort=price-asc" class="adverts-list-sort-option">
                                      Cheapest First </a>
                                  <a href="/MIGVELv1/adverts/?adverts_sort=price-desc" class="adverts-list-sort-option">
                                      Most Expensive First </a>
                                  <span class="adverts-list-sort-option-header">
                                      <strong>Title</strong>
                                  </span>
                                  <a href="/MIGVELv1/adverts/?adverts_sort=title-asc" class="adverts-list-sort-option">
                                      From A to Z </a>
                                  <a href="/MIGVELv1/adverts/?adverts_sort=title-desc" class="adverts-list-sort-option">
                                      From Z to A </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="adverts-options-right adverts-js">
                  <a href="#" class="adverts-form-submit button button-primary"><i
                          class="icon ion-android-search"></i></a>
              </div>

              <div class="adverts-options-fallback adverts-no-js" style="display: none;">
                  <input type="submit" value="" />
              </div>

          </form>
      </div>

      <div class="adverts-list adverts-bg-hover mt-4">

          <div class="advert-item advert-item-col-1 animate-item slideInUp advert-id-337 advert-is-featured"
              style="visibility: visible; animation-name: slideInUp;">
              <div class="advert-item-inner">

                  @forelse ($featuredAdverts as $key => $value)
                      <div class="advert-overview">
                          <a href="https://www.clientbetalink.xyz/MIGVELv1/advert/jacob-co-astronomia-sky-platinum/"
                              class="advert-img">
                              <span class="featured-advert">Featured</span>
                              <img decoding="async"
                                  src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/2020/01/900x600-310x207.png"
                                  alt="{{ $value->advertisment_title }}" class="advert-item-grow">
                          </a>
                          <div class="ad-info">

                              <h4 class="adverts-title"><a
                                      href="https://www.clientbetalink.xyz/MIGVELv1/advert/jacob-co-astronomia-sky-platinum/"
                                      title="Jacob &amp; Co. Astronomia Sky Platinum">J{{ $value->advertisment_title }}</a></h4>
                              <p class="ad-excerpt">{{ \Illuminate\Support\Str::limit($value->description, 70) }} , […]
                              </p>

                              <p class="address mute"><i class="uil-location-point"></i>{{ $value->location }}
                              </p>
                          </div>
                      </div>

                      <div class="action">
                          <div class="price advert-price color-primary">${{ number_format($value->price) }}</div>
                          <a href="https://www.clientbetalink.xyz/MIGVELv1/advert/jacob-co-astronomia-sky-platinum/"
                              class="button small">Detail</a>
                      </div>
                  @empty
                      <div class="advert-overview">
                          <span class="h4">No Featured Advertisments Found..</span>
                      </div>
                  @endforelse

              </div>
          </div>
      </div>

      <div class="beehive-pagination">
      </div>
