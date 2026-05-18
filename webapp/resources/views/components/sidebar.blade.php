<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         
         @foreach(config('sidebar') as $section)
            <li>
               <span class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white mt-4">
                  <span class="ml-3 font-bold uppercase text-xs text-gray-500 tracking-wider">{{ $section['title'] }}</span>
               </span>
               <ul class="pl-4 space-y-1">
                  @foreach($section['pages'] as $page)
                     <li>
                        <a href="{{ $page['url'] }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                           {{-- If you have font awesome or heroicons, put icon here. Using a generic dot for now --}}
                           <span class="w-2 h-2 ml-1 rounded-full bg-gray-400 group-hover:bg-blue-600"></span>
                           <span class="ml-3 text-sm font-normal">{{ $page['title'] }}</span>
                        </a>
                     </li>
                  @endforeach
               </ul>
            </li>
         @endforeach

      </ul>
   </div>
</aside>
