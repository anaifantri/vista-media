@extends('dashboard.layouts.main');

@section('container')
    @canany(['isAdmin', 'isMarketing', 'isAccounting', 'isOwner', 'isMedia'])
        <div class="xl:flex xl:justify-center">
            <div class="mt-10 z-0">
                <div class="flex p-1">
                    <h1 class="index-h1">Daftar Lokasi Billboard</h1>
                    @canany(['isAdmin', 'isMarketing'])
                        <div class="border-b">
                            <a href="/dashboard/media/billboards/create" class="index-link btn-primary">
                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                    stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1 hidden sm:flex">Tambah Billboard</span>
                            </a>
                        </div>
                    @endcanany
                </div>
                <form action="/dashboard/media/billboards/">
                    <div class="">
                        <div class="flex mt-1 ml-2">
                            <div class="w-28">
                                <span class="text-base text-teal-900">Area</span>
                                <input type="text" id="requestArea" name="requestArea" value="{{ request('area') }}" hidden>
                                <select class="w-full border rounded-lg text-base text-teal-900 outline-none" name="area"
                                    id="area" onchange="submit()" value="{{ request('area') }}">
                                    <option value="All">All</option>
                                    @foreach ($areas as $area)
                                        @if (request('area') == $area->id)
                                            <option value="{{ $area->id }}" selected>{{ $area->area }}</option>
                                        @else
                                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-28 ml-2">
                                <span class="text-base text-teal-900">Kota</span>
                                <input type="text" id="city" name="city" value="{{ request('requestCity') }}" hidden>
                                <select class="w-full border rounded-lg text-base text-teal-900 outline-none" name="requestCity"
                                    id="requestCity" onchange="submit()">
                                    <option value="All">All</option>
                                </select>
                            </div>
                            <div class="w-28 ml-2">
                                <span class="text-base text-teal-900">Kondisi</span>
                                <select class="w-full border rounded-lg text-base text-teal-900 outline-none" name="build"
                                    id="build" onchange="submit()">
                                    <?php $dataBuild = ['All', 'Terbangun', 'Pembangunan', 'Rencana']; ?>
                                    @for ($i = 0; $i < count($dataBuild); $i++)
                                        @if (request('build') == $dataBuild[$i])
                                            <option value="{{ $dataBuild[$i] }}" selected> <?php echo $dataBuild[$i]; ?> </option>
                                        @else
                                            <option value="{{ $dataBuild[$i] }}"> <?php echo $dataBuild[$i]; ?> </option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="w-28 ml-2">
                                <span class="text-base text-teal-900">Status</span>
                                <select class="w-full border rounded-lg text-base text-teal-900 outline-none" name="sale"
                                    id="sale" onchange="submit()">
                                    <?php $dataSale = ['All', 'Available', 'Sold']; ?>
                                    @for ($i = 0; $i < count($dataSale); $i++)
                                        @if (request('sale') == $dataSale[$i])
                                            <option value="{{ $dataSale[$i] }}" selected> <?php echo $dataSale[$i]; ?> </option>
                                        @else
                                            <option value="{{ $dataSale[$i] }}"> <?php echo $dataSale[$i]; ?> </option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <div class="flex">
                                <input id="search" name="search"
                                    class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-teal-900"
                                    type="text" placeholder="Search Kode/Lokasi/Klien" value="{{ request('search') }}">
                                <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                    type="submit">
                                    <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                    </svg>
                                </button>
                            </div>
                            @if (session()->has('success'))
                                <div class="ml-2 flex alert-success">
                                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                                    </svg>
                                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
                <div class="ml-2 w-full overflow-x-scroll xl:overflow-x-visible">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="index-tr items-center h-10 bg-slate-50 border-t">
                                <th class="index-td text-sm w-4 2xl:w-8">No</th>
                                <th class="index-td text-sm w-[88px] 2xl:w-32">@sortablelink('code', 'Kode')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </th>
                                <th class="index-td text-sm w-56 2xl:w-80">Lokasi</th>
                                <th class="index-td text-sm w-14 2xl:w-16">Kota</th>
                                <th class="index-td text-sm w-10 2xl:w-12">Jenis</th>
                                <th class="index-td text-sm w-10 2xl:w-12">BL/FL</th>
                                <th class="index-td text-sm w-[88px] 2xl:w-24">Size - V/H</th>
                                <th class="index-td text-sm w-[72px] 2xl:w-20">Kondisi</th>
                                <th class="index-td text-sm  w-[72px] 2xl:w-16">Status</th>
                                <th class="index-td text-sm w-[104px] 2xl:w-28">Klien</th>
                                <th class="index-td text-sm w-28 2xl:w-32">@sortablelink('price', 'Harga')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </th>
                                <th class="index-td text-sm w-28 2xl:36">@sortablelink('start_contract', 'Awal Kontrak')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </th>
                                <th class="index-td text-sm w-28 2xl:36">@sortablelink('end_contract', 'Akhir Kontrak')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </th>
                                <th class="index-td text-sm w-[110px] 2xl:w-36">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $number = 1 + ($products->currentPage() - 1) * $products->perPage();
                            @endphp
                            @foreach ($products as $product)
                                @if ($product->category == 'Billboard')
                                    <tr class="index-tr items-start h-max">
                                        <td class="index-td text-sm w-4 2xl:w-8 text-center">{{ $number++ }}</td>
                                        <td class="index-td text-sm w-[88px] 2xl:w-32">{{ $product->code }} -
                                            {{ $product->city->code }}
                                        </td>
                                        <td class="flex justify-start items-center text-sm w-56 2xl:w-80">
                                            {{ $product->address }}
                                        </td>
                                        <td class="index-td text-sm w-14 2xl:w-16">{{ $product->city->code }}</td>
                                        <td class="index-td text-sm w-10 2xl:w-12">
                                            @if ($product->category == 'Billboard')
                                                BB
                                            @endif
                                        </td>
                                        <td class="index-td text-sm w-10 2xl:w-12">
                                            @if ($product->lighting == 'Frontlight')
                                                FL
                                            @elseif ($product->lighting == 'Backlight')
                                                BL
                                            @endif
                                        </td>
                                        @if ($product->size != '')
                                            <td class="index-td text-sm w-[88px] 2xl:w-24">{{ $product->size->size }} -
                                                @if ($product->size->orientation == 'Vertikal')
                                                    V
                                                @elseif ($product->size->orientation == 'Horizontal')
                                                    H
                                                @endif
                                            </td>
                                        @else
                                            <td class="index-td text-sm w-[88px] 2xl:w-24"></td>
                                        @endif
                                        <td class="index-td text-sm w-[72px] 2xl:w-20">{{ $product->build_status }}</td>
                                        <td class="flex items-start justify-center text-sm w-16">{{ $product->sale_status }}
                                        </td>
                                        @if ($product->client)
                                            <td class="index-td text-sm w-[104px] 2xl:w-28">{{ $product->client }}</td>
                                        @else
                                            <td class="index-td text-sm w-[104px] 2xl:w-28">-</td>
                                        @endif

                                        @if ($product->price)
                                            <td class="flex items-center justify-center text-sm w-28 2xl:w-32">
                                                {{ number_format($product->price) }}</td>
                                        @else
                                            <td class="index-td text-sm w-28 2xl:w-32">-</td>
                                        @endif
                                        @if ($product->start_contract)
                                            <td class="index-td text-sm w-28 2xl:36">
                                                {{ date('d-M-Y', strtotime($product->start_contract)) }}
                                            </td>
                                        @else
                                            <td class="index-td text-sm w-28 2xl:36">-</td>
                                        @endif
                                        @if ($product->end_contract)
                                            <td class="index-td text-sm w-28 2xl:36">
                                                {{ date('d-M-Y', strtotime($product->end_contract)) }}
                                            </td>
                                        @else
                                            <td class="index-td text-sm w-28 2xl:36">-</td>
                                        @endif
                                        <td class="index-td text-sm w-[110px] 2xl:w-36">
                                            <a href="/dashboard/media/products/{{ $product->id }}"
                                                class="index-link text-white w-7 2xl:w-8 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mx-1">
                                                <svg class="fill-current w-[18px] 2xl:w-5" clip-rule="evenodd"
                                                    fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                            </a>
                                            @canany(['isAdmin', 'isMarketing'])
                                                <a href="/dashboard/media/products/{{ $product->id }}/edit"
                                                    class="index-link text-white w-7 2xl:w-8 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md mx-1">
                                                    <svg class="fill-current w-[18px] 2xl:w-5" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                </a>
                                                <form action="/dashboard/media/products/{{ $product->id }}" method="post"
                                                    class="flex m-1">
                                                    @method('delete')
                                                    @csrf
                                                    <button
                                                        class="index-link text-white w-7 2xl:w-8 h-5 rounded bg-red-600 hover:bg-red-700 drop-shadow-md"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus billboard dengan kode {{ $product->code }} ?')">
                                                        <svg class="fill-current w-[18px] 2xl:w-5" clip-rule="evenodd"
                                                            fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                fill-rule="nonzero" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endcanany
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center text-teal-900">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    @endcanany
    <script>
        // Show City --> strat
        const area = document.getElementById("area");
        const city = document.getElementById("city");
        const requestCity = document.getElementById("requestCity");
        const optionCity = [];

        area.addEventListener('change', function() {
            city.value = 'All';
            requestCity.value = 'All';

            while (requestCity.hasChildNodes()) {
                requestCity.removeChild(requestCity.firstChild);
            }

            optionCity[0] = document.createElement('option');
            optionCity[0].appendChild(document.createTextNode(['All']));
            optionCity[0].setAttribute('value', 'All');
            requestCity.appendChild(optionCity[0]);

            const xhrCity = new XMLHttpRequest();
            const methodCity = "GET";
            const urlCity = "/showCity";

            xhrCity.open(methodCity, urlCity, true);
            xhrCity.send();

            xhrCity.onreadystatechange = () => {
                // In local files, status is 0 upon success in Mozilla Firefox
                if (xhrCity.readyState === XMLHttpRequest.DONE) {
                    const status = xhrCity.status;
                    if (status === 0 || (status >= 200 && status < 400)) {
                        // The request has been completed successfully
                        objCity = JSON.parse(xhrCity.responseText);
                        for (i = 0; i < objCity.dataCity.length; i++) {
                            if (objCity.dataCity[i]['area_id'] == area.value) {
                                optionCity[i + 1] = document.createElement('option');
                                optionCity[i + 1].appendChild(document.createTextNode(objCity.dataCity[i][
                                    'city'
                                ]));
                                optionCity[i + 1].setAttribute('value', objCity.dataCity[i]['id']);
                                requestCity.appendChild(optionCity[i + 1]);
                            }
                        }
                    } else {
                        // Oh no! There has been an error with the request!
                    }
                }
            }
        })

        if (requestCity.value != 'All' || area.value != 'All') {
            const xhrCity = new XMLHttpRequest();
            const methodCity = "GET";
            const urlCity = "/showCity";

            xhrCity.open(methodCity, urlCity, true);
            xhrCity.send();

            xhrCity.onreadystatechange = () => {
                // In local files, status is 0 upon success in Mozilla Firefox
                if (xhrCity.readyState === XMLHttpRequest.DONE) {
                    const status = xhrCity.status;
                    if (status === 0 || (status >= 200 && status < 400)) {
                        // The request has been completed successfully
                        objCity = JSON.parse(xhrCity.responseText);

                        for (i = 0; i < objCity.dataCity.length; i++) {
                            if (objCity.dataCity[i]['area_id'] == area.value) {
                                optionCity[i + 1] = document.createElement('option');
                                optionCity[i + 1].appendChild(document.createTextNode(objCity.dataCity[i][
                                    'city'
                                ]));
                                optionCity[i + 1].setAttribute('value', objCity.dataCity[i]['id']);

                                if (objCity.dataCity[i]['id'] == city.value) {
                                    optionCity[i + 1].setAttribute('selected', 'selected');
                                    city.value = requestCity.value;
                                }
                                requestCity.appendChild(optionCity[i + 1]);
                            }
                        }
                    } else {
                        // Oh no! There has been an error with the request!
                    }
                }
            }
        } else {
            const xhrCity = new XMLHttpRequest();
            const methodCity = "GET";
            const urlCity = "/showCity";

            xhrCity.open(methodCity, urlCity, true);
            xhrCity.send();

            xhrCity.onreadystatechange = () => {
                // In local files, status is 0 upon success in Mozilla Firefox
                if (xhrCity.readyState === XMLHttpRequest.DONE) {
                    const status = xhrCity.status;
                    if (status === 0 || (status >= 200 && status < 400)) {
                        // The request has been completed successfully
                        objCity = JSON.parse(xhrCity.responseText);

                        for (i = 0; i < objCity.dataCity.length; i++) {
                            if (objCity.dataCity[i]['area_id'] == area.value) {
                                optionCity[i + 1] = document.createElement('option');
                                optionCity[i + 1].appendChild(document.createTextNode(objCity.dataCity[i][
                                    'city'
                                ]));
                                optionCity[i + 1].setAttribute('value', objCity.dataCity[i]['id']);
                                requestCity.appendChild(optionCity[i + 1]);
                            }
                        }
                    } else {
                        // Oh no! There has been an error with the request!
                    }
                }
            }
        }

        // city.addEventListener('click', function() {
        //     city.value = requestCity.value;
        // })
        // Show City --> end
    </script>
@endsection
