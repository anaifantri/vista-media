<div class="w-[1250px] mt-2">
    <table class="table-auto w-full">
        <thead>
            <tr class="bg-stone-400">
                <th class="text-stone-900 border border-stone-900 text-xs w-8 text-center">No</th>
                <th class="text-stone-900 border border-stone-900 w-24 text-xs text-center">
                    <button class="flex justify-center items-center w-24">@sortablelink('id_number', 'ID Pelanggan')
                        <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                        </svg>
                    </button>
                </th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Type</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-48">Nama</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-16">Daya</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Area</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-20">Kota</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center">Lokasi</th>
                <th class="text-stone-900 border border-stone-900 text-xs text-center w-24">Action</th>
            </tr>
        </thead>
        <tbody class="bg-stone-200">
            @php
                $number = 1 + ($electrical_powers->currentPage() - 1) * $electrical_powers->perPage();
            @endphp
            @foreach ($electrical_powers as $electrical)
                <tr>
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">{{ $number++ }}</td>
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">{{ $electrical->id_number }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">{{ $electrical->type }}</td>
                    <td class="text-stone-900 border border-stone-900 text-xs px-1 text-center">{{ $electrical->name }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-xs px-1 text-center">{{ $electrical->power }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">{{ $electrical->area->area }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">{{ $electrical->city->city }}
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-xs px-1">
                        <div>
                            @if (count($electrical->locations) > 0)
                                @foreach ($electrical->locations as $location)
                                    <span class="flex">
                                        {{ $location->code }} | {{ $location->address }}
                                    </span>
                                @endforeach
                            @else
                                -
                            @endif
                        </div>
                    </td>
                    <td class="text-stone-900 border border-stone-900 text-xs text-center">
                        <div class="flex justify-center items-center">
                            <a href="/workshop/electrical-powers/{{ $electrical->id }}"
                                class="index-link text-white w-7 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mx-1">
                                <svg class="fill-current w-[18px]" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                        fill-rule="nonzero" />
                                </svg>
                            </a>
                            @canany(['isAdmin', 'isWorkshop', 'isMedia'])
                                @can('isElectricity')
                                    @can('isWorkshopEdit')
                                        <a href="/workshop/electrical-powers/{{ $electrical->id }}/edit"
                                            class="index-link text-white w-7 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md mx-1">
                                            <svg class="fill-current w-[18px]" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                        </a>
                                    @endcan
                                @endcan
                            @endcanany
                            @canany(['isAdmin'])
                                @can('isElectricity')
                                    @can('isWorkshopDelete')
                                        <form action="/workshop/electrical-powers/{{ $electrical->id }}" method="post"
                                            class="d-inline m-1">
                                            @method('delete')
                                            @csrf
                                            <button class="index-link text-white w-7 h-5 bg-red-500 rounded-md hover:bg-red-600"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus daya listrik dengan id {{ $electrical->electrical_powers[0]->id_number }} ?')">
                                                <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24">
                                                    <title>DELETE</title>
                                                    <path
                                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                @endcan
                            @endcanany
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination start -->
<div class="flex justify-center text-stone-100 mt-2">
    {!! $electrical_powers->appends(Request::query())->render('dashboard.layouts.pagination') !!}
</div>
<!-- Pagination end -->
