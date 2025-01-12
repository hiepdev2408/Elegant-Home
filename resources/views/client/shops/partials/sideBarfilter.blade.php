  <!-- Sidebar Side -->
  <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
      <aside class="sidebar sticky-top">

          <!-- Tìm kiếm -->
          <div class="sidebar-widget category-widget">
              <div class="widget-content">
                  <!-- Sidebar Title -->
                  <div class="sidebar-title">
                      <h6>Tìm kiếm</h6>
                  </div>
                  <form id="search-form" action="{{ route('shop.search') }}" method="GET">
                      <div class="form-group">
                          <input type="search" name="search" value="" placeholder="Tìm kiếm ..." required
                              style="border: 1px solid #ccc; padding: 10px; border-radius: 4px; font-size: 13px;width: 70%; box-sizing: border-box;">
                          <button type="submit" class="btn"
                              style="background-color: black; color: white; padding: 10px;">Tìm kiếm</button>
                      </div>
                  </form>
                  <div id="product-results"></div>
                  <!-- End Search Popup -->


              </div>
          </div>
          <!-- Category Widget -->
          <div class="sidebar-widget category-widget">
              <div class="widget-content">
                  <!-- Sidebar Title -->
                  <div class="sidebar-title">
                      <h6>Danh mục</h6>
                  </div>
                  <!-- Category List -->
                  <div class="mb-3 category-list">
                      @foreach ($categories as $category)
                          <div class="mb-3">
                              <a href="#" class="category-link" data-id="{{ $category->id }}"
                                  style="font-size: 16px; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; display: block; text-decoration: none; color: inherit;">
                                  {{ $category->name }}
                              </a>
                          </div>
                      @endforeach
                  </div>

              </div>
              <aside class="sidebar sticky-top">

                  <!--Price Widget -->
                  <div class="sidebar-widget colors-widget">
                      <div class="widget-content">
                          <!-- Sidebar Title -->
                          <div class="sidebar-title">
                              <h6>Lọc theo giá</h6>
                          </div>
                          <form id="filter-form" action="{{ route('shop.filter') }}" method="GET">
                              <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                                  <input type="number" name="min_price" placeholder="Giá nhỏ nhất" required
                                      style="border: 1px solid #ccc; padding: 10px; border-radius: 4px; font-size: 13px; width: 30%; box-sizing: border-box;">
                                  <input type="number" name="max_price" placeholder="Giá lớn nhất" required
                                      style="border: 1px solid #ccc; padding: 10px; border-radius: 4px; font-size: 13px; width: 30%; box-sizing: border-box;"><br>
                                  <button type="submit" class="btn"
                                      style="background-color: black; color: white; padding: 10px;">Lọc</button>
                              </div>
                          </form>
                          <div id="product-results"></div>
                      </div>
                  </div>
                  <!-- Trending Widget -->
                  @if ($productnew->isNotEmpty())
                      <div class="sidebar-widget trending-widget">
                          <div class="widget-content">

                              <div class="content">
                                  <div class="vector-icon" style="background-image: url(images/icons/vector-3.png)">
                                  </div>
                                  <div class="title">Xu hướng</div>
                                  @foreach ($productnew as $product)
                                      <h4>{{ $product->name }}</h4>
                                      <a class="buy-btn theme-btn" href="#">Mua ngay</a>
                                      <div class="icon">
                                          <img src="{{ Storage::url($product->img_thumbnail) }}" alt="" />
                                      </div>
                                  @endforeach
                              </div>
                          </div>
                      </div>
                  @endif


                  <!-- Tags Widget -->
                  {{-- <div class="sidebar-widget-two tags-widget">
                      <div class="widget-content">
                          <!-- Sidebar Title -->
                          <div class="sidebar-title">
                              <h6>Tags</h6>
                          </div>
                          <ul class="tag-list">
                              <li><a href="#">symphony</a></li>
                              <li><a href="#">nokia</a></li>
                              <li><a href="#">samsung</a></li>
                              <li><a href="#">Alcatel</a></li>
                              <li><a href="#">landing</a></li>
                              <li><a href="#">Oppos</a></li>
                              <li><a href="#">I phone Pro 12</a></li>
                              <li><a href="#">poco X3</a></li>
                          </ul>
                      </div>
                  </div> --}}

              </aside>
          </div>
