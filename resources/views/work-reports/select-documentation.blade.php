<div id="selectDocumentation">
    <div class="flex w-full justify-center">
        <div class="w-[580px] bg-stone-200 border rounded-lg border-stone-400 my-2 p-2">
            <div class="flex w-full bg-stone-400 rounded-xl items-center px-10 pt-2 border-b pb-2">
                <span class="text-center w-full text-md font-semibold">Informasi Detail Penjualan</span>
            </div>
            <div class="w-[560px] text-sm border rounded-lg border-stone-900 mt-2 p-2">
                <div class="flex">
                    <label class="w-32">No. Penjualan</label>
                    <label>:</label>
                    <label class="ml-2">{{ $sale->number }}</label>
                </div>
                <div class="flex">
                    <label class="w-32">Tgl. Penjualan</label>
                    <label>:</label>
                    <label class="ml-2">
                        {{ date('d', strtotime($sale->created_at)) }}
                        {{ $bulan[(int) date('m', strtotime($sale->created_at))] }}
                        {{ date('Y', strtotime($sale->created_at)) }}
                    </label>
                </div>
                <div class="flex">
                    <label class="w-32">Jenis</label>
                    <label>:</label>
                    <label class="ml-2">
                        @if ($sale->media_category->name == 'Service')
                            {{ $getService }} Visual
                        @else
                            {{ $sale->media_category->name }}
                        @endif
                    </label>
                </div>
                <div class="flex">
                    <label class="w-32">Lokasi</label>
                    <label>:</label>
                    <label class="ml-2">
                        {{ $product->address }}
                    </label>
                </div>
            </div>
            <div class="w-[560px] text-sm border rounded-lg border-stone-900 mt-2 p-2">
                <div class="flex">
                    <label class="w-32">No. Penawaran</label>
                    <label>:</label>
                    <label class="ml-2">
                        {{ $quotationDeal->number }}
                    </label>
                </div>
                <div class="flex">
                    <label class="w-32">Tgl. Penawaran</label>
                    <label>:</label>
                    <label class="ml-2">
                        {{ date('d', strtotime($quotationDeal->created_at)) }}
                        {{ $bulan[(int) date('m', strtotime($quotationDeal->created_at))] }}
                        {{ date('Y', strtotime($quotationDeal->created_at)) }}
                    </label>
                </div>
                <div class="flex">
                    <label class="w-32">Nama Klien</label>
                    <label>:</label>
                    <label class="ml-2">
                        {{ $client->name }}
                    </label>
                </div>
                <div class="flex">
                    <label class="w-32">Nama Perusahaan</label>
                    <label>:</label>
                    <label class="ml-2">
                        {{ $client->company }}
                    </label>
                </div>
            </div>
            <div class="flex w-full bg-stone-400 rounded-xl items-center mt-2 px-10 pt-2 border-b pb-2">
                <span class="text-center w-full text-md font-semibold">Pilih Tema/Design</span>
            </div>
            <form action="/work-reports/select-documentation/{{ $sale->id }}">
                <div class="flex w-full justify-center items-center p-2">
                    <table class="table-auto mt-2 w-full">
                        <thead>
                            <tr class="text-sm h-8">
                                <th class="w-8 border border-black">No.</th>
                                <th class="border border-black">Tema</th>
                                <th class="w-24 border border-black">Tgl. Tayang</th>
                                <th class="w-16 border border-black">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($install_orders as $order)
                                <tr class="text-sm">
                                    <td class="border border-black px-1 text-center">{{ $loop->iteration }}</td>
                                    <td class="border border-black px-1">{{ $order->theme }}</td>
                                    <td class="border border-black px-1 text-center">
                                        {{ date('d', strtotime($order->install_at)) }}
                                        {{ $bulan[(int) date('m', strtotime($order->install_at))] }}
                                        {{ date('Y', strtotime($order->install_at)) }}
                                    </td>
                                    <td class="border border-black px-1">
                                        <div class="flex justify-center w-full">
                                            @if (request('rb_install_order'))
                                                @if ($order->id == request('rb_install_order'))
                                                    <input id="{{ $order->id }}" type="radio"
                                                        name="rb_install_order" value="{{ $order->id }}"
                                                        onclick="submit()" checked>
                                                @else
                                                    <input id="{{ $order->id }}" type="radio"
                                                        name="rb_install_order" value="{{ $order->id }}"
                                                        onclick="submit()">
                                                @endif
                                            @else
                                                @if ($loop->iteration == 1)
                                                    <input id="{{ $order->id }}" type="radio"
                                                        name="rb_install_order" value="{{ $order->id }}"
                                                        onclick="submit()" checked>
                                                @else
                                                    <input id="{{ $order->id }}" type="radio"
                                                        name="rb_install_order" value="{{ $order->id }}"
                                                        onclick="submit()">
                                                @endif
                                            @endif
                                            <span class="ml-2">pilih</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        <div class="w-[580px] bg-stone-200 border rounded-lg border-stone-400 ml-2 my-2 p-2">
            <div class="flex w-full bg-stone-400 rounded-xl items-center p-2 border-b">
                <span class="text-center w-full text-md font-semibold">Pilih Foto</span>
            </div>
            <div class="w-[560px] border rounded-lg border-stone-900 mt-2 p-2">
                <div class="flex items-center justify-center w-full">
                    <label class="flex text-sm font-semibold mr-1">Judul Foto :</label>
                    @if ($dayDisable == true)
                        <input type="radio" name="rbFirstTitle" class="outline-none ml-4" id="Foto Siang"
                            onclick="rbFirstTitle(this)" disabled>
                    @else
                        @if ($work_category != 'Service')
                            <input type="radio" name="rbFirstTitle" class="outline-none ml-4" id="Foto Siang"
                                onclick="rbFirstTitle(this)" checked>
                        @else
                            <input type="radio" name="rbFirstTitle" class="outline-none ml-4" id="Foto Siang"
                                onclick="rbFirstTitle(this)">
                        @endif
                    @endif
                    <label class="flex text-sm font-semibold ml-2">Foto Siang</label>
                    @if ($nightDisable == true)
                        <input type="radio" name="rbFirstTitle" class="outline-none ml-4" id="Foto Malam"
                            onclick="rbFirstTitle(this)" disabled>
                    @else
                        <input type="radio" name="rbFirstTitle" class="outline-none ml-4" id="Foto Malam"
                            onclick="rbFirstTitle(this)">
                    @endif
                    <label class="flex text-sm font-semibold ml-2">Foto Malam</label>
                    @if ($work_category == 'Service')
                        <input id="rbManualDay" type="radio" name="rbFirstTitle" class="outline-none ml-4"
                            onclick="rbManualTitle(this)" checked>
                        <input id="inputFirstTitle" type="text"
                            class="ml-2 text-sm outline-none bg-white rounded-md px-2 w-40"
                            placeholder="input judul foto" onchange="inputFirstTitleAction(this)">
                    @else
                        <input id="rbManualDay" type="radio" name="rbFirstTitle" class="outline-none ml-4"
                            onclick="rbManualTitle(this)">
                        <input id="inputFirstTitle" type="text"
                            class="ml-2 text-sm outline-none bg-white rounded-md px-2 w-40"
                            placeholder="input judul foto" onchange="inputFirstTitleAction(this)" disabled>
                    @endif
                </div>
                <div class="relative m-auto w-[540px] h-max mt-2">
                    @if (count($first_photos) > 0)
                        <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                            <button
                                class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                type="button" onclick="buttonFirstPrev()">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                </svg>
                            </button>
                        </div>
                        <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                            <button type="button"
                                class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                onclick="buttonFirstNext()">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                </svg>
                            </button>
                        </div>
                    @else
                        <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                            <button
                                class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                type="button">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                </svg>
                            </button>
                        </div>
                        <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                            <button type="button"
                                class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                </svg>
                            </button>
                        </div>
                    @endif
                    @if (count($first_photos) > 0)
                        @foreach ($first_photos as $photo)
                            @if (count($first_photos) > 2)
                                @if ($loop->iteration - 1 == intdiv(count($first_photos), 2))
                                    <div
                                        class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                                        <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                            class="h-[250px] w-[420px] rounded-lg">
                                        @php
                                            $firstPhoto->id = $photo->id;
                                            if ($photo->type == 'day') {
                                                $firstPhoto->title = 'Foto Siang';
                                            } else {
                                                $firstPhoto->title = 'Foto Malam';
                                            }
                                        @endphp
                                    </div>
                                @else
                                    <div class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1"
                                        hidden>
                                        <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                            class="h-[250px] w-[420px] rounded-lg">
                                    </div>
                                @endif
                            @else
                                @if ($loop->iteration == 1)
                                    <div
                                        class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                                        <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                            class="h-[250px] w-[420px] rounded-lg">
                                        @php
                                            $firstPhoto->id = $photo->id;
                                            if ($photo->type == 'day') {
                                                $firstPhoto->title = 'Foto Siang';
                                            } else {
                                                $firstPhoto->title = 'Foto Malam';
                                            }
                                        @endphp
                                    </div>
                                @else
                                    <div class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1"
                                        hidden>
                                        <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                            class="h-[250px] w-[420px] rounded-lg">
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @else
                        <div class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                            <img src="{{ asset('/img/product-image.png') }}" alt=""
                                class="h-[250px] w-[420px] rounded-lg">
                        </div>
                    @endif
                </div>
            </div>
            <div class="w-[560px] border rounded-lg border-stone-900 mt-2 p-2">
                <div class="flex items-center justify-center w-full">
                    <label class="flex text-sm font-semibold mr-1">Judul Foto :</label>
                    @if ($dayDisable == true)
                        <input id="Foto Siang" name="rbSecond" type="radio" class="outline-none ml-4"
                            onclick="rbSecondTitle(this)" value="Foto Siang" disabled>
                    @else
                        <input id="Foto Siang" name="rbSecond" type="radio" class="outline-none ml-4"
                            onclick="rbSecondTitle(this)" value="Foto Siang">
                    @endif
                    <label class="flex text-sm font-semibold ml-2">Foto Siang</label>
                    @if ($nightDisable == true)
                        <input id="Foto Malam" name="rbSecond" type="radio" class="outline-none ml-4"
                            onclick="rbSecondTitle(this)" value="Foto Malam" disabled>
                    @else
                        @if ($work_category != 'Service')
                            <input id="Foto Malam" name="rbSecond" type="radio" class="outline-none ml-4"
                                onclick="rbSecondTitle(this)" value="Foto Malam" checked>
                        @else
                            <input id="Foto Malam" name="rbSecond" type="radio" class="outline-none ml-4"
                                onclick="rbSecondTitle(this)" value="Foto Malam">
                        @endif
                    @endif
                    <label class="flex text-sm font-semibold ml-2">Foto Malam</label>
                    @if ($work_category == 'Service')
                        <input id="rbManualNight" name="rbSecond" type="radio" class="outline-none ml-4"
                            onclick="rbManualTitle(this)" checked>
                        <input id="inputSecondTitle" type="text"
                            class="ml-2 text-sm outline-none bg-white rounded-md px-2 w-40"
                            placeholder="input judul foto" onchange="inputSecondTitleAction(this)">
                    @else
                        <input id="rbManualNight" name="rbSecond" type="radio" class="outline-none ml-4"
                            onclick="rbManualTitle(this)">
                        <input id="inputSecondTitle" type="text"
                            class="ml-2 text-sm outline-none bg-white rounded-md px-2 w-40"
                            placeholder="input judul foto" onchange="inputSecondTitleAction(this)" disabled>
                    @endif
                </div>
                <div class="relative m-auto w-[540px] h-max mt-2">
                    @if (count($second_photos) > 0)
                        <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                            <button
                                class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                type="button" onclick="buttonSecondPrev()">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                </svg>
                            </button>
                        </div>
                        <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                            <button type="button"
                                class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                onclick="buttonSecondNext()">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                </svg>
                            </button>
                        </div>
                    @else
                        <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                            <button
                                class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                type="button">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                </svg>
                            </button>
                        </div>
                        <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                            <button type="button"
                                class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer">
                                <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                </svg>
                            </button>
                        </div>
                    @endif
                    @if (count($second_photos) > 0)
                        @foreach ($second_photos as $photo)
                            @if (count($second_photos) > 2)
                                @if ($loop->iteration - 1 == intdiv(count($second_photos), 2))
                                    <div
                                        class="divSecondPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                                        <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                            class="h-[250px] w-[420px] rounded-lg">
                                        @php
                                            $secondPhoto->id = $photo->id;
                                            if ($photo->type == 'day') {
                                                $secondPhoto->title = 'Foto Siang';
                                            } else {
                                                $secondPhoto->title = 'Foto Malam';
                                            }
                                        @endphp
                                    </div>
                                @else
                                    <div class="divSecondPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1"
                                        hidden>
                                        <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                            class="h-[250px] w-[420px] rounded-lg">
                                    </div>
                                @endif
                            @else
                                @if ($loop->iteration == 1)
                                    <div
                                        class="divSecondPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                                        <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                            class="h-[250px] w-[420px] rounded-lg">
                                        @php
                                            $secondPhoto->id = $photo->id;
                                            if ($photo->type == 'day') {
                                                $secondPhoto->title = 'Foto Siang';
                                            } else {
                                                $secondPhoto->title = 'Foto Malam';
                                            }
                                        @endphp
                                    </div>
                                @else
                                    <div class="divSecondPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1"
                                        hidden>
                                        <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                            class="h-[250px] w-[420px] rounded-lg">
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @else
                        <div class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                            <img src="{{ asset('/img/product-image.png') }}" alt=""
                                class="h-[250px] w-[420px] rounded-lg">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
        <a href="/accounting/work-reports/create" class="flex justify-center items-center mx-1 btn-primary"
            title="Back">
            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
            </svg>
            <span class="mx-1 text-white">Back</span>
        </a>
        <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
            onclick="documentationNext()">
            <span class="mx-1 text-white">Next</span>
            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
            </svg>
        </button>
    </div>
</div>
