@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quotatin start -->
    <?php
    if ($last_revision_status) {
        $quotStatus = $last_revision_status->status;
    } else {
        $quotStatus = $last_status->status;
    }
    $products = json_decode($quotation->products);
    $category = $quotation->media_category->name;
    $client = json_decode($quotation->clients);
    $created_by = json_decode($quotation->created_by);
    $price = json_decode($quotation->price);
    $payment_terms = json_decode($quotation->payment_terms);
    $notes = json_decode($quotation->notes);
    $number = Str::substr($quotation->number, 0, 4);
    if ($quotation->media_category->name == 'Signage') {
        $dataDescription = json_decode($products[0]->description);
    }
    
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $status = ['Created', 'Sent', 'Follow Up', 'Deal', 'Closed'];
    ?>
    <input type="text" id="price" value="{{ json_encode($price) }}" hidden>
    @if ($quotation->media_category->name == 'Signage')
        <input type="text" name="{{ $dataDescription->type }}" id="category" value="{{ $quotation->media_category->name }}"
            hidden>
        <input type="text" id="type" value="{{ $dataDescription->type }}" hidden>
    @else
        <input type="text" id="category" value="{{ $quotation->media_category->name }}" hidden>
    @endif
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-4 border rounded-md">
            <!-- Title Show Quotatin start -->
            <div class="flex border-b">
                <h1 class="text-xl text-teal-50 font-bold w-[700px] tracking-wider px-2">DETAIL PENAWAWARAN NOMOR :
                    {{ substr($quotation->number, 0, 4) }}</h1>
                <div class="flex justify-end p-1 w-full">
                    <a class="flex justify-center items-center mx-1 btn-success"
                        href="/marketing/quotations/home/{{ $quotation->media_category->name }}/{{ $company->id }}">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.012 2c5.518 0 9.997 4.48 9.997 9.998 0 5.517-4.479 9.997-9.997 9.997s-9.998-4.48-9.998-9.997c0-5.518 4.48-9.998 9.998-9.998zm-1.523 6.21s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1">Back</span>
                    </a>
                    <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary" type="button">
                        <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M12.819 14.427c.064.267.077.679-.021.948-.128.351-.381.528-.754.528h-.637v-2.12h.496c.474 0 .803.173.916.644zm3.091-8.65c2.047-.479 4.805.279 6.09 1.179-1.494-1.997-5.23-5.708-7.432-6.882 1.157 1.168 1.563 4.235 1.342 5.703zm-7.457 7.955h-.546v.943h.546c.235 0 .467-.027.576-.227.067-.123.067-.366 0-.489-.109-.198-.341-.227-.576-.227zm13.547-2.732v13h-20v-24h8.409c4.858 0 3.334 8 3.334 8 3.011-.745 8.257-.42 8.257 3zm-12.108 2.761c-.16-.484-.606-.761-1.224-.761h-1.668v3.686h.907v-1.277h.761c.619 0 1.064-.277 1.224-.763.094-.292.094-.597 0-.885zm3.407-.303c-.297-.299-.711-.458-1.199-.458h-1.599v3.686h1.599c.537 0 .961-.181 1.262-.535.554-.659.586-2.035-.063-2.693zm3.701-.458h-2.628v3.686h.907v-1.472h1.49v-.732h-1.49v-.698h1.721v-.784z" />
                        </svg>
                        <span class="mx-1">Create PDF</span>
                    </button>
                    @if ($quotStatus == 'Deal' || $quotStatus == 'Closed')
                        @canany(['isAdmin', 'isMarketing'])
                            @can('isQuotation')
                                @can('isMarketingCreate')
                                    <a class="hidden justify-center items-center mx-1 btn-warning"
                                        href="/marketing/quotation-revisions/revision/{{ $quotation->media_category->name }}/{{ $quotation->id }}">
                                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1">Revisi</span>
                                    </a>
                                @endcan
                            @endcan
                        @endcanany
                    @else
                        @canany(['isAdmin', 'isMarketing'])
                            @can('isQuotation')
                                @can('isMarketingCreate')
                                    <a class="flex justify-center items-center ml-1 btn-warning"
                                        href="/marketing/quotation-revisions/revision/{{ $quotation->media_category->name }}/{{ $quotation->id }}">
                                        <svg class="fill-current w-4 lg:w-5" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                fill-rule="nonzero" />
                                        </svg>
                                        <span class="mx-1">Revisi</span>
                                    </a>
                                @endcan
                            @endcan
                        @endcanany
                    @endif
                </div>
            </div>
            <!-- Title Show Quotatin end -->
            <div class="flex">
                <div class="flex justify-center mx-1">
                    <div>
                        <div class="mt-1 w-60 h-max py-1 px-2">
                            <div class="mt-1">
                                <label class="text-sm text-teal-50 font-semibold">Progress Penawaran</label>
                            </div>
                            <div
                                class="flex justify-center overflow-y-auto w-56 h-[300px] bg-teal-50 border rounded-lg p-1 mt-1">
                                <div>
                                    @php
                                        $index = count($quotation_statuses);
                                    @endphp
                                    @foreach ($quotation_statuses as $quotation_status)
                                        <?php
                                        $updated_by = json_decode($quotation_status->updated_by);
                                        ?>
                                        <div class="border rounded-md mt-2 w-48 p-2 bg-amber-100 bg-opacity-50">
                                            <div
                                                class="flex text-sm w-44 justify-center text-teal-900 border-b font-semibold">
                                                UPDATE KE -
                                                {{ $index }}.
                                            </div>
                                            <div class="mt-1">
                                                <label class="flex text-sm text-teal-900">Diupdate oleh :</label>
                                                <label
                                                    class="flex w-44 font-semibold border-b text-sm text-teal-900">{{ $updated_by->name }}</label>
                                            </div>
                                            <div class="mt-1">
                                                <label class="flex text-sm text-teal-900">Status :</label>
                                                <label
                                                    class="flex w-44 font-semibold border-b text-sm text-teal-900">{{ $quotation_status->status }}</label>
                                            </div>
                                            <div class="mt-1">
                                                <label class="flex text-sm text-teal-900">Tanggal :</label>
                                                <label
                                                    class="flex w-44 font-semibold border-b text-sm text-teal-900">{{ date('d', strtotime($quotation_status->created_at)) }}
                                                    {{ $bulan[(int) date('m', strtotime($quotation_status->created_at))] }}
                                                    {{ date('Y', strtotime($quotation_status->created_at)) }}</label>
                                            </div>
                                            <div class="mt-1">
                                                <label class="flex text-sm text-teal-900">Keterangan :</label>
                                                <label class="flex w-44 font-semibold border-b text-sm text-teal-900">
                                                    {{ $quotation_status->description }}</label>
                                            </div>
                                        </div>
                                        @php
                                            $index--;
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                            @if (count($quotation->quotation_revisions) != 0)
                                <div class="mt-1">
                                    <label class="text-sm text-teal-50 font-semibold">Daftar Revisi</label>
                                </div>
                                <div class="mt-1 bg-teal-50 border rounded-lg p-2">
                                    <div class="overflow-y-auto h-16">
                                        @foreach ($quotation->quotation_revisions as $quotation_revision)
                                            <a class="flex"
                                                href="/marketing/quotation-revisions/{{ $quotation_revision->id }}">
                                                <span
                                                    class="text-teal-900 hover:text-emerald-500 text-sm">{{ $loop->iteration }}.
                                                    {{ $quotation_revision->number }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if (session()->has('success'))
                            <div
                                class="text-amber-400 text-sm rounded-lg border border-amber-400 bg-opacity-60 bg-stone-900 drop-shadow-xl shadow-inner p-1 w-60">
                                <div class="flex justify-center">
                                    <svg class="flex fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                                    </svg>
                                    <span class="flex font-semibold mx-1">Success!</span>
                                </div>
                                <label class="flex text-center w-56">{{ session('success') }}</label>
                            </div>
                        @endif
                        <form class="" action="/marketing/quotation-statuses" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <?php
                            $updated_by = new stdClass();
                            $updated_by->id = auth()->user()->id;
                            $updated_by->name = auth()->user()->name;
                            $updated_by->position = auth()->user()->position;
                            ?>
                            <input type="text" name="quotation_id" value="{{ $quotation->id }}" hidden>
                            <input type="text" name="updated_by" value="{{ json_encode($updated_by) }}" hidden>
                            @if ($last_status->status == 'Deal' || $last_status->status == 'Closed' || count($data_revisions) != 0)
                                @canany(['isAdmin', 'isMarketing'])
                                    @can('isQuotation')
                                        @can('isMarketingCreate')
                                            <div class="mt-1" hidden>
                                                <input type="checkbox" id="cbUpdate" onclick="updateProgress(this)">
                                                <input type="text" id="cbUpdateValue" name="cb-update-value"
                                                    value="{{ old('cb-update-value') }}" hidden>
                                                <label class="text-sm font-semibold text-teal-50"> Update Progress</label>
                                            </div>
                                        @endcan
                                    @endcan
                                @endcanany
                            @else
                                @canany(['isAdmin', 'isMarketing'])
                                    @can('isQuotation')
                                        @can('isMarketingCreate')
                                            <div class="mt-1">
                                                <input type="checkbox" id="cbUpdate" onclick="updateProgress(this)">
                                                <input type="text" id="cbUpdateValue" name="cb-update-value"
                                                    value="{{ old('cb-update-value') }}" hidden>
                                                <label class="text-sm font-semibold text-teal-50">Update Progress</label>
                                            </div>
                                        @endcan
                                    @endcan
                                @endcanany
                            @endif
                            <div id="divProgress" hidden>
                                <div class="mt-1">
                                    <label class="text-sm text-teal-50">Status</label>
                                    <select id="status" name="status"
                                        class="flex w-36 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('status') is-invalid @enderror"
                                        type="text" value="{{ old('status') }}" onchange="getStatus(this)">
                                        @if ($last_status->status == 'Created')
                                            @for ($i = 0; $i < count($status); $i++)
                                                @if ($i == 1 || $i == 4)
                                                    @if (old('status') == $status[$i])
                                                        <option value="{{ $status[$i] }}" selected> {{ $status[$i] }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $status[$i] }}"> {{ $status[$i] }}
                                                        </option>
                                                    @endif
                                                @endif
                                            @endfor
                                        @elseif ($last_status->status == 'Sent' || $last_status->status == 'Follow Up')
                                            @for ($i = 0; $i < count($status); $i++)
                                                @if ($i == 2 || $i == 3 || $i == 4)
                                                    @if (old('status') == $status[$i])
                                                        <option value="{{ $status[$i] }}" selected> {{ $status[$i] }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $status[$i] }}"> {{ $status[$i] }}
                                                        </option>
                                                    @endif
                                                @endif
                                            @endfor
                                        @endif
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div id="divApproval" class="mt-1" hidden>
                                    <label class="text-sm text-teal-50">Document Approval</label>
                                    <div class="flex items-center">
                                        <input class="hidden" id="documentApproval" name="document_approval[]"
                                            type="file" accept="image/png, image/jpg, image/jpeg"
                                            onchange="imagePreview(this, document.querySelectorAll('[id=labelDocumentApproval]'))"
                                            multiple>
                                        <label id="labelDocumentApproval"
                                            class="flex text-sm text-teal-700 border bg-white border-teal-700 rounded-lg px-2 w-32">0
                                            dokumen</label>
                                        <button id="approval" type="button"
                                            class="flex justify-center items-center ml-2 px-1 w-20 h-5 bg-teal-500 rounded-md text-white hover:bg-teal-600 drop-shadow-md"
                                            onclick="btnImages(this, document.getElementById('documentApproval'), document.querySelectorAll('[id=labelDocumentApproval]'))">
                                            <svg class="fill-current w-3" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z" />
                                            </svg>
                                            <span class="text-sm ml-1">Tambah</span>
                                        </button>
                                    </div>
                                    @error('document_approval')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @error('document_approval.*')
                                        <div class="invalid-feedback">
                                            Ukuran file max 1024 kb, tipe file jpeg/jpg/png
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-1">
                                    <label class="text-sm text-teal-50">Keterangan</label>
                                    <textarea
                                        class="flex w-56 text-sm text-left font-semibold text-teal-900 border rounded-lg p-2 outline-none @error('description') is-invalid @enderror"
                                        id="description" name="description" rows="4" cols="">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-1">
                                    <button id="btnSaveProgress"
                                        class="flex justify-center items-center mx-1 btn-primary mb-2" type="submit">
                                        <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                        </svg>
                                        <span class="ml-2 text-white">Save Progress</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="pdfPreview">
                    <div class="flex justify-center w-full">
                        <div class="w-[950px] h-[1345px] mt-1 p-4 bg-white">
                            <!-- Header start -->
                            @include('dashboard.layouts.letter-header')
                            <!-- Header end -->
                            <!-- Body start -->
                            <div class="h-[1110px]">
                                <div class="flex justify-center">
                                    <div class="w-[725px] mt-2">
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black w-20">Nomor</label>
                                            <label class="ml-1 text-sm text-black">:</label>
                                            <label class="ml-1 text-sm text-black">{{ $quotation->number }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black w-20">Lampiran</label>
                                            <label class="ml-1 text-sm text-black">:</label>
                                            <label class="ml-1 text-sm text-black">{{ $quotation->attachment }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black w-20">Perihal</label>
                                            <label class="ml-1 text-sm text-black">:</label>
                                            <label class="ml-1 text-sm text-black">{{ $quotation->subject }}</label>
                                        </div>
                                        <div class="mt-4">
                                            <label class="flex ml-1 text-sm text-black w-20">Kepada Yth</label>
                                            @if ($client->type == 'Perorangan')
                                                <label
                                                    class="flex ml-1 text-sm text-black font-semibold">{{ $client->name }}</label>
                                            @else
                                                <label
                                                    class="flex ml-1 text-sm text-black font-semibold">{{ $client->company }}</label>
                                                @if ($client->contact_gender == 'Male')
                                                    <label class="flex ml-1 text-sm text-black font-semibold">Bapak
                                                        {{ $client->contact_name }}</label>
                                                @else
                                                    <label class="flex ml-1 text-sm text-black font-semibold">Ibu
                                                        {{ $client->contact_name }}</label>
                                                @endif
                                            @endif
                                            <label class="flex ml-1 text-sm text-black">Di -</label>
                                            <label class="flex ml-6 text-sm text-black">Tempat</label>
                                        </div>
                                        <div class="flex mt-4">
                                            <label class="ml-1 text-sm text-black w-20">Email</label>
                                            <label class="ml-1 text-sm text-black ">:</label>
                                            @if ($client->type == 'Perorangan')
                                                <label class="ml-1 text-sm text-black ">{{ $client->email }}</label>
                                            @else
                                                <label
                                                    class="ml-1 text-sm text-black ">{{ $client->contact_email }}</label>
                                            @endif

                                        </div>
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black w-20">No. Telp.</label>
                                            <label class="ml-1 text-sm text-black ">:</label>
                                            @if ($client->type == 'Perorangan')
                                                <label class="ml-1 text-sm text-black ">{{ $client->phone }}</label>
                                            @else
                                                <label
                                                    class="ml-1 text-sm text-black ">{{ $client->contact_phone }}</label>
                                            @endif
                                        </div>
                                        <div class="flex mt-4">
                                            <label class="ml-1 text-sm text-black">Dengan hormat,</label>
                                        </div>
                                        <div class="flex mt-2 text-sm text-justify w-[720px] ml-1">
                                            {{ $quotation->body_top }}
                                        </div>
                                    </div>
                                </div>
                                <!-- table start -->
                                <div class="ml-2">
                                    <div class="flex justify-center">
                                        @if ($quotation->media_category->name == 'Service')
                                            @include('quotations.service-show-table')
                                        @else
                                            @if (
                                                $quotation->media_category->name == 'Videotron' ||
                                                    ($quotation->media_category->name == 'Signage' && $dataDescription->type == 'Videotron'))
                                                @include('quotations.vt-show-table')
                                            @else
                                                @include('quotations.bb-show-table')
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <!-- table end -->

                                <!-- quotation note start -->
                                <div class="flex justify-center">
                                    <div class="w-[725px] mt-2">
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                            <label class="ml-1 text-sm text-black flex">:</label>
                                        </div>
                                        <div>
                                            @foreach ($notes->dataNotes as $note)
                                                @if ($quotation->media_category->name == 'Service')
                                                    <label
                                                        class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                @else
                                                    @if (
                                                        $quotation->media_category->name == 'Videotron' ||
                                                            ($quotation->media_category->name == 'Signage' && $dataDescription->type == 'Videotron'))
                                                        @if ($loop->iteration == 3 || $loop->iteration == 4)
                                                            <label
                                                                class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                        @elseif (count($notes->dataNotes) == $loop->iteration)
                                                            <label
                                                                class="ml-1 text-sm text-black flex font-semibold">{{ $note }}</label>
                                                        @else
                                                            <label
                                                                class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                        @endif
                                                    @else
                                                        @if ($notes->freePrint != 0 && $notes->freeInstall != 0)
                                                            @if ($loop->iteration == 3 || $loop->iteration == 4 || $loop->iteration == 5)
                                                                <label
                                                                    class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                            @elseif (count($notes->dataNotes) == $loop->iteration)
                                                                <label
                                                                    class="ml-1 text-sm text-black flex font-semibold">{{ $note }}</label>
                                                            @else
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                            @endif
                                                        @elseif (($notes->freePrint == 0 && $notes->freeInstall != 0) || ($notes->freePrint != 0 && $notes->freeInstall == 0))
                                                            @if ($loop->iteration == 3 || $loop->iteration == 4)
                                                                <label
                                                                    class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                            @elseif (count($notes->dataNotes) == $loop->iteration)
                                                                <label
                                                                    class="ml-1 text-sm text-black flex font-semibold">{{ $note }}</label>
                                                            @else
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                            @endif
                                                        @elseif ($notes->freePrint == 0 && $notes->freeInstall == 0)
                                                            @if ($loop->iteration == 3)
                                                                <label
                                                                    class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                            @elseif (count($notes->dataNotes) == $loop->iteration)
                                                                <label
                                                                    class="ml-1 text-sm text-black flex font-semibold">{{ $note }}</label>
                                                            @else
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                            @endif
                                                        @else
                                                            @if (count($notes->dataNotes) == $loop->iteration)
                                                                <label
                                                                    class="ml-1 text-sm text-black flex font-semibold">{{ $note }}</label>
                                                            @else
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="flex mt-2">
                                            <label class="ml-1 text-sm text-black flex">Sistem pembayaran :</label>
                                        </div>
                                        <div>
                                            @foreach ($payment_terms->dataPayments as $payment)
                                                <div class="flex">
                                                    <label class="ml-1 text-sm text-black flex">-</label>
                                                    <label
                                                        class="ml-1 text-sm text-black flex">{{ $payment->term }}</label>
                                                    <label
                                                        class="ml-2 text-sm text-black flex">{{ $payment->note }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- quotation note end -->
                                <div>
                                    <div class="flex justify-center">
                                        <div class="flex mt-4">
                                            <label class="ml-1 w-[721px] text-sm">{{ $quotation->body_end }}</label>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="w-[725px] mt-4">
                                            <label class="ml-1 text-sm text-black flex">Denpasar,
                                                {{ date('d', strtotime($quotation->created_at)) }}
                                                {{ $bulan[(int) date('m', strtotime($quotation->created_at))] }}
                                                {{ date('Y', strtotime($quotation->created_at)) }}</label>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="flex w-[725px]">
                                            <div class="mt-2">
                                                <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista
                                                    Media</label>
                                                <label
                                                    class="ml-1 mt-10 text-sm text-black flex font-semibold"><u>{{ $created_by->name }}</u></label>
                                                <label
                                                    class="flex ml-1 text-sm text-black">{{ $created_by->position }}</label>
                                                <label class="flex ml-1 text-sm text-black">Hp.
                                                    {{ $created_by->phone }}</label>
                                            </div>
                                            <div class="flex ml-4 mt-2">
                                                {{ QrCode::size(100)->generate('http://vistamedia.co.id/quotations/preview/' . $category . '/' . Crypt::encrypt($quotation->id)) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Body end -->
                            <!-- Footer start -->
                            @include('dashboard.layouts.letter-footer')
                            <!-- Footer end -->
                        </div>
                    </div>
                    <!-- View Location start -->
                    @if ($quotation->media_category->name != 'Service')
                        @foreach ($products as $product)
                            @php
                                $description = json_decode($product->description);
                                $sectors = json_decode($product->sector);

                                if ($product->category == 'Signage') {
                                    $mapsLink =
                                        'https://maps.googleapis.com/maps/api/staticmap?center=' .
                                        $description->lat[0] .
                                        ',' .
                                        $description->lng[0] .
                                        '&zoom=17&size=480x355&maptype=terrain';
                                    $mapsMarkers = '';
                                    $googleKey = '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                                    for ($i = 0; $i < count($description->lat); $i++) {
                                        $mapsMarkers =
                                            $mapsMarkers .
                                            '&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' .
                                            $description->lat[$i] .
                                            ',' .
                                            $description->lng[$i];
                                    }
                                    $src = $mapsLink . $mapsMarkers . $googleKey;
                                } else {
                                    $src =
                                        'https://maps.googleapis.com/maps/api/staticmap?center=' .
                                        $description->lat .
                                        ',' .
                                        $description->lng .
                                        '&zoom=16&size=480x355&maptype=terrain&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' .
                                        $description->lat .
                                        ',' .
                                        $description->lng .
                                        '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                                }
                            @endphp
                            <div class="flex justify-center w-full">
                                <div class="w-[950px] h-[1345px] mt-1 p-4 bg-white">
                                    <!-- Header start -->
                                    @include('dashboard.layouts.letter-header')
                                    <!-- Header end -->
                                    <!-- Body start -->
                                    <div class="h-[1110px]">
                                        <div class="flex w-full h-[50px] justify-center items-center mt-1">
                                            <div
                                                class="flex w-[800px] h-[50px] justify-start items-center bg-slate-50 border rounded-t-xl">
                                                <span
                                                    class="flex justify-end items-center w-20 h-[42px] text-lg text-red-700 font-bold">{{ $product->code }}</span>
                                                <span
                                                    class="flex justify-start items-center w-20 h-[42px] text-lg font-bold ml-1">
                                                    -
                                                    {{ $product->city_code }}
                                                </span>
                                                <img class="h-10" src="/img/code-line.png" alt="">
                                                <span
                                                    class="flex items-center w-[575px] h-[42px] text-base font-semibold">{{ $product->address }}
                                                    | {{ strtoupper($product->area) }}</span>
                                            </div>
                                        </div>
                                        <div class="flex w-full h-[570px] justify-center mt-2">
                                            <div
                                                class="flex w-[800px] h-[570px] justify-center items-center bg-slate-50 border rounded-b-xl">
                                                <img class="m-auto w-[770px] h-[540px]"
                                                    src="{{ asset('storage/' . $product->photo) }}" alt="">
                                            </div>
                                        </div>
                                        <div class="flex w-full justify-center mt-2 h-[470px] bg-white">
                                            <div class="w-[544px] h-[470px] bg-white justify-center">
                                                <div
                                                    class="flex w-[544px] h-10 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                    Google Maps Koordinat :
                                                    @if ($quotation->media_category->name == 'Signage')
                                                        {{ number_format($description->lat[0], 7) . ', ' . number_format($description->lng[0], 7) }}
                                                    @else
                                                        {{ number_format($description->lat, 7) . ', ' . number_format($description->lng, 7) }}
                                                    @endif
                                                </div>
                                                <div class="flex relative w-[544px] h-[430px] mt-1 rounded-b-lg">
                                                    <div class="flex absolute w-[100px] mt-[325px] ml-1">
                                                        @if ($quotation->media_category->name == 'Signage')
                                                            {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $description->lat[0] . ',' . $description->lng[0] . '/@' . $description->lat[0] . ',' . $description->lng[0] . ',16z') }}
                                                        @else
                                                            {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $description->lat . ',' . $description->lng . '/@' . $description->lat . ',' . $description->lng . ',16z') }}
                                                        @endif
                                                    </div>
                                                    <img class="w-[544px] h-[430px] border rounded-b-xl" id="myImage"
                                                        name="myImage" src="{{ $src }}" alt="">
                                                </div>
                                            </div>
                                            <div class="w-[256px] h-[470px] bg-white justify-center ml-1">
                                                <div
                                                    class="flex p-1 items-center justify-center w-[256px] h-10 bg-slate-50 border rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                    Deskripsi Lokasi
                                                </div>
                                                @if (
                                                    $quotation->media_category->name == 'Billboard' ||
                                                        $quotation->media_category->name == 'Bando' ||
                                                        $quotation->media_category->name == 'Baliho' ||
                                                        $quotation->media_category->name == 'Midiboard')
                                                    @include('quotations.bb-description-show')
                                                @elseif ($quotation->media_category->name == 'Videotron')
                                                    @include('quotations.vt-description-show')
                                                @elseif ($quotation->media_category->name == 'Signage')
                                                    @include('quotations.sn-description-show')
                                                @endif
                                                <div
                                                    class="flex w-[256px] h-10 p-1 bg-slate-50 mt-1 border justify-center items-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                    Informasi Area
                                                </div>
                                                <div class="w-[256px] h-[212px] border bg-slate-50 mt-1 rounded-b-lg">
                                                    <div class="flex">
                                                        <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Type
                                                            Jalan</span>
                                                        <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                            {{ $product->road_segment }}
                                                        </span>
                                                    </div>
                                                    <div class="flex">
                                                        <span class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak
                                                            Pandang</span>
                                                        <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                            {{ $product->max_distance }}
                                                        </span>
                                                    </div>
                                                    <div class="flex">
                                                        <span
                                                            class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                                            Kend.</span>
                                                        <span class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                                            {{ $product->speed_average }}
                                                        </span>
                                                    </div>
                                                    <div class="flex">
                                                        <div>
                                                            <span
                                                                class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                                            </span>
                                                            <span class="w-[100px] flex mt-[40px] ml-2">
                                                                {{ QrCode::size(100)->generate('https://vistamedia.co.id/locations/guest-preview/' . $category . '/' . Crypt::encrypt($product->id)) }}
                                                            </span>
                                                        </div>
                                                        <span
                                                            class="flex w-[120px] text-xs font-mono font-thin text-teal-900">
                                                            <div>:</div>
                                                            <div>
                                                                @foreach ($sectors->dataSector as $sector)
                                                                    <div>
                                                                        - {{ $sector }}
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Body start -->
                                    <!-- Footer start -->
                                    @include('dashboard.layouts.letter-footer')
                                    <!-- Footer end -->
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <!-- View Location end -->
                </div>
            </div>
        </div>
    </div>

    <!-- Add Approval start -->
    @include('dashboard.layouts.modal-add-document')
    <!-- Add Approval end -->
    @if ($quotation->media_category->name == 'Service')
        <input id="saveName" type="text" value="{{ $number }}-Cetak-Pasang-{{ $client->name }}" hidden>
    @else
        <input id="saveName" type="text"
            value="{{ $number }}-{{ $quotation->media_category->name }}-{{ $client->name }}" hidden>
    @endif
    <!-- Show Quotatin end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>
    <script src="/js/showquotation.js"></script>
    <script src="/js/modaladddocument.js"></script>
    <!-- Script end -->
@endsection
