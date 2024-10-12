@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quotation Revision start -->
    <?php
    $products = json_decode($quotation_revision->products);
    $category = $quotation_revision->quotation->media_category->name;
    $client = json_decode($quotation_revision->quotation->clients);
    $modified_by = json_decode($quotation_revision->modified_by);
    $price = json_decode($quotation_revision->price);
    $payment_terms = json_decode($quotation_revision->payment_terms);
    $notes = json_decode($quotation_revision->notes);
    $number = Str::substr($quotation_revision->number, 0, 8);
    if ($quotation_revision->quotation->media_category->name == 'Signage') {
        $dataDescription = json_decode($products[0]->description);
    }
    
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $status = ['Created', 'Sent', 'Follow Up', 'Deal', 'Closed'];
    ?>
    <input type="text" id="price" value="{{ json_encode($price) }}" hidden>
    <input type="text" id="category" value="{{ $quotation_revision->quotation->media_category->name }}" hidden>
    @if ($quotation_revision->quotation->media_category->name == 'Signage')
        <input type="text" id="type" value="{{ $dataDescription->type }}" hidden>
    @endif
    <div class="flex justify-center p-10">
        <div class="w-[1200px]">
            <!-- Title Show Quotation Revision start -->
            <div class="flex border-b">
                <h1 class="text-xl text-cyan-800 font-bold tracking-wider">DETAIL REVISI PENAWAWARAN</h1>
            </div>
            <!-- Title Show Quotation Revision end -->
            <div class="flex">
                <div class="flex justify-center mx-1">
                    <div>
                        <div class="mt-1">
                            <div class="mt-1 w-80 h-max border rounded-lg py-1 px-2">
                                <div class="mt-1">
                                    <label class="text-sm text-teal-700 font-semibold">Progres Penawaran</label>
                                </div>
                                <div class="overflow-y-auto h-[350px] border rounded-lg bg-teal-50 mt-2">
                                    @foreach ($quotation_revision->quot_revision_statuses as $quot_revision_status)
                                        <?php
                                        $updated_by = json_decode($quot_revision_status->updated_by);
                                        ?>
                                        <div class="border-b">
                                            <div class="flex ml-[14px] text-sm text-teal-900 font-semibold">
                                                {{ $loop->iteration }}.
                                            </div>
                                            <div class="flex ml-[14px]">
                                                <label class="flex w-28 text-sm text-teal-900">Diupdate oleh</label>
                                                <label class="flex w-2 text-sm text-teal-900">: </label>
                                                <label
                                                    class="flex ml-2 w-44 text-sm text-teal-900">{{ $updated_by->name }}</label>
                                            </div>
                                            <div class="flex ml-[14px]">
                                                <label class="flex w-28 text-sm text-teal-900">Status</label>
                                                <label class="flex w-2 text-sm text-teal-900">: </label>
                                                <label
                                                    class="flex ml-2 w-44 text-sm text-teal-900">{{ $quot_revision_status->status }}</label>
                                            </div>
                                            <div class="flex ml-[14px]">
                                                <label class="flex w-28 text-sm text-teal-900">Tanggal</label>
                                                <label class="flex w-2 text-sm text-teal-900">: </label>
                                                <label
                                                    class="flex ml-2 w-44 text-sm text-teal-900">{{ date('d', strtotime($quotation_revision->created_at)) }}
                                                    {{ $bulan[(int) date('m', strtotime($quotation_revision->created_at))] }}
                                                    {{ date('Y', strtotime($quotation_revision->created_at)) }}</label>
                                            </div>
                                            <div class="flex mb-3 ml-[14px]">
                                                <label class="flex w-28 text-sm text-teal-900">Keterangan</label>
                                                <label class="flex w-2 text-sm text-teal-900">: </label>
                                                <label class="flex ml-2 w-44 text-sm text-teal-900">
                                                    {{ $quot_revision_status->description }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if (session()->has('success'))
                            <div
                                class="text-teal-900 text-sm rounded-lg border border-white bg-opacity-60 bg-teal-200 drop-shadow-xl shadow-inner p-2 w-80">
                                <div class="flex justify-center">
                                    <svg class="flex fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                                    </svg>
                                    <span class="flex font-semibold mx-1">Success!</span>
                                </div>
                                <label class="flex justify-center w-80">{{ session('success') }}</label>
                            </div>
                        @endif
                        <form class="" action="/marketing/quot-revision-statuses" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <?php
                            $updated_by = new stdClass();
                            $updated_by->id = auth()->user()->id;
                            $updated_by->name = auth()->user()->name;
                            $updated_by->position = auth()->user()->position;
                            ?>
                            <input type="text" name="quotation_id" value="{{ $quotation_revision->quotation->id }}"
                                hidden>
                            <input type="text" name="quotation_revision_id" value="{{ $quotation_revision->id }}"
                                hidden>
                            <input type="text" name="updated_by" value="{{ json_encode($updated_by) }}" hidden>
                            @if (
                                $last_statuses->status == 'Deal' ||
                                    $last_statuses->status == 'Closed' ||
                                    $last_revision->number != $quotation_revision->number)
                                <div class="mt-1" hidden>
                                    <input type="checkbox" id="cbUpdate" onclick="updateProgress(this)">
                                    <input type="text" id="cbUpdateValue" name="cb-update-value"
                                        value="{{ old('cb-update-value') }}" hidden>
                                    <label class="text-sm font-semibold text-teal-900"> Update Progress</label>
                                </div>
                            @else
                                <div class="mt-1">
                                    <input type="checkbox" id="cbUpdate" onclick="updateProgress(this)">
                                    <input type="text" id="cbUpdateValue" name="cb-update-value"
                                        value="{{ old('cb-update-value') }}" hidden>
                                    <label class="text-sm font-semibold text-teal-900">Update Progress</label>
                                </div>
                            @endif
                            <div id="divProgress" hidden>
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Status</label>
                                    <select id="status" name="status"
                                        class="flex w-36  text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('status') is-invalid @enderror"
                                        type="text" value="{{ old('status') }}" onchange="getStatus(this)">
                                        @if ($last_statuses->status == 'Created')
                                            @for ($i = 0; $i < count($status); $i++)
                                                @if ($i == 1 || $i == 4)
                                                    @if (old('status') == $status[$i])
                                                        <option value="{{ $status[$i] }}" selected> {{ $status[$i] }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $status[$i] }}"> {{ $status[$i] }} </option>
                                                    @endif
                                                @endif
                                            @endfor
                                        @elseif ($last_statuses->status == 'Sent' || $last_statuses->status == 'Follow Up')
                                            @for ($i = 0; $i < count($status); $i++)
                                                @if ($i == 2 || $i == 3 || $i == 4)
                                                    @if (old('status') == $status[$i])
                                                        <option value="{{ $status[$i] }}" selected> {{ $status[$i] }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $status[$i] }}"> {{ $status[$i] }} </option>
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
                                    <label class="text-sm text-teal-700">Document Approval</label>
                                    <div class="flex items-center">
                                        <input class="hidden" id="documentApproval" name="document_approval[]"
                                            type="file" accept="image/png, image/jpg, image/jpeg"
                                            onchange="imagePreview(this, document.querySelectorAll('[id=labelDocumentApproval]'))"
                                            multiple>
                                        <label id="labelDocumentApproval"
                                            class="flex text-sm text-teal-700 border border-teal-700 rounded-lg px-2 w-40">0
                                            images selected</label>
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
                                </div>
                                <div class="mt-1">
                                    <label class="text-sm text-teal-700">Keterangan</label>
                                    <textarea
                                        class="flex w-80 text-sm text-left font-semibold text-teal-900 border rounded-lg p-2 outline-none @error('description') is-invalid @enderror"
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
                        <div class="flex justify-start mt-5">
                            <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-success"
                                href="/quotations/{{ $quotation_revision->quotation->id }}">
                                <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.012 2c5.518 0 9.997 4.48 9.997 9.998 0 5.517-4.479 9.997-9.997 9.997s-9.998-4.48-9.998-9.997c0-5.518 4.48-9.998 9.998-9.998zm-1.523 6.21s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Back</span>
                            </a>
                            <button id="btnCreatePdf" class="flex justify-center items-center ml-1 btn-success"
                                type="button">
                                <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12.819 14.427c.064.267.077.679-.021.948-.128.351-.381.528-.754.528h-.637v-2.12h.496c.474 0 .803.173.916.644zm3.091-8.65c2.047-.479 4.805.279 6.09 1.179-1.494-1.997-5.23-5.708-7.432-6.882 1.157 1.168 1.563 4.235 1.342 5.703zm-7.457 7.955h-.546v.943h.546c.235 0 .467-.027.576-.227.067-.123.067-.366 0-.489-.109-.198-.341-.227-.576-.227zm13.547-2.732v13h-20v-24h8.409c4.858 0 3.334 8 3.334 8 3.011-.745 8.257-.42 8.257 3zm-12.108 2.761c-.16-.484-.606-.761-1.224-.761h-1.668v3.686h.907v-1.277h.761c.619 0 1.064-.277 1.224-.763.094-.292.094-.597 0-.885zm3.407-.303c-.297-.299-.711-.458-1.199-.458h-1.599v3.686h1.599c.537 0 .961-.181 1.262-.535.554-.659.586-2.035-.063-2.693zm3.701-.458h-2.628v3.686h.907v-1.472h1.49v-.732h-1.49v-.698h1.721v-.784z" />
                                </svg>
                                <span class="ml-2 text-white">Create PDF</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div id="pdfPreview">
                    <div class="flex justify-center w-full">
                        <div class="w-[950px] h-[1345px] mt-1 bg-white">
                            <!-- Header start -->
                            @include('dashboard.layouts.letter-header')
                            <!-- Header end -->
                            <!-- Body start -->
                            <div class="h-[1125px]">
                                <div class="flex justify-center">
                                    <div class="w-[725px] mt-2">
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black w-20">Nomor</label>
                                            <label class="ml-1 text-sm text-black">:</label>
                                            <label
                                                class="ml-1 text-sm text-black">{{ $quotation_revision->number }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black w-20">Lampiran</label>
                                            <label class="ml-1 text-sm text-black">:</label>
                                            <label
                                                class="ml-1 text-sm text-black">{{ $quotation_revision->quotation->attachment }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black w-20">Perihal</label>
                                            <label class="ml-1 text-sm text-black">:</label>
                                            <label
                                                class="ml-1 text-sm text-black">{{ $quotation_revision->quotation->subject }}</label>
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
                                        <div class="flex mt-2">
                                            <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>{{ $quotation_revision->quotation->body_top }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- table start -->
                                <div class="ml-2">
                                    <div class="flex justify-center">
                                        @if ($quotation_revision->quotation->media_category->name == 'Service')
                                            @include('quotations.service-show-table')
                                        @else
                                            @if ($quotation_revision->quotation->media_category->name == 'Billboard')
                                                @include('quotations.bb-show-table')
                                            @elseif($quotation_revision->quotation->media_category->name == 'Videotron')
                                                @include('quotations.vt-show-table')
                                            @elseif($quotation_revision->quotation->media_category->name == 'Signage')
                                                @if ($dataDescription->type == 'Videotron')
                                                    @include('quotations.vt-show-table')
                                                @else
                                                    @include('quotations.bb-show-table')
                                                @endif
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
                                                @if ($category == 'Service')
                                                    <label
                                                        class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                @else
                                                    @if ($quotation_revision->quotation->media_category->name == 'Billboard')
                                                        @if ($notes->freePrint != 0 && $notes->freeInstall != 0)
                                                            @if ($loop->iteration == 3 || $loop->iteration == 4 || $loop->iteration == 5)
                                                                <label
                                                                    class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                            @else
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                            @endif
                                                        @elseif (($notes->freePrint == 0 && $notes->freeInstall != 0) || ($notes->freePrint != 0 && $notes->freeInstall == 0))
                                                            @if ($loop->iteration == 3 || $loop->iteration == 4)
                                                                <label
                                                                    class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                            @else
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                            @endif
                                                        @elseif ($notes->freePrint == 0 && $notes->freeInstall == 0)
                                                            @if ($loop->iteration == 3)
                                                                <label
                                                                    class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                            @else
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                            @endif
                                                        @else
                                                            <label
                                                                class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                        @endif
                                                    @elseif ($quotation_revision->quotation->media_category->name == 'Signage')
                                                        @if ($dataDescription->type == 'Videotron')
                                                            @if ($loop->iteration == 3 || $loop->iteration == 4)
                                                                <label
                                                                    class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                            @else
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                            @endif
                                                        @else
                                                            @if ($notes->freePrint != 0 && $notes->freeInstall != 0)
                                                                @if ($loop->iteration == 3 || $loop->iteration == 4 || $loop->iteration == 5)
                                                                    <label
                                                                        class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                                @else
                                                                    <label
                                                                        class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                                @endif
                                                            @elseif (($notes->freePrint == 0 && $notes->freeInstall != 0) || ($notes->freePrint != 0 && $notes->freeInstall == 0))
                                                                @if ($loop->iteration == 3 || $loop->iteration == 4)
                                                                    <label
                                                                        class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                                @else
                                                                    <label
                                                                        class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                                @endif
                                                            @elseif ($notes->freePrint == 0 && $notes->freeInstall == 0)
                                                                @if ($loop->iteration == 3)
                                                                    <label
                                                                        class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                                @else
                                                                    <label
                                                                        class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                                @endif
                                                            @else
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note }}</label>
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if ($loop->iteration == 3 || $loop->iteration == 4)
                                                            <label
                                                                class="ml-4 text-sm text-black flex">{{ $note }}</label>
                                                        @else
                                                            <label
                                                                class="ml-1 text-sm text-black flex">{{ $note }}</label>
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
                                            <label
                                                class="ml-1 w-[721px] text-sm">{{ $quotation_revision->quotation->body_end }}</label>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="w-[725px] mt-4">
                                            <label class="ml-1 text-sm text-black flex">Denpasar,
                                                {{ date('d', strtotime($quotation_revision->created_at)) }}
                                                {{ $bulan[(int) date('m', strtotime($quotation_revision->created_at))] }}
                                                {{ date('Y', strtotime($quotation_revision->created_at)) }}</label>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="w-[725px]">
                                            <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista
                                                Media</label>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="w-[725px] mt-10">
                                            <input
                                                class="ml-1 text-sm text-black flex font-semibold"value="{{ $modified_by->name }}"
                                                type="text">
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="w-[725px]">
                                            <input class="ml-1 text-sm text-black flex"
                                                value="{{ $modified_by->position }}" type="text">
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
                    @if ($category != 'Service')
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
                                <div class="w-[950px] h-[1345px] mt-1 bg-white">
                                    <!-- Header start -->
                                    @include('dashboard.layouts.letter-header')
                                    <!-- Header end -->
                                    <!-- Body start -->
                                    <div class="h-[1125px]">
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
                                                    src="{{ asset('storage/' . $product->location_photo) }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="flex w-full justify-center mt-4 h-[470px] bg-white">
                                            <div class="w-[544px] h-[470px] bg-white justify-center">
                                                <div
                                                    class="flex w-[544px] h-10 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                    Google Maps Koordinat :
                                                    @if ($quotation_revision->quotation->media_category->name == 'Signage')
                                                        {{ number_format($description->lat[0], 7) . ', ' . number_format($description->lng[0], 7) }}
                                                    @else
                                                        {{ number_format($description->lat, 7) . ', ' . number_format($description->lng, 7) }}
                                                    @endif
                                                </div>
                                                <div class="flex relative w-[544px] h-[430px] mt-1 rounded-b-lg">
                                                    <div class="flex absolute w-[100px] mt-[325px] ml-1">
                                                        @if ($quotation_revision->quotation->media_category->name == 'Signage')
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
                                                    $quotation_revision->quotation->media_category->name == 'Billboard' ||
                                                        $quotation_revision->quotation->media_category->name == 'Bando' ||
                                                        $quotation_revision->quotation->media_category->name == 'Baliho' ||
                                                        $quotation_revision->quotation->media_category->name == 'Midiboard')
                                                    @include('quotations.bb-description-show')
                                                @elseif ($quotation_revision->quotation->media_category->name == 'Videotron')
                                                    @include('quotations.vt-description-show')
                                                @elseif ($quotation_revision->quotation->media_category->name == 'Signage')
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
                                                                {{ QrCode::size(100)->generate('https://vistamedia.co.id/quotations/preview/' . $quotation_revision->quotation->media_category->name . '/' . $product->id) }}
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

    <!-- Add Document Approval start -->
    @include('dashboard.layouts.modal-add-document')
    {{-- <div id="modalApproval" name="modalApproval"
        class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
        <div>
            <div class="flex mt-10">
                <button id="btnApprovalSubmit" class="flex justify-center items-center mx-1 btn-primary mb-2"
                    title="Submit" type="button">
                    <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                            fill-rule="nonzero" />
                    </svg>
                    <span class="ml-2 text-white">Submit</span>
                </button>
                <button id="btnApprovalClear" class="flex justify-center items-center mx-1 btn-danger mb-2"
                    title="Cancel" type="button">
                    <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z" />
                    </svg>
                    <span class="ml-2 text-white">Clear</span>
                </button>
                <div class="flex justify-end px-2 w-full">
                    <button id="btnApprovalClose" class="flex" title="Close" type="button">
                        <svg class="fill-gray-500 w-6 m-auto hover:fill-red-700" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="w-[800px] h-max bg-white mt-2 p-4">
                <div class="flex justify-center">
                    <div>
                        <div class="flex justify-center w-full m-2">
                            <button id="btnChoseApproval" name="btnChoseApproval"
                                class="flex justify-center items-center w-44 btn-primary" title="Chose Files"
                                type="button" onclick="document.getElementById('documentApproval').click()">
                                <svg class="fill-current w-[18px]" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                </svg>
                                <span class="ml-2">Chose Images</span>
                            </button>
                        </div>
                        <div class="flex justify-center my-2 border-b-2 border-teal-700">
                            <label id="numberApprovalFile" class="text-sm text-teal-700">No
                                Files Chosen</label>
                        </div>
                        <figure class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-teal-700"
                            id="approvalImg">

                        </figure>
                        <div class="relative m-auto w-[750px] h-max">
                            <div id="prevApprovalButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                <button
                                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    type="button">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="nextApprovalButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                <button type="button"
                                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="slidesApprovalPreview" class="mt-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Add Document Approval end -->
    @if ($quotation_revision->quotation->media_category->name == 'Service')
        <input id="saveName" type="text" value="{{ $number }}-Cetak-Pasang-{{ $client->name }}" hidden>
    @else
        <input id="saveName" type="text"
            value="{{ $number }}-{{ $quotation_revision->quotation->media_category->name }}-{{ $client->name }}"
            hidden>
    @endif
    <!-- Show Quotation Revision end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>
    <script src="/js/showquotation.js"></script>
    <script src="/js/modaladddocument.js"></script>

    {{-- <script>
        const divProgress = document.getElementById("divProgress");
        const divApproval = document.getElementById("divApproval");
        const cbUpdate = document.getElementById("cbUpdate");
        const status = document.getElementById("status");
        const price = document.getElementById("price");
        const btnSaveProgress = document.getElementById("btnSaveProgress");
        const cbUpdateValue = document.getElementById("cbUpdateValue");

        if (Boolean(cbUpdateValue.value) == true) {
            divProgress.removeAttribute('hidden');
            cbUpdate.checked = true;
            if (status.value == "Deal") {
                divApproval.removeAttribute('hidden');
            } else {
                divApproval.setAttribute('hidden', 'hidden');
            }
        } else {
            divProgress.setAttribute('hidden', 'hidden');
            cbUpdate.checked = false;
        }


        updateProgress = (sel) => {
            if (sel.checked == true) {
                divProgress.removeAttribute('hidden');
                cbUpdateValue.value = true;
            } else {
                divProgress.setAttribute('hidden', 'hidden');
                cbUpdateValue.value = false;
            }
        }

        getStatus = (sel) => {
            if (sel.options[sel.selectedIndex].text == "Deal") {
                let dataTitle = JSON.parse(price.value);
                var titlePrice = 0;
                for (let i = 0; i < dataTitle.length; i++) {
                    if (dataTitle[i].checkbox == true) {
                        titlePrice++;
                    }
                }
                if (titlePrice > 1) {
                    btnSaveProgress.classList.add('hidden');
                    alert('Silahkan revisi penawaran, harga harus dalam 1 periode');
                } else {
                    divApproval.removeAttribute('hidden');
                    btnSaveProgress.classList.remove('hidden');
                    // selectStatus.value = sel.options[sel.selectedIndex].text;
                }
                // status.value = sel.options[sel.selectedIndex].text;
            } else {
                divApproval.setAttribute('hidden', 'hidden');
                btnSaveProgress.classList.remove('hidden');
                // status.value = sel.options[sel.selectedIndex].text;
            }
        }

        const modalApproval = document.getElementById("modalApproval");

        const btnApprovalClear = document.getElementById("btnApprovalClear");
        const btnApprovalClose = document.getElementById("btnApprovalClose");
        const btnApprovalSubmit = document.getElementById("btnApprovalSubmit");
        const documentApproval = document.querySelector('#documentApproval');

        const slidesApprovalPreview = document.getElementById("slidesApprovalPreview");
        const numberApprovalFile = document.getElementById("numberApprovalFile");
        const labelDocumentApproval = document.getElementById("labelDocumentApproval");
        const prevApprovalButton = document.getElementById("prevApprovalButton");
        const nextApprovalButton = document.getElementById("nextApprovalButton");
        const approvalImg = document.getElementById("approvalImg");

        let approvalImage = [];
        let slideApprovalPreview = [];
        let slideApprovalImage = [];
        let slideApprovalIndex = 0;

        // Function Button Approval Event --> start
        function btnApprovalEvent() {
            modalApproval.classList.remove("hidden");
            modalApproval.classList.add("flex");
            window.scrollTo(0, 0);
        }

        btnApprovalClear.addEventListener('click', function() {
            prevApprovalButton.setAttribute('hidden', 'hidden');
            nextApprovalButton.setAttribute('hidden', 'hidden');
            documentApproval.value = null;
            labelDocumentApproval.innerHTML = "0 images selected";
            numberApprovalFile.innerHTML = "No Files Chosen";
            approvalImage = [];
            slideApprovalPreview = [];
            slideApprovalImage = [];
            while (approvalImg.hasChildNodes()) {
                approvalImg.removeChild(approvalImg.firstChild);
            }
            while (slidesApprovalPreview.hasChildNodes()) {
                slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
            }
        })

        btnApprovalClose.addEventListener('click', function() {
            modalApproval.classList.add("hidden");
            modalApproval.classList.remove("flex");
        })

        btnApprovalSubmit.addEventListener('click', function() {
            slideApprovalIndex = 0;
            if (documentApproval.files.length == 0) {
                alert("Document approval belum dipilih")
            } else {
                modalApproval.classList.add("hidden");
                modalApproval.classList.remove("flex");
                labelDocumentApproval.innerHTML = "";
                labelDocumentApproval.innerHTML = documentApproval.files.length + " images selected";
            }
        })
        // Function Button Approval Event --> end

        // Preview Approval Document --> start
        function previewAppovalImage() {
            while (approvalImg.hasChildNodes()) {
                approvalImg.removeChild(approvalImg.firstChild);
            }

            while (slidesApprovalPreview.hasChildNodes()) {
                slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
            }

            if (documentApproval.files.length != 0) {
                numberApprovalFile.innerHTML = "";
                numberApprovalFile.innerHTML = documentApproval.files.length + " images selected";

                for (n = 0; n < documentApproval.files.length; n++) {
                    const file = documentApproval.files[n];
                    const objectUrl = URL.createObjectURL(file);

                    approvalImage[n] = document.createElement("img")
                    if (n == 0) {
                        approvalImage[n].classList.add("document-approval-active");
                    } else {
                        approvalImage[n].classList.add("document-approval");
                    }

                    approvalImage[n].src = objectUrl;
                    approvalImage[n].setAttribute('id', n);
                    approvalImage[n].setAttribute('onclick', 'myApprovalSlide(this)');
                    approvalImg.appendChild(approvalImage[n]);

                    slideApprovalPreview[n] = document.createElement("figure");
                    slideApprovalPreview[n].classList.add("mySlides");
                    slideApprovalPreview[n].classList.add("fade");
                    slideApprovalImage[n] = document.createElement("img");
                    if (n != 0) {
                        slideApprovalImage[n].classList.add("hidden");
                    }
                    slideApprovalImage[n].classList.add("w-full");
                    slideApprovalImage[n].classList.add("mt-2");
                    slideApprovalImage[n].src = objectUrl;
                    slideApprovalPreview[n].appendChild(slideApprovalImage[n]);
                    slidesApprovalPreview.appendChild(slideApprovalPreview[n]);
                }

                prevApprovalButton.removeAttribute('hidden');
                nextApprovalButton.removeAttribute('hidden');
            }
        }

        prevApprovalButton.addEventListener('click', function() {
            console.log(slideApprovalIndex);
            if (slideApprovalIndex != 0) {
                slideApprovalImage[slideApprovalIndex].classList.add("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
                approvalImage[slideApprovalIndex].classList.add("document-approval");
                slideApprovalIndex = slideApprovalIndex - 1;
                slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval");
                approvalImage[slideApprovalIndex].classList.add("document-approval-active");
            } else {
                slideApprovalImage[slideApprovalIndex].classList.add("hidden");
                approvalImage[0].classList.remove("document-approval-active");
                approvalImage[0].classList.add("document-approval");
                slideApprovalIndex = documentApproval.files.length - 1;
                slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval");
                approvalImage[slideApprovalIndex].classList.add("document-approval-active");
            }
        })

        nextApprovalButton.addEventListener('click', function() {
            console.log(slideApprovalIndex);
            if (slideApprovalIndex != documentApproval.files.length - 1) {
                slideApprovalImage[slideApprovalIndex].classList.add("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
                approvalImage[slideApprovalIndex].classList.add("document-approval");
                slideApprovalIndex = slideApprovalIndex + 1;
                slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval");
                approvalImage[slideApprovalIndex].classList.add("document-approval-active");
            } else {
                slideApprovalImage[slideApprovalIndex].classList.add("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
                approvalImage[slideApprovalIndex].classList.add("document-approval");
                slideApprovalIndex = 0;
                slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval");
                approvalImage[slideApprovalIndex].classList.add("document-approval-active");
            }
        })

        function myApprovalSlide(img) {
            slideApprovalImage[slideApprovalIndex].classList.add("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
            approvalImage[slideApprovalIndex].classList.add("document-approval");
            slideApprovalIndex = Number(img.id);
            slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval");
            approvalImage[slideApprovalIndex].classList.add("document-approval-active");
        }
        // Preview Approval Document --> end

        //Function create pdf --> start
        const saveName = document.getElementById("saveName");
        document.getElementById("btnCreatePdf").onclick = function() {
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: saveName.value,
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 192,
                    scale: 4,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'px',
                    format: [950, 1365],
                    orientation: 'portrait',
                    putTotalPages: true
                }
            };
            // html2pdf(element, opt);
            html2pdf().set(opt).from(element).save();
        };
        //Function create pdf --> end
    </script> --}}
    <!-- Script end -->
@endsection
