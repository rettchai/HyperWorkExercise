<aside id="logo-sidebar"
    class="fixed  rounded-lg  top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full border-r border-gray-200 sm:translate-x-0 "
    aria-label="Sidebar" {{-- style="background-color : #374151" --}}
    {{-- style="
    background: rgb(179,187,200);
background: linear-gradient(0deg, rgba(179,187,200,1) 25%, rgba(55,65,81,1) 61%);
    " --}}
    style="
    background-color: #374151;
    "
    >
    <div class="h-full pr-2 pb-4 overflow-y-auto  dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-white rounded-lg dark:text-white hover:bg-gray-700 dark:hover:bg-gray-700 group {{ request()->route()->getName() == 'dashboard'? 'bg-gray-700': null }}">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap no-underline" style="">Dashboard</span>
                </a>
            </li>
            @auth
                <li>
                    <hr class="text-white">
                    <div class="text-white text-center">
                        ผู้ใช้งาน
                    </div>
                </li>

            @endauth
        </ul>
    </div>
</aside>
