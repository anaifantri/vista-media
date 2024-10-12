<!-- Create Sales preview start -->
<form action="/marketing/sales" method="post" enctype="multipart/form-data">
    @csrf
    <div id="modalPreview" class="absolute justify-center top-0 w-full h-[full] bg-black bg-opacity-90 z-20 p-10 hidden">
        <div class="flex w-full justify-center">
            <div class="flex w-[950px] justify-end">
                <button class="flex justify-center items-center mx-1 btn-primary" title="Save">
                    <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path
                            d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                    </svg>
                    <span class="ml-2 text-white">Save</span>
                </button>
                <button id="btnClose" class="flex justify-center items-center ml-1  btn-danger" type="button"
                    title="Close" onclick="btnCloseAction()">
                    <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-sm">Close</span>
                </button>
            </div>
        </div>
        <div class="flex justify-center w-full">
            <div id="salesPreview">
                <input id="approvalImages" class="hidden" name="document_approval[]" type="file"
                    accept="image/png, image/jpg, image/jpeg"
                    onchange="imagePreview(this, document.querySelectorAll('[id=labelApproval]'))" multiple>
                <input id="poImages" class="hidden" name="document_po[]" type="file"
                    accept="image/png, image/jpg, image/jpeg"
                    onchange="imagePreview(this, document.querySelectorAll('[id=labelPo]'))" multiple>
                <input id="agreementImages" class="hidden" name="document_agreement[]" type="file"
                    accept="image/png, image/jpg, image/jpeg"
                    onchange="imagePreview(this, document.querySelectorAll('[id=labelAgreement]'))" multiple>
                <input type="text" id="salesData" name="salesData" value="{{ json_encode($salesData) }}" hidden>
                <input id="category" type="text" name="category" value="{{ $category }}" hidden>
                <input type="date" id="agreement_date" name="agreement_date" hidden>
                <input type="text" id="agreement_number" name="agreement_number" hidden>
                <input type="date" id="order_date" name="order_date" hidden>
                <input type="text" id="order_number" name="order_number" hidden>
                @foreach ($products as $product)
                    <div class="w-[950px] h-[1345px] bg-white mt-1">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1125px]">
                            <div class="flex justify-center">
                                <div class="w-[750px]">
                                    <div class="flex justify-center mt-5">
                                        <label class="sale-label-title">DATA PENJUALAN
                                            {{ strtoupper($category) }}</label>
                                    </div>
                                    <div class="flex justify-center mt-5">
                                        <div class="sale-detail">
                                            <div class="div-sale">
                                                <label class="label-sale-01">Nomor Penjualan</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="text-sm text-slate-300 ml-2">Penomoran otomatis</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Tgl. Penjualan</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02 font-semibold">
                                                    {{ date('d') }}
                                                    {{ $bulan[(int) date('m')] }}
                                                    {{ date('Y') }}
                                                </label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Dok. Approval</label>
                                                <label class="label-sale-02">:</label>
                                                <label id="previewApproval"
                                                    class="label-sale-02 font-semibold">{{ count($data_approvals) }}
                                                    dokumen</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Dok. PO/SPK</label>
                                                <label class="label-sale-02">:</label>
                                                <label id="previewPo" class="label-sale-02 font-semibold"></label>
                                            </div>
                                            @if ($category != 'Service')
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Dok. Agreement</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label id="previewAgreement"
                                                        class="label-sale-02 font-semibold"></label>
                                                </div>
                                                <div class="div-sale justify-center">
                                                    <label class="title-periode font-semibold">Periode Kontrak</label>
                                                </div>
                                                <div class="div-sale justify-center w-[350px] border rounded-lg p-1">
                                                    <div>
                                                        <div class="flex justify-center w-[160px]">
                                                            <label class="text-sm text-teal-700 flex">Awal Kontrak
                                                                :</label>
                                                        </div>
                                                        <div class="flex justify-center w-[160px]">
                                                            <label id="previewStartAt"
                                                                class="text-sm text-teal-700 flex font-semibold">-</label>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="flex justify-center w-[160px]">
                                                            <label class="text-sm text-teal-700 flex">Akhir Kontrak
                                                                :</label>
                                                        </div>
                                                        <div class="flex justify-center w-[160px]">
                                                            <label id="previewEndAt"
                                                                class="text-sm text-teal-700 flex font-semibold">-</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="sale-detail ml-2">
                                            <div class="div-sale">
                                                <label class="label-sale-01">No. Penawaran</label>
                                                <label class="label-sale-02">:</label>
                                                <label class="label-sale-02 font-semibold">{{ $number }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Tgl. Penawaran</label>
                                                <label class="label-sale-02">:</label>
                                                <label
                                                    class="label-sale-02 font-semibold">{{ date('d', strtotime($created_at)) }}
                                                    {{ $bulan[(int) date('m', strtotime($created_at))] }}
                                                    {{ date('Y', strtotime($created_at)) }}</label>
                                            </div>
                                            <div class="div-sale">
                                                <label class="label-sale-01">Nama Klien</label>
                                                <label class="label-sale-02">:</label>
                                                <label
                                                    class="label-sale-02 font-semibold">{{ $clients->name }}</label>
                                            </div>
                                            @if ($clients->type == 'Perusahaan')
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Perusahaan</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label
                                                        class="label-sale-02 font-semibold">{{ $clients->company }}</label>
                                                </div>
                                            @endif
                                            <div class="div-sale">
                                                <label class="label-sale-01">Alamat</label>
                                                <label class="label-sale-02">:</label>
                                                <textarea class="ml-1 w-[230px] outline-none border text-teal-700 text-sm p-1 font-semibold" rows="2" readonly>{{ $clients->address }}</textarea>
                                            </div>
                                            @if ($clients->type == 'Perusahaan')
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Kontak Person</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label
                                                        class="label-sale-02 font-semibold">{{ $clients->contact_name }}</label>
                                                </div>
                                            @endif
                                            @if ($clients->type == 'Perusahaan')
                                                <div class="div-sale">
                                                    <label class="label-sale-01">No. Handphone</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label
                                                        class="label-sale-02 font-semibold">{{ $clients->contact_phone }}</label>
                                                </div>
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Email</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label
                                                        class="label-sale-02 font-semibold">{{ $clients->contact_email }}</label>
                                                </div>
                                            @elseif ($clients->type == 'Perorangan')
                                                <div class="div-sale">
                                                    <label class="label-sale-01">No. Handphone</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label
                                                        class="label-sale-02 font-semibold">{{ $clients->phone }}</label>
                                                </div>
                                                <div class="div-sale">
                                                    <label class="label-sale-01">Email</label>
                                                    <label class="label-sale-02">:</label>
                                                    <label
                                                        class="label-sale-02 font-semibold">{{ $clients->email }}</label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- table start -->
                            <div class="flex justify-center mt-2">
                                <div class="w-[750px]">
                                    @if ($category == 'Service')
                                        @include('sales.service-table')
                                    @else
                                        @include('sales.media-table-preview')
                                    @endif
                                </div>
                            </div>
                            <!-- table end -->

                            <!-- notes start -->
                            <div class="flex justify-center mt-2">
                                <div class="div-sale-notes w-[365px] p-2">
                                    <div>
                                        <label class="sale-note-title">Termin Pembayaran</label>
                                        @foreach ($payment_terms->dataPayments as $payment_term)
                                            <div class="flex">
                                                <label class="label-number-notes">{{ $loop->iteration }}. </label>
                                                <label class="label-sale-notes">{{ $payment_term->term }}
                                                    {{ $payment_term->note }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($category != 'Service')
                                        <div class="mt-4">
                                            <label class="sale-note-title">Gratis Pelayanan :</label>
                                            @foreach ($salesNote as $note)
                                                <label class="label-sale-notes flex">{{ $note }}</label>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="div-sale-notes w-[365px] p-2 ml-5">
                                    <div>
                                        <label class="sale-note-title">Keterangan Tambahan :</label>
                                        <textarea class="label-sale-notes border outline-none p-2" id="other_note" rows="6" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- notes end -->

                            <!-- sign area start -->
                            <div class="flex justify-center mt-2">
                                <div class="sign-area">
                                    <div class="div-sign">
                                        <table class="table-sign">
                                            <thead>
                                                <tr class="h-10">
                                                    <th class="th-title-sign" colspan="4">Mengetahui :</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="td-sign">Nur Cahyono</td>
                                                    <td class="td-sign">Yudhi Pratama</td>
                                                    <td class="td-sign">Ayu Putri Lestari</td>
                                                    <td class="td-sign">Texun Sandy Kamboy</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- sign area end -->

                            <!-- photo start -->
                            @if ($category != 'Service')
                                <div class="flex justify-center mt-2">
                                    <div class="sale-detail">
                                        <img class="img-location-sale"
                                            src="{{ asset('storage/' . $product->location_photo) }}">
                                    </div>
                                    <div class="qr-code-sale ml-4">

                                    </div>
                                </div>
                            @endif
                            <!-- photo end -->
                        </div>
                        <!-- Body end -->
                        <!-- Footer start -->
                        @include('dashboard.layouts.letter-footer')
                        <!-- Footer end -->
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</form>
<!-- Create Sales preview end -->
