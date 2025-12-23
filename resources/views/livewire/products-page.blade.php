<div class="w-full max-w-[85rem] py-10 px-6 mx-auto">
  <section class="py-10 bg-gradient-to-br from-purple-50 via-white to-purple-100 dark:from-slate-800 dark:via-slate-900 dark:to-purple-900 rounded-2xl shadow-lg">
    <div class="px-6 py-6 mx-auto max-w-7xl lg:py-8 md:px-8">
      <div class="flex flex-wrap -mx-4">

        {{-- Sidebar Filters --}}
        <aside class="w-full lg:w-1/4 px-4 mb-10 lg:mb-0">
          <!-- Categories -->
          <div class="p-6 mb-6 rounded-xl backdrop-blur-md bg-white/70 dark:bg-slate-800/70 shadow-lg">
            <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300 flex items-center gap-2">
              <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
              Categories
            </h2>
            <div class="w-16 border-b-2 border-purple-400 my-4"></div>
            <ul>
              @foreach ($categories as $category)
                <li class="mb-3" wire:key="{{$category->id}}">
                  <label for="{{$category->slug}}" class="flex items-center cursor-pointer text-gray-700 dark:text-gray-300 hover:text-purple-600">
                    <input type="checkbox" wire:model.live="selected_categories" id="{{$category->slug}}" value="{{$category->id}}" class="w-4 h-4 mr-2 accent-purple-600">
                    <span class="text-base">{{$category->name}}</span>
                  </label>
                </li>
              @endforeach
            </ul>
          </div>

          <!-- Brands -->
          <div class="p-6 mb-6 rounded-xl backdrop-blur-md bg-white/70 dark:bg-slate-800/70 shadow-lg">
            <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300 flex items-center gap-2">
              <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 2l9 4-9 4-9-4 9-4zm0 8l9 4-9 4-9-4 9-4z"/></svg>
              Brands
            </h2>
            <div class="w-16 border-b-2 border-purple-400 my-4"></div>
            <ul>
              @foreach ($brands as $brand)
                <li class="mb-3" wire:key="{{$brand->id}}">
                  <label for="{{$brand->slug}}" class="flex items-center cursor-pointer text-gray-700 dark:text-gray-300 hover:text-purple-600">
                    <input type="checkbox" wire:model.live="selected_brands" id="{{$brand->slug}}" value="{{$brand->id}}" class="w-4 h-4 mr-2 accent-purple-600">
                    <span class="text-base">{{$brand->name}}</span>
                  </label>
                </li>
              @endforeach
            </ul>
          </div>

          <!-- Status -->
          <div class="p-6 mb-6 rounded-xl backdrop-blur-md bg-white/70 dark:bg-slate-800/70 shadow-lg">
            <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300">Product Status</h2>
            <div class="w-16 border-b-2 border-purple-400 my-4"></div>
            <ul>
              <li class="mb-3">
                <label for="featured" class="flex items-center cursor-pointer text-gray-700 dark:text-gray-300 hover:text-purple-600">
                  <input type="checkbox" id="featured" wire:model.live="featured" value="1" class="w-4 h-4 mr-2 accent-purple-600">
                  <span>Featured Products</span>
                </label>
              </li>
              <li class="mb-3">
                <label for="on_sale" class="flex items-center cursor-pointer text-gray-700 dark:text-gray-300 hover:text-purple-600">
                  <input type="checkbox" id="on_sale" wire:model.live="on_sale" value="1" class="w-4 h-4 mr-2 accent-purple-600">
                  <span>On Sale</span>
                </label>
              </li>
            </ul>
          </div>

          <!-- Price -->
          <div class="p-6 rounded-xl backdrop-blur-md bg-white/70 dark:bg-slate-800/70 shadow-lg">
            <h2 class="text-xl font-bold text-purple-700 dark:text-purple-300">Price</h2>
            <div class="w-16 border-b-2 border-purple-400 my-4"></div>
            <div>
              <div class="font-semibold text-purple-700 dark:text-purple-300 mb-2">
                {{ Number::currency($price_range,'PHP') }}
              </div>
              <input type="range" wire:model.live='price_range' class="w-full accent-purple-600 cursor-pointer" max="500000" value="300000" step="1000">
              <div class="flex justify-between mt-2 text-sm font-bold text-purple-600">
                <span>{{ Number::currency(1000, 'PHP') }}</span>
                <span>{{ Number::currency(500000, 'PHP') }}</span>
              </div>
            </div>
          </div>
        </aside>

        {{-- Products Grid --}}
        <div class="w-full lg:w-3/4 px-4">
          <!-- Sort Bar -->
          <div class="flex justify-end mb-6">
            <select wire:model.live='sort' class="px-4 py-2 rounded-lg border border-purple-300 bg-white dark:bg-slate-900 dark:text-gray-300 focus:ring-2 focus:ring-purple-500">
              <option value="latest">Sort by Latest</option>
              <option value="price">Sort by Price</option>
            </select>
          </div>

          <!-- Product Cards -->
          <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
              <div wire:key="{{$product->id}}" class="bg-white dark:bg-slate-900 rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
                <a href="/products/{{$product->slug}}">
                  <img src="{{url('storage/' . $product->image[0])}}" alt="{{$product->name}}" class="object-cover w-full h-56 rounded-t-xl">
                </a>
                <div class="p-4">
                  <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ $product->name }}</h3>
                  <p class="text-purple-700 dark:text-purple-300 font-bold mb-4">{{ Number::currency($product->price, 'PHP') }}</p>
                  <button wire:click.prevent='addToCart({{$product->id}})' class="w-full py-2 rounded-full bg-purple-600 text-white font-semibold hover:bg-purple-700 transition">
                    <span wire:loading.remove wire:target='addToCart({{$product->id}})'>Add to Cart</span>
                    <span wire:loading wire:target='addToCart({{$product->id}})'>Adding...</span>
                  </button>
                </div>
              </div>
            @endforeach
          </div>

          <!-- Pagination -->
          <div class="flex justify-end mt-8">
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
