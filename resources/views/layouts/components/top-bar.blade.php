<div class="top-bar-boxed border-b border-theme-2 -mt-7 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 md:pt-0 mb-12">
  <div class="h-full flex items-center">
    <div class="-intro-x breadcrumb mr-auto">
      @auth('admin')
        <a href="{{route('admin.dashboard')}}">
          Digest<span class="font-medium">TRO</span>
        </a>
      @endauth
      @auth('sanctum')
        <a href="{{route('dashboard')}}">
          Digest<span class="font-medium">TRO</span>
        </a>
      @endauth
      <i data-feather="chevron-right" class="breadcrumb__icon"></i>
      <a href="" class="breadcrumb--active">Dashboard</a>
    </div>
    <div class="intro-x dropdown w-8 h-8">
      <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false">
        <img alt="Digest TRO" src="{{ asset('images/logo_tro.png')}}">
      </div>
      <div class="dropdown-menu w-56">
        <div class="dropdown-menu__content box bg-theme-11 dark:bg-dark-6 text-white">
          <div class="p-4 border-b border-theme-12 dark:border-dark-3">
            <div class="font-medium">{{ auth('admin')->user()->firstName }} {{ auth('admin')->user()->lastName }}</div>
            <div class="text-xs text-theme-13 mt-0.5 dark:text-gray-600">{{ auth('admin')->user()->email }}</div>
            <div class="text-xs text-theme-13 mt-0.5 dark:text-gray-600">{{ auth('admin')->user()->type }}</div>
          </div>
          <div class="p-2">
            <a href="{{route('admin-change-password')}}" class="
                        flex items-center block p-2 transition duration-300 ease-in-out
                        hover:bg-theme-1
                        dark:hover:bg-dark-3
                        rounded-md">

              <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile
            </a>
          </div>
          <div class="p-2 border-t border-theme-12 dark:border-dark-3">
            <a href="{{ route('adminlogout') }}"
               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
              <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
