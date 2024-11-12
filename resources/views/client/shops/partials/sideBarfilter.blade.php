  <!-- Sidebar Side -->
  <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
    <aside class="sidebar sticky-top">
        
        <!-- Tìm kiếm -->
        <div class="sidebar-widget category-widget">
            <div class="widget-content">
                <!-- Sidebar Title -->
                <div class="sidebar-title">
                    <h6>Search</h6>
                </div>
                <form action="{{route('shop.search')}}" method="GET">
                   
                    <div class="form-group">
                        <input type="search" name="search" value="" placeholder="SEARCH" required 
                        style="border: 1px solid #ccc; padding: 10px; border-radius: 4px; font-size: 13px;width: 70%; box-sizing: border-box;">
                 <button type="submit" class="btn " style="background-color: black; color: white; padding: 10px;">Tìm kiếm</button>
                    </div>
                </form>
                <!-- End Search Popup -->
                
                
            </div>
        </div>
        <!-- Category Widget -->
        <div class="sidebar-widget category-widget">
            <div class="widget-content">
                <!-- Sidebar Title -->
                <div class="sidebar-title">
                    <h6>Product Catagories</h6>
                </div>
                <!-- Category List -->
                <div class="mb-3">
                    @foreach ($categories as $category)
                    <div class="mb-3">
                        <h6>
                            <a href="{{ route('shop.categoryProduct', $category->id) }}" style="color: #000000;">{{ $category->name }}</a>
                        </h6>
                        @if ($category->children->isNotEmpty())
                            <select id="subcategorySelect" onchange="location = this.value;" style="font-size: 16px; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                               
                                @foreach ($category->children as $child)
                                    <option value="{{ route('shop.categoryProduct', $child->id) }}">{{ $child->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    @endforeach
                  
                </div>
            </div>
              
                   
                     

              
                
           
        </div>
        
        <!--Price Widget -->
        <div class="sidebar-widget colors-widget">
            <div class="widget-content">
                <!-- Sidebar Title -->
                <div class="sidebar-title">
                    <h6>Filter Price</h6>
                </div>
                <form action="{{ route('shop.filter') }}" method="GET">
                    <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                        
                        <input type="number" name="min_price" placeholder="Giá min" required 
                            style="border: 1px solid #ccc; padding: 10px; border-radius: 4px; font-size: 13px; width: 30%; box-sizing: border-box;">
                
                        
                        <input type="number" name="max_price" placeholder="Giá max" required 
                            style="border: 1px solid #ccc; padding: 10px; border-radius: 4px; font-size: 13px; width: 30%; box-sizing: border-box;"><br>
               
                        <button type="submit" class="btn" style="background-color: black; color: white; padding: 10px;">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Brands Widget -->
        {{-- <div class="sidebar-widget brands-widget">
            <div class="widget-content">
                <!-- Sidebar Title -->
                <div class="sidebar-title">
                    <h6>brands</h6>
                </div>
                
                <!-- Brands List -->
                <div class="brands-list">
                    <form method="post" action="https://html.themexriver.com/bloxic/contact.html">
                        
                        <div class="form-group">
                            <div class="check-box">
                                <input type="checkbox" name="remember-password" id="type-1">
                                <label for="type-1">Samsung</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="check-box">
                                <input type="checkbox" name="remember-password" id="type-2">
                                <label for="type-2">Oppo</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="check-box">
                                <input type="checkbox" name="remember-password" id="type-3">
                                <label for="type-3">hewaui Galaxy</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="check-box">
                                <input type="checkbox" name="remember-password" id="type-4">
                                <label for="type-4">Ryzen 3600</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="check-box">
                                <input type="checkbox" name="remember-password" id="type-6">
                                <label for="type-6">intel</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="check-box">
                                <input type="checkbox" name="remember-password" id="type-6">
                                <label for="type-6">Mobile Handset</label>
                            </div>
                        </div>
                        
                    </form>
                </div>
                
            </div>
        </div> --}}
        
        <!-- Trending Widget -->
        <div class="sidebar-widget trending-widget">
            <div class="widget-content">
               
                <div class="content">
                    <div class="vector-icon" style="background-image: url(images/icons/vector-3.png)"></div>
                    <div class="title">Trending</div>
                    @foreach ($productnew as $product)
                    <h4>{{$product->name}}</h4>
                    <a class="buy-btn theme-btn" href="#">Buy Now</a>
                    <div class="icon">
                        <img src="{{ Storage::url($product->img_thumbnail) }}" alt="" />
                    </div>
                    @endforeach
                </div>
              
               
            </div>
        </div>
        
        <!-- Tags Widget -->
        <div class="sidebar-widget-two tags-widget">
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
        </div>
        
    </aside>
</div>