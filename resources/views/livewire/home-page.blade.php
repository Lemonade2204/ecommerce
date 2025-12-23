<div>
 {{-- Hero Section --}}
<section class="relative h-screen flex items-center justify-center bg-gradient-to-br from-purple-600 via-purple-500 to-indigo-600">
  <div class="text-center max-w-3xl px-6">
    <h1 class="text-6xl font-extrabold text-white leading-tight">
      Welcome to <span class="text-yellow-300">MaNo</span>
    </h1>
    <p class="mt-6 text-lg text-purple-100">
      Shop with ease and confidence.
    </p>
    <div class="mt-8 flex justify-center gap-4">
      <a href="/register"
         class="px-6 py-3 bg-yellow-300 text-purple-900 font-semibold rounded-full shadow hover:bg-yellow-400 transition">
        Get Started →
      </a>

    </div>
  </div>
</section>

{{-- Brands Slider --}}
<section class="py-20 bg-white dark:bg-gray-900">
  <div class="text-center mb-12">
    <h2 class="text-4xl font-bold text-purple-700 dark:text-purple-300">Top Brands</h2>
    <p class="mt-3 text-gray-500">Trusted names in Men things</p>
  </div>

  <div class="swiper brandsSwiper max-w-5xl mx-auto">
    <div class="swiper-wrapper">
      @foreach ($brands as $brand)
        <div class="swiper-slide flex justify-center">
          <div class="bg-purple-100 dark:bg-purple-900 rounded-xl shadow-lg p-6 w-48 hover:scale-105 transition">
            <img src="{{url('storage', $brand->image)}}" alt="{{$brand->name}}" class="w-full h-32 object-contain mb-4">
            <h3 class="text-center font-semibold text-purple-900 dark:text-purple-100">{{$brand->name}}</h3>
          </div>
        </div>
      @endforeach
    </div>
    <div class="swiper-pagination mt-6"></div>
  </div>
</section>

{{-- Categories Slider --}}
<section class="py-20 bg-gradient-to-r from-purple-200 via-purple-300 to-purple-400">
  <div class="text-center mb-12">
    <h2 class="text-4xl font-bold text-purple-900 dark:text-purple-100">Shop by Category</h2>
    <p class="mt-3 text-purple-700 dark:text-purple-300">Explore products your way.</p>
  </div>

  <div class="swiper categoriesSwiper max-w-4xl mx-auto">
    <div class="swiper-wrapper">
      @foreach ($categories as $category)
        <div class="swiper-slide flex justify-center">
          <a href="/products?selected_categories[0]={{$category->id}}"
             class="flex flex-col items-center justify-center bg-white dark:bg-slate-900 rounded-xl shadow-lg w-48 h-48 hover:scale-105 transition">
            <img src="{{url('storage', $category->image)}}" alt="{{$category->name}}" class="w-16 h-16 mb-3">
            <h3 class="text-sm font-semibold text-purple-900 dark:text-purple-100">{{$category->name}}</h3>
          </a>
        </div>
      @endforeach
    </div>
    <div class="swiper-pagination mt-6"></div>
  </div>
</section>

{{-- SwiperJS Setup --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script>
  new Swiper('.brandsSwiper', {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: true,
    autoplay: { delay: 2500 },
    pagination: { el: '.brandsSwiper .swiper-pagination', clickable: true },
    breakpoints: { 320:{slidesPerView:1},640:{slidesPerView:2},1024:{slidesPerView:3} }
  });

  new Swiper('.categoriesSwiper', {
    slidesPerView: 4,
    spaceBetween: 40,
    loop: true,
    autoplay: { delay: 2500 },
    pagination: { el: '.categoriesSwiper .swiper-pagination', clickable: true },
    breakpoints: { 320:{slidesPerView:2},640:{slidesPerView:3},1024:{slidesPerView:4} }
  });
</script>

{{-- customer end --}}
</div>
