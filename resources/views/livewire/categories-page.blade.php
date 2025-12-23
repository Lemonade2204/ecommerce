<section class="w-full max-w-[85rem] mx-auto px-6 py-16">
  <div class="text-center mb-12">
    <h2 class="text-4xl font-extrabold text-purple-700 dark:text-purple-300">
      Explore <span class="text-yellow-400">Categories</span>
    </h2>
    <p class="mt-3 text-gray-600 dark:text-gray-400">
      Find the products you love, beautifully organized.
    </p>
  </div>

  <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    @foreach ($categories as $category)
      <a href="/products?selected_categories[0]={{$category->id}}" 
         wire:key="{{$category->id}}"
         class="group relative flex flex-col items-center justify-center rounded-2xl p-8 
                bg-gradient-to-br from-purple-100 via-white to-purple-50 
                dark:from-purple-900 dark:via-slate-800 dark:to-purple-800 
                shadow-lg hover:shadow-xl hover:scale-105 transition transform">
        
        <!-- Category Image -->
        <div class="flex items-center justify-center w-24 h-24 rounded-full 
                    bg-white/70 dark:bg-slate-700/70 shadow-md mb-6 group-hover:rotate-6 transition">
          <img src="{{ url('storage', $category->image) }}" 
               alt="{{ $category->name }}" 
               class="w-16 h-16 object-contain">
        </div>

        <!-- Category Name -->
        <h3 class="text-xl font-bold text-purple-900 dark:text-purple-100 group-hover:text-yellow-500 transition">
          {{ $category->name }}
        </h3>

        <!-- Arrow Icon -->
        <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition">
          <svg class="w-6 h-6 text-purple-600 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg" 
               fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M9 5l7 7-7 7" />
          </svg>
        </div>
      </a>
    @endforeach
  </div>
</section>
