@extends('dashboard.layouts.main');

@section('container')
    <!-- Quotation Signage start -->
    <div class="flex justify-center">
        <div>
            <div class="mt-10">
                <div class="flex justify-center w-[950px] border-b">
                    <h1 class="flex text-xl text-cyan-800 font-bold tracking-wider w-[600px] py-1">Pilih Lokasi Signage</h1>
                    <button class="flex justify-center items-center btn-primary w-44" type="button"
                        onclick="quotationCreate()">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1">Buat Penawaran</span>
                    </button>
                    <a id="btnCreate" hidden>test</a>
                    <a class="flex justify-center items-center ml-1 btn-danger"
                        href="/dashboard/marketing/signage-quotations">
                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="ml-1">Cancel</span>
                    </a>
                </div>
                <form action="/dashboard/marketing/signage-quotations/create/">
                    <div class="flex mt-1 ml-2">
                        <div class="w-full md:w-36">
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
                        <div class="w-full md:w-36 ml-2">
                            <span class="text-base text-teal-900">Kota</span>
                            @if (request('area'))
                                <select id="city" class="w-full border rounded-lg text-base text-teal-900 outline-none"
                                    name="city" onchange="submit()">
                                    <option value="All">All</option>
                                    @foreach ($cities as $city)
                                        @if (request('area') == $city->area_id)
                                            @if (request('city') == $city->id)
                                                <option value="{{ $city->id }}" selected>{{ $city->city }}</option>
                                            @else
                                                <option value="{{ $city->id }}">{{ $city->city }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                <select id="city" class="w-full border rounded-lg text-base text-teal-900 outline-none"
                                    name="city" onchange="submit()" disabled>
                                    <option value="All">All</option>
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="md:flex mt-2">
                        <div class="flex">
                            <input id="search" name="search"
                                class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-teal-900"
                                type="text" placeholder="Search" value="{{ request('search') }}">
                            <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                type="submit">
                                <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="w-[950px] mt-4">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-teal-100 h-10">
                            <th class="text-teal-700 border text-sm w-8 text-center">No</th>
                            <th class="text-teal-700 border text-sm w-24 text-center">Kode</th>
                            <th class="text-teal-700 border text-sm text-center">Lokasi</th>
                            <th class="text-teal-700 border text-sm text-center w-20">Area</th>
                            <th class="text-teal-700 border text-sm text-center w-28">Kota</th>
                            <th class="text-teal-700 border text-sm text-center w-28">Size - V/H</th>
                            <th class="text-teal-700 border text-sm text-center w-16">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="/dashboard/marketing/signage-quotations/create-quotations/">
                            @foreach ($signages as $signage)
                                <tr>
                                    <td class="text-teal-700 border text-sm text-center">{{ $loop->iteration }}</td>
                                    <td class="text-teal-700 border text-sm text-center">{{ $signage->code }} -
                                        {{ $signage->city->code }}</td>
                                    <td class="text-teal-700 border text-sm px-2">{{ $signage->address }}</td>
                                    <td class="text-teal-700 border text-sm text-center">{{ $signage->area->area }}</td>
                                    <td class="text-teal-700 border text-sm text-center">{{ $signage->city->city }}</td>
                                    <td class="text-teal-700 border text-sm text-center">{{ $signage->size->size }}
                                        -
                                        @if ($signage->orientation == 'Vertikal')
                                            V
                                        @elseif ($signage->orientation == 'Horizontal')
                                            H
                                        @endif
                                    </td>
                                    <td class="text-teal-700 border text-center text-sm">
                                        <input value="{{ $signage->id }}" type="checkbox" title="pilih"
                                            onclick="getLocation(this)">
                                    </td>
                                </tr>
                            @endforeach
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let locationId = [];
        const inputs = document.getElementsByTagName('input');
        const btnCreate = document.getElementById("btnCreate");
        const area = document.getElementById("area");
        const city = document.getElementById("city");

        getLocation = (sel) => {
            if (sel.checked == true) {
                locationId.push(sel.value);
            } else {
                for (let i = 0; i < locationId.length; i++) {
                    if (locationId[i] == sel.value) {
                        locationId.splice(i, 1);
                    }
                }
            }

            if (locationId.length == 2) {
                for (let i = 0; i < inputs.length; i++) {
                    if (inputs[i].checked == false) {
                        inputs[i].setAttribute('disabled', 'disabled');
                    }
                }
            } else {
                for (let i = 0; i < inputs.length; i++) {
                    if (inputs[i].checked == false) {
                        inputs[i].removeAttribute('disabled');
                    }
                }
            }
        }

        quotationCreate = () => {
            if (locationId.length == 0) {
                alert("Silahkan pilih lokasi terlebih dahulu...!!")
            } else {
                btnCreate.setAttribute('href', '/dashboard/marketing/signage-quotations/create-quotations/' +
                    locationId + '/' + area.value + '/' + city.value);
                btnCreate.click();
            }
        }
    </script>
@endsection
