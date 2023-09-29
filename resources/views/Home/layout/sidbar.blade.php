 <!-- Main Slider Start -->
 <div class="header">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-3">
                 <nav class="navbar bg-light">
                     <ul class="navbar-nav">

                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('home.index') }}"><i class="fa fa-home"></i>Home</a>
                         </li>

                         <li class="nav-item">
                            @foreach ($categories as $category)
                                <a class="nav-link" href="{{ route('categories.show', $category->id) }}"><i
                                        class="fa fa-female"></i>{{ $category->name }}</a>
                            @endforeach
                        </li>




                     </ul>
                 </nav>
             </div>
             <div class="col-md-6">
                 <div class="header-slider normal-slider">
                     @foreach ($categories as $category)
                         <div class="header-slider-item">
                             <img src="{{ URL::asset('attachments/upload_attachments/' . $category->image) }}"
                                 alt="Slider Image" style="width:100%" />
                             <div class="header-slider-caption">
                                 <p>{{ $category->name }}</p>
                                 <a class="btn" href="{{ route('categories.show', $category->id) }}"><i
                                         class="fa fa-shopping-cart"></i>Shop Now</a>
                             </div>
                         </div>
                     @endforeach
                 </div>

             </div>
             <div class="col-md-3">
                 <div class="header-img">
                     <div class="img-item">
                         <img src="{{ URL::asset('temp/img/category-1.jpg') }}" />
                         <a class="img-text" href="">
                             <p>Some text goes here that describes the image</p>
                         </a>
                     </div>
                     <div class="img-item">
                         <img src="{{ URL::asset('temp/img/category-2.jpg') }}" />
                         <a class="img-text" href="">
                             <p>Some text goes here that describes the image</p>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Main Slider End -->
