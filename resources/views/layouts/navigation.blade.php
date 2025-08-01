<nav x-data="{ open: false }" class=" navbar bg-base-100 flex-col">
    <!-- Primary Navigation Menu -->
    <div class="w-full flex justify-between items-center px-2 sm:px-6 lg:px-8">
        <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center mx-2">
                            <a href="{{ route('home') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            </a>
                        </div>
                        <!-- Navigation Links -->
                        <div role="tablist" class="tabs tabs-border flex mx-2">
                            <a href="{{route('home')}}" role="tab" class="tab {{request()->routeIs('home') ?'tab-active'  : ''}} ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                    <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                                </svg>
                            </a>
                            <a role="tab" x-on:click='open = ! open'  href="{{route('search')}}"  class="tab  md:hidden  {{request()->routeIs('search.*') ?'tab-active'  : ''}}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-7">
                                    <path d="M8.25 10.875a2.625 2.625 0 1 1 5.25 0 2.625 2.625 0 0 1-5.25 0Z" />
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.125 4.5a4.125 4.125 0 1 0 2.338 7.524l2.007 2.006a.75.75 0 1 0 1.06-1.06l-2.006-2.007a4.125 4.125 0 0 0-3.399-6.463Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <form class="filter hidden md:block " action="{{ route('search') }}" method="GET">
                                <div class="join">
                                    <div>
                                        <label class="input  join-item">
                                        <input class=" hover:border-none focus:border-none focus:outline-none hover:outline-none  border-none outline-none" type="text" placeholder="{{__("Search")}}" required />
                                        </label>
                                    </div>
                                    <button class="btn btn-neutral join-item">  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                <path d="M8.25 10.875a2.625 2.625 0 1 1 5.25 0 2.625 2.625 0 0 1-5.25 0Z" />
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.125 4.5a4.125 4.125 0 1 0 2.338 7.524l2.007 2.006a.75.75 0 1 0 1.06-1.06l-2.006-2.007a4.125 4.125 0 0 0-3.399-6.463Z" clip-rule="evenodd" />
                                </svg></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        @auth
                        <div class="dropdown dropdown-end">
                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS Navbar component" src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                </div>
                            </div>
                            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                                <li>
                                    {{-- <x-dropdown-link :href="route('filament.dashboard.pages..')">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link> --}}
                                </li>
                                <li>
                                    <x-dropdown-link :href="route('profile',auth()->user()->username)">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                </li>

                                <li>
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Settings') }}
                                    </x-dropdown-link>
                                </li>
                                <li>
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                                </x-dropdown-link>
                        </li>
                            </ul>
                        </div>
                        @else
                            <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                                >
                                    Log in
                                </a>
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endauth

                    </div>
    </div>


    <form  x-show="open" class="filter pt-3 pb-1" action="{{ route('search') }}" method="GET">
        <div class="join">
            <div>
                <label class="input  join-item">
                <input class=" hover:border-none focus:border-none focus:outline-none hover:outline-none w-2/3  border-none outline-none" type="text" placeholder="{{__("Search")}}" required />
                </label>
            </div>
            <button class="btn btn-neutral join-item">  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
        <path d="M8.25 10.875a2.625 2.625 0 1 1 5.25 0 2.625 2.625 0 0 1-5.25 0Z" />
        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.125 4.5a4.125 4.125 0 1 0 2.338 7.524l2.007 2.006a.75.75 0 1 0 1.06-1.06l-2.006-2.007a4.125 4.125 0 0 0-3.399-6.463Z" clip-rule="evenodd" />
        </svg></button>
        </div>
    </form>

</nav>
