<form class="flex justify-center" action="/marketing/print-orders" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="company_id" id="company_id" value="{{ $company_id }}" hidden>
    <input type="text" name="vendor_id" id="vendor_id" hidden>
    @if ($orderType == 'sale')
        <input type="text" name="sale_id" id="sale_id" value="{{ $dataOrder->id }}" hidden>
    @else
        <input type="text" name="sale_id" id="sale_id" hidden>
    @endif
    <input type="text" name="theme" id="theme" hidden>
    <input type="text" id="location_id" name="location_id" value="{{ $location_id }}" hidden>
    <input type="file" id="design" name="design" hidden>
    <input type="text" id="location_code" value="{{ $code }}" hidden>
    <input type="text" id="cityCode" value="{{ $cityCode }}" hidden>
    <input type="text" id="orderType" value="{{ $orderType }}" hidden>
    <input type="number" id="price" name="price" hidden>
    <input type="text" name="product" id="product" hidden>
    <input type="text" name="notes" id="notes" hidden>
    <input type="text" name="created_by" id="created_by" value="{{ json_encode($created_by) }}" hidden>
    <input type="text" name="updated_by" id="updated_by" value="{{ json_encode($created_by) }}" hidden>
    <div id="modalPreview" class="absolute justify-center top-0 w-full h-[full] bg-black bg-opacity-90 z-20 hidden">
        <div class="mt-10">
            <div class="flex items-center justify-center w-[950px] border-b px-2">
                <div class="flex w-full items-center p-1">
                    <button class="flex justify-center items-center mx-1 btn-success" title="Preview" type="submit">
                        <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                        </svg>
                        <span class="ml-2 text-white">save</span>
                    </button>
                    <button id="btnClose" class="flex justify-center items-center ml-1  btn-danger" type="button"
                        title="Close">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                        </svg>
                        <span class="ml-1 xl:mx-2 text-sm">Close</span>
                    </button>
                </div>
            </div>
            <div class="flex justify-center w-full">
                <div class="w-[950px] h-[1345px] bg-white mb-10 p-2 mt-2">
                    <!-- SPK Header start-->
                    @include('print-orders.spk-header-preview')
                    <!-- SPK Header end-->

                    <!-- SPK Body start-->
                    @include('print-orders.spk-body-preview')
                    <!-- SPK Body end-->

                    <!-- SPK Sign start-->
                    @include('print-orders.spk-sign-preview')
                    <!-- SPK Sign end-->

                    <div class="flex w-full justify-center items-center pt-2">
                        <div class="border-t h-2 border-slate-500 border-dashed w-full">
                        </div>
                        <svg class="fill-slate-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M14.686 13.646l-6.597 3.181c-1.438.692-2.755-1.124-2.755-1.124l6.813-3.287 2.539 1.23zm6.168 5.354c-.533 0-1.083-.119-1.605-.373-1.511-.731-2.296-2.333-1.943-3.774.203-.822-.23-.934-.891-1.253l-11.036-5.341s1.322-1.812 2.759-1.117c.881.427 4.423 2.136 7.477 3.617l.766-.368c.662-.319 1.094-.43.895-1.252-.351-1.442.439-3.043 1.952-3.77.521-.251 1.068-.369 1.596-.369 1.799 0 3.147 1.32 3.147 2.956 0 1.23-.766 2.454-2.032 3.091-1.266.634-2.15.14-3.406.75l-.394.19.431.21c1.254.614 2.142.122 3.404.759 1.262.638 2.026 1.861 2.026 3.088 0 1.64-1.352 2.956-3.146 2.956zm-1.987-9.967c.381.795 1.459 1.072 2.406.617.945-.455 1.405-1.472 1.027-2.267-.381-.796-1.46-1.073-2.406-.618-.946.455-1.408 1.472-1.027 2.268zm-2.834 2.819c0-.322-.261-.583-.583-.583-.321 0-.583.261-.583.583s.262.583.583.583c.322.001.583-.261.583-.583zm5.272 2.499c-.945-.457-2.025-.183-2.408.611-.381.795.078 1.814 1.022 2.271.945.458 2.024.184 2.406-.611.382-.795-.075-1.814-1.02-2.271zm-18.305-3.351h-3v2h3v-2zm4 0h-3v2h3v-2z" />
                        </svg>
                    </div>

                    <!-- SPK Header start-->
                    @include('print-orders.spk-header-preview')
                    <!-- SPK Header end-->

                    <!-- SPK Body start-->
                    @include('print-orders.body-copy-preview')
                    <!-- SPK Body end-->

                    <!-- SPK Sign start-->
                    @include('print-orders.sign-copy-preview')
                    <!-- SPK Sign end-->
                </div>
            </div>
        </div>
    </div>
</form>
