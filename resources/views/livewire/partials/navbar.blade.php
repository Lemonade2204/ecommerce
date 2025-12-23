<header class="sticky top-0 z-50 w-full bg-gradient-to-r from-purple-700 via-purple-600 to-indigo-700 shadow-lg">
  <nav class="max-w-[85rem] mx-auto px-6 lg:px-10 flex items-center justify-between h-16" aria-label="Global">
    
    <!-- Brand -->
    <a href="/" class="text-2xl font-extrabold text-yellow-300 tracking-wide">MaNo</a>

    <!-- Mobile Toggle -->
    <div class="md:hidden">
      <button type="button" 
              class="p-2 rounded-md text-yellow-300 hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-yellow-400"
              data-hs-collapse="#navbar-collapse">
        <svg class="w-6 h-6 hs-collapse-open:hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="3" y1="6" x2="21" y2="6"/>
          <line x1="3" y1="12" x2="21" y2="12"/>
          <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
        <svg class="w-6 h-6 hidden hs-collapse-open:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Nav Links -->
    <div id="navbar-collapse" class="hs-collapse hidden md:flex md:items-center md:gap-x-8">
      <a href="/" 
         class="text-sm font-semibold {{ request()->is('/')?'text-yellow-300':'text-white' }} hover:text-yellow-400 transition">
        Home
      </a>
      <a href="/categories" 
         class="text-sm font-semibold {{ request()->is('categories')?'text-yellow-300':'text-white' }} hover:text-yellow-400 transition">
        Categories
      </a>
      <a href="/products" 
         class="text-sm font-semibold {{ request()->is('products')?'text-yellow-300':'text-white' }} hover:text-yellow-400 transition">
        Products
      </a>
      <a href="/cart" 
         class="flex items-center text-sm font-semibold {{ request()->is('cart')?'text-yellow-300':'text-white' }} hover:text-yellow-400 transition">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
          <circle cx="9" cy="21" r="1"/>
          <circle cx="20" cy="21" r="1"/>
        </svg>
        Cart <span class="ml-1 px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-300 text-purple-900">{{$total_count}}</span>
      </a>

      @guest
        <a href="/login" 
           class="ml-4 px-4 py-2 rounded-full bg-yellow-300 text-purple-900 font-semibold hover:bg-yellow-400 transition">
          Log in
        </a>
      @endguest

      @auth
        <div class="relative">
          <!-- Trigger -->
          <button type="button" 
                  class="flex items-center text-sm font-semibold text-white hover:text-yellow-400 focus:outline-none"
                  onclick="document.getElementById('user-menu').classList.toggle('hidden')">
            {{ auth()->user()->name }}
            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M6 9l6 6 6-6"/>
            </svg>
          </button>

          <!-- Dropdown -->
          <div id="user-menu" 
               class="absolute right-0 mt-2 w-48 rounded-lg bg-white shadow-lg text-gray-700 hidden z-50">
            <a href="/my-orders" class="block px-4 py-2 hover:bg-purple-100">My Orders</a>
            <a href="#" class="block px-4 py-2 hover:bg-purple-100">My Account</a>
            <a href="/logout" class="block px-4 py-2 hover:bg-purple-100">Logout</a>
          </div>
        </div>
      @endauth
    </div>
  </nav>
</header>
