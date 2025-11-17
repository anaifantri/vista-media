@canany(['isAdmin', 'isMedia', 'isMarketing', 'isOwner', 'isWorkshop', 'isAccounting'])
    <div name="nav-menu" id="nav-menu" class="flex fixed h-screen pb-24 pt-2 px-2 top-14">
        <div class="bg-stone-900 rounded-2xl overflow-y-auto border">
            <div class="flex fixed p-2 rounded-2xl items-center bg-stone-900 z-10">
                <button class="" id="hamburger" name="hamburger" type="button">
                    <span class="origin-top-left hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="origin-bottom-left hamburger-line transition duration-300 ease-in-out"></span>
                </button>
                <span id="menu" name="menu" class="w-40 mx-2 justify-center text-white hidden border-b"> MAIN MENU
                </span>
            </div>
            <nav class="mt-10 relative z-0">
                <ul class="block">
                    <div id="sidebarMenu">
                        <!-- Sidebar Dashboard start-->
                        @include('dashboard.layouts.sidebar-dashboard')
                        <!-- Sidebar Dashboard End-->

                        <!-- Sidebar Media OOH start-->
                        @canany(['isAdmin', 'isOwner', 'isMedia', 'isMarketing', 'isAccounting', 'isWorkshop'])
                            @include('dashboard.layouts.sidebar-media')
                        @endcanany
                        <!-- Sidebar Media OOH End-->

                        <!-- Sidebar Marketing start-->
                        @canany(['isAdmin', 'isOwner', 'isMedia', 'isMarketing', 'isAccounting', 'isWorkshop'])
                            @include('dashboard.layouts.sidebar-marketing')
                        @endcanany
                        <!-- Sidebar Marketing End-->

                        <!-- Sidebar Accounting start-->
                        @canany(['isAdmin', 'isOwner', 'isMedia', 'isMarketing', 'isAccounting', 'isWorkshop'])
                            @include('dashboard.layouts.sidebar-accounting')
                        @endcanany
                        <!-- Sidebar Accounting End-->

                        <!-- Sidebar Workshop start-->
                        @canany(['isAdmin', 'isOwner', 'isMedia', 'isWorkshop', 'isMarketing', 'isAccounting'])
                            @include('dashboard.layouts.sidebar-workshop')
                        @endcanany
                        <!-- Sidebar Workshop End-->

                        <!-- Sidebar User start-->
                        @canany(['isAdmin', 'isOwner'])
                            @include('dashboard.layouts.sidebar-user')
                        @endcanany
                        <!-- Sidebar User End-->

                        <!-- Sidebar Logout start-->
                        @include('dashboard.layouts.sidebar-logout')
                        <!-- Sidebar Logout End-->
                </ul>
            </nav>
        </div>
    </div>
@endcanany
