@canany(['isAdmin', 'isMedia', 'isMarketing', 'isOwner', 'isWorkshop', 'isAccounting'])
    <div name="nav-menu" id="nav-menu" class="flex fixed h-screen pb-24 pt-2 px-2 top-14">
        <div class="bg-teal-50 rounded-2xl overflow-y-auto border">
            <div class="flex fixed p-2 rounded-2xl items-center bg-teal-50 z-10">
                <button class="" id="hamburger" name="hamburger" type="button">
                    <span class="origin-top-left hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="origin-bottom-left hamburger-line transition duration-300 ease-in-out"></span>
                </button>
                <span id="menu" name="menu" class="w-40 mx-2 justify-center hidden border-b"> MAIN MENU </span>
            </div>
            <nav class="mt-10 relative z-0">
                <ul class="block">
                    <div>
                        <!-- Sidebar Dashboard start-->
                        @include('dashboard.layouts.sidebar-dashboard')
                        <!-- Sidebar Dashboard End-->

                        <!-- Sidebar Media OOH start-->
                        @include('dashboard.layouts.sidebar-media')
                        <!-- Sidebar Media OOH End-->

                        <!-- Sidebar Marketing start-->
                        @include('dashboard.layouts.sidebar-marketing')
                        <!-- Sidebar Marketing End-->

                        <!-- Sidebar Accounting start-->
                        @include('dashboard.layouts.sidebar-accounting')
                        <!-- Sidebar Accounting End-->

                        <!-- Sidebar Workshop start-->
                        @include('dashboard.layouts.sidebar-workshop')
                        <!-- Sidebar Workshop End-->

                        <!-- Sidebar User start-->
                        @include('dashboard.layouts.sidebar-user')
                        <!-- Sidebar User End-->

                        <!-- Sidebar Logout start-->
                        @include('dashboard.layouts.sidebar-logout')
                        <!-- Sidebar Logout End-->
                </ul>
            </nav>
        </div>
    </div>
@endcanany
