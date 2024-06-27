<div id="changeContact" name="changeContact"
    class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
    <div class="mt-10">
        <div class="w-[600px] h-max px-4 py-2 bg-white">
            <div class="flex w-[576px] justify-end mr-2">
                <button id="btnClose" class="flex" title="Close" type="button">
                    <svg class="fill-gray-500 w-6 m-auto hover:fill-red-700" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                </button>
            </div>
            <div class="flex w-full justify-center">
                <label class="text-xs text-teal-700 border-b my-2 font-semibold"> DAFTAR
                    KONTAK</label>
            </div>
            <table class="table-auto mt-2 w-full">
                <thead>
                    <tr>
                        <th class="text-xs text-teal-700 border w-6">No</th>
                        <th class="text-xs text-teal-700 border w-40">Nama</th>
                        <th class="text-xs text-teal-700 border">Email</th>
                        <th class="text-xs text-teal-700 border w-32">Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    ?>
                    @foreach ($contacts as $contact)
                        @if ($contact->client_id == $billboard_sale->client_id)
                            <?php
                            $i++;
                            ?>
                            <tr>
                                <td class="text-xs text-teal-700 border text-center p-1">
                                    {{ $i }}</td>
                                <td class="text-xs text-teal-700 border p-1">
                                    <div class="flex items-center">
                                        <input type="radio" name="contact"
                                            value="{{ $contact->id }}-{{ $contact->name }}-{{ $contact->email }}-{{ $contact->phone }}"
                                            onclick="radioFunction(this)">
                                        <label class="ml-2">{{ $contact->name }}</label>
                                    </div>
                                </td>
                                <td class="text-xs text-teal-700 border text-center p-1">
                                    {{ $contact->email }}</td>
                                <td class="text-xs text-teal-700 border text-center p-1">
                                    {{ $contact->phone }}</td>
                            </tr>
                        @endif
                    @endforeach
                    <input id="contactQty" type="text" value="{{ $i }}" hidden>
                </tbody>
            </table>
        </div>
    </div>
</div>
