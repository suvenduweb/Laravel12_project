@extends('home.home_master')
@section('home')



  <!-- End mobile menu -->

  <div class="breadcrumb-wrapper light-bg">
    <div class="container">

      <div class="breadcrumb-content">
        <h1 class="breadcrumb-title pb-0">Blog</h1>
        <div class="breadcrumb-menu-wrapper">
          <div class="breadcrumb-menu-wrap">
            <div class="breadcrumb-menu">
              <ul>
                <li><a href="index.html">Home</a></li>
                <li><img src="{{asset('frontend/assets/images/blog/right-arrow.svg')}}" alt="right-arrow"></li>
                <li aria-current="page">Blog</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- End breadcrumb -->

  <div class="lonyo-section-padding9 overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="lonyo-blog-wrap" data-aos="fade-up" data-aos-duration="500">
            <div class="lonyo-blog-thumb">
              <img src="assets/images/blog/b1.png" alt="">
            </div>
            <div class="lonyo-blog-meta">
              <ul>
                <li>
                  <a href="single-blog.html"><img src="assets/images/blog/date.svg" alt="">June 15, 2025</a>
                </li>
                <li>
                  <a href="single-blog.html"><img src="assets/images/blog/clock.svg" alt="">5 min read</a>
                </li>
              </ul>
            </div>
            <div class="lonyo-blog-content">
              <h2><a href="single-blog.html">A guide to free personal finance software</a></h2>
              <p>Imagine having a tool that meticulously tracks all income and expenses savings all in one place — sounds like a...</p>
            </div>
            <div class="lonyo-blog-btn">
              <a href="single-blog.html" class="lonyo-default-btn blog-btn">continue reading</a>
            </div>
          </div>
          <div class="lonyo-blog-wrap" data-aos="fade-up" data-aos-duration="700">
            <div class="lonyo-blog-thumb">
              <img src="assets/images/blog/b2.png" alt="">
            </div>
            <div class="lonyo-blog-meta">
              <ul>
                <li>
                  <a href="single-blog.html"><img src="assets/images/blog/date.svg" alt="">June 10, 2025</a>
                </li>
                <li>
                  <a href="single-blog.html"><img src="assets/images/blog/clock.svg" alt="">7 min read</a>
                </li>
              </ul>
            </div>
            <div class="lonyo-blog-content">
              <h2><a href="single-blog.html">AI-powered tools for increasing productivity</a></h2>
              <p>Artificial Intelligence (AI) has revolutionized many industries, and the field of finance and financial planning and analysis...</p>
            </div>
            <div class="lonyo-blog-btn">
              <a href="single-blog.html" class="lonyo-default-btn blog-btn">continue reading</a>
            </div>
          </div>
          <div class="lonyo-blog-wrap mb-0" data-aos="fade-up" data-aos-duration="900">
            <div class="lonyo-blog-thumb">
              <img src="assets/images/blog/b3.png" alt="">
            </div>
            <div class="lonyo-blog-meta">
              <ul>
                <li>
                  <a href="single-blog.html"><img src="assets/images/blog/date.svg" alt="">June 05, 2025</a>
                </li>
                <li>
                  <a href="single-blog.html"><img src="assets/images/blog/clock.svg" alt="">10 min read</a>
                </li>
              </ul>
            </div>
            <div class="lonyo-blog-content">
              <h2><a href="single-blog.html">Using finance software to boost your income</a></h2>
              <p>Are you aware of the fact that what is the most significant stress cause in the United States of America? If your...</p>
            </div>
            <div class="lonyo-blog-btn">
              <a href="single-blog.html" class="lonyo-default-btn blog-btn">continue reading</a>
            </div>
          </div>
          <div class="lonyo-pagination center">
            <a class="pagi-btn btn2" href="single-blog.html">
              <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.75 0.75L6 6L0.75 11.25" stroke="#001A3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </a>
            <ul>
              <li><a class="current" href="#">1</a></li>
              <li><a href="single-blog.html">2</a></li>
              <li><a href="single-blog.html">3</a></li>
            </ul>
            <a class="pagi-btn" href="single-blog.html">
              <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.75 0.75L6 6L0.75 11.25" stroke="#001A3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </a>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="lonyo-blog-sidebar" data-aos="fade-left" data-aos-duration="700">
            <div class="lonyo-blog-widgets">
              <form action="#">
                <div class="lonyo-search-box">
                  <input type="search" placeholder="Type keyword here">
                  <button id="lonyo-search-btn" type="button"><i class="ri-search-line"></i></button>
                </div>
              </form>
            </div>
            <div class="lonyo-blog-widgets">
              <h4>Categories:</h4>
              <div class="lonyo-blog-categorie">
                <ul>
                    @foreach ($blogcat as $cat)
                        <li><a href="single-blog.html">{{$cat->category_name}} <span>({{$cat->posts_count}})</span></a></li>
                    @endforeach
                </ul>
              </div>
            </div>
            <div class="lonyo-blog-widgets">
              <h4>Recent Posts</h4>
              <a class="lonyo-blog-recent-post-item" href="single-blog.html">
                <div class="lonyo-blog-recent-post-thumb">
                  <img src="assets/images/blog/b4.png" alt="">
                </div>
                <div class="lonyo-blog-recent-post-data">
                  <ul>
                    <li><img src="assets/images/blog/date.svg" alt="">June 15, 2025</li>
                  </ul>
                  <div>
                    <h4>7 businesses for easy money</h4>
                  </div>
                </div>
              </a>
              <a class="lonyo-blog-recent-post-item" href="single-blog.html">
                <div class="lonyo-blog-recent-post-thumb">
                  <img src="assets/images/blog/b5.png" alt="">
                </div>
                <div class="lonyo-blog-recent-post-data">
                  <ul>
                    <li><img src="assets/images/blog/date.svg" alt="">June 12, 2025</li>
                  </ul>
                  <div>
                    <h4>10 Finance apps for you to use</h4>
                  </div>
                </div>
              </a>
              <a class="lonyo-blog-recent-post-item" href="single-blog.html">
                <div class="lonyo-blog-recent-post-thumb">
                  <img src="assets/images/blog/b6.png" alt="">
                </div>
                <div class="lonyo-blog-recent-post-data">
                  <ul>
                    <li><img src="assets/images/blog/date.svg" alt="">June 08, 2025</li>
                  </ul>
                  <div>
                    <h4>How to create a stock market</h4>
                  </div>
                </div>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end blog -->
  <div class="lonyo-content-shape">
    <img src="{{asset('frontend/assets/images/shape/shape2.svg')}}" alt="">
  </div>

 @include('home.homelayout.apps');
  <!-- end cta -->


@endsection
