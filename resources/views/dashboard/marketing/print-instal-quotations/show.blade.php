@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quotatin start -->
    <?php
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <div class="flex justify-center">
        <div>
            <!-- Title Show Quotatin start -->
            <div class="flex border-b mt-10">
                <div class="flex w-full">
                    <h1 class="text-xl text-cyan-800 font-bold tracking-wider">DETAIL PENAWAWARAN CETAK & PASANG</h1>
                </div>
                <!-- Title Show Quotatin start -->
                <div class="flex justify-end w-full">
                    <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Create PDF"
                        type="button">
                        <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                        </svg>
                        <span class="ml-2 text-white">Save PDF</span>
                    </button>
                    <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                        href="/dashboard/marketing/print-instal-quotations">
                        <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Close</span>
                    </a>
                </div>
                <!-- Title Show Quotatin end -->
            </div>
            <!-- Title Show Quotatin end -->
            <div class="flex">
                <div class="flex justify-center mx-1 border-r">
                    <div>
                        <div class="flex mt-1">
                            <div class="mt-1">
                                <label class="text-sm text-teal-700">Nomor</label>
                                <label
                                    class="flex w-80 text-sm font-semibold text-teal-900 border rounded-lg p-1">{{ $print_instal_quotation->number }}</label>
                            </div>
                        </div>
                        <div class="flex mt-1">
                            <div class="mt-1">
                                <label class="text-sm text-teal-700">Nama Klien</label>
                                <label
                                    class="flex w-80 text-sm font-semibold text-teal-900 border rounded-lg p-1">{{ $print_instal_quotation->client->name }}</label>
                            </div>
                        </div>
                        <div class="flex mt-1">
                            <div class="mt-1">
                                <label class="text-sm text-teal-700">Nama Perusahaan</label>
                                <label
                                    class="flex w-80 text-sm font-semibold text-teal-900 border rounded-lg p-1">{{ $print_instal_quotation->client->company }}</label>
                            </div>
                        </div>
                        <div class="flex mt-1">
                            <div class="mt-1">
                                <label class="text-sm text-teal-700">Kontak Person</label>
                                <label
                                    class="flex w-80 text-sm font-semibold text-teal-900 border rounded-lg p-1">{{ $print_instal_quotation->contact->name }}</label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="mt-1">
                                <label class="text-sm text-teal-700">Progres Penawaran</label>
                            </div>
                            <div class="mt-1 w-80 h-max border rounded-md py-1 px-2 mr-2">
                                @foreach ($print_instal_quotation->print_install_statuses as $status)
                                    <div class="flex w-28 border-b">
                                        <label
                                            class="flex text-sm font-semibold text-teal-900">{{ $status->status }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="flex w-28 text-sm font-semibold text-teal-900">Tanggal</label>
                                        <label class="flex w-2 text-sm font-semibold text-teal-900">: </label>
                                        <label
                                            class="flex ml-2 w-44 text-sm font-semibold text-teal-900">{{ date('j', strtotime($status->created_at)) }}
                                            {{ $bulan[(int) date('m', strtotime($status->created_at))] }}
                                            {{ date('Y', strtotime($status->created_at)) }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="flex w-28 text-sm font-semibold text-teal-900">Oleh</label>
                                        <label class="flex w-2 text-sm font-semibold text-teal-900">: </label>
                                        <label class="flex ml-2 w-44 text-sm font-semibold text-teal-900">
                                            {{ $status->user->name }}</label>
                                    </div>
                                    <div class="flex mb-3 border-b">
                                        <label class="flex w-28 text-sm font-semibold text-teal-900">Keterangan</label>
                                        <label class="flex w-2 text-sm font-semibold text-teal-900">: </label>
                                        <label class="flex ml-2 w-44 text-sm font-semibold text-teal-900">
                                            {{ $status->description }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if (session()->has('success'))
                            <div class="flex alert-success">
                                <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                                </svg>
                                <span class="font-semibold mx-1">Success!</span>{{ session('success') }}
                            </div>
                        @endif
                        <form class="" action="/dashboard/marketing/print-install-statuses" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <input name="print_instal_quotation_id" type="text"
                                value="{{ $print_instal_quotation->id }}" hidden>
                            <?php
                            $numberStatus = 0;
                            $lastStatus = $print_instal_quotation->print_install_statuses[count($print_instal_quotation->print_install_statuses) - 1]->status;
                            // $lastStatus = '';
                            $followUp = false;
                            $status = ['Created', 'Sent', 'Follow Up', 'Deal', 'Closed'];
                            ?>
                            {{-- {{ var_dump($lastStatus) }} --}}
                            @if ($lastStatus == 'Deal' || $lastStatus == 'Closed')
                                <div id="divUpdate" class="mt-1" hidden>
                                    <input type="checkbox" id="cbUpdate" name="cbUpdate">
                                    <input type="text" id="cbUpdateValue" name="cb-update-value"
                                        value="{{ old('cb-update-value') }}" hidden>
                                    <label class="text-sm font-semibold text-teal-900">Update
                                        Progress</label>
                                </div>
                            @else
                                <div id="divUpdate" class="mt-1">
                                    <input type="checkbox" id="cbUpdate" name="cbUpdate">
                                    <input type="text" id="cbUpdateValue" name="cb-update-value"
                                        value="{{ old('cb-update-value') }}" hidden>
                                    <label class="text-sm font-semibold text-teal-900">Update
                                        Progress</label>
                                </div>
                            @endif
                            <div class="mt-1" id="divStatus" hidden>
                                <label class="text-sm text-teal-700">Status</label>
                                <select id="status" name="status"
                                    class="flex w-36 xl:w-48 2xl:w-56  text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none
                                @error('status') is-invalid @enderror"
                                    type="text" value="{{ old('status') }}" onchange="statusChange(this)">
                                    @if (old('status') == 'Deal')
                                        @foreach ($print_instal_quotation->print_install_statuses as $statuses)
                                            @if ($statuses->status == 'Follow Up')
                                                <?php
                                                $followUp = true;
                                                ?>
                                            @else
                                                <?php
                                                $followUp = false;
                                                ?>
                                            @endif
                                            @if ($followUp != true)
                                                @if ($statuses->status != $status[$loop->iteration - 1])
                                                    <option value="{{ $status[$loop->iteration - 1] }}">
                                                        {{ $status[$loop->iteration - 1] }}
                                                    </option>
                                                @endif
                                                <?php
                                                $numberStatus = $numberStatus + 1;
                                                ?>
                                            @endif
                                        @endforeach
                                        @for ($i = $numberStatus; $i < count($status); $i++)
                                            @if ($status[$numberStatus] == 'Deal')
                                                <option value="{{ $status[$numberStatus] }}" selected>
                                                    {{ $status[$numberStatus] }}
                                                </option>
                                                <?php
                                                $numberStatus = $numberStatus + 1;
                                                ?>
                                            @else
                                                <option value="{{ $status[$numberStatus] }}">
                                                    {{ $status[$numberStatus] }}
                                                </option>
                                                <?php
                                                $numberStatus = $numberStatus + 1;
                                                ?>
                                            @endif
                                        @endfor
                                    @else
                                        @foreach ($print_instal_quotation->print_install_statuses as $statuses)
                                            @if ($statuses->status == 'Follow Up')
                                                <?php
                                                $followUp = true;
                                                ?>
                                            @else
                                                <?php
                                                $followUp = false;
                                                ?>
                                            @endif
                                            @if ($followUp != true)
                                                @if ($statuses->status != $status[$loop->iteration - 1])
                                                    <option value="{{ $status[$loop->iteration - 1] }}">
                                                        {{ $status[$loop->iteration - 1] }}
                                                    </option>
                                                @endif
                                                <?php
                                                $numberStatus = $numberStatus + 1;
                                                ?>
                                            @endif
                                        @endforeach
                                        @if ($lastStatus == 'Created')
                                            <option value="{{ $status[1] }}">
                                                {{ $status[1] }}
                                            </option>
                                            <option value="{{ $status[4] }}">
                                                {{ $status[4] }}
                                            </option>
                                        @elseif ($lastStatus == 'Sent' || $lastStatus == 'Follow Up')
                                            @for ($i = $numberStatus; $i < count($status); $i++)
                                                <option value="{{ $status[$numberStatus] }}">
                                                    {{ $status[$numberStatus] }}
                                                </option>
                                                <?php
                                                $numberStatus = $numberStatus + 1;
                                                ?>
                                            @endfor
                                        @elseif ($lastStatus == 'Follow Up')
                                            @for ($i = $numberStatus; $i < count($status); $i++)
                                                <option value="{{ $status[$numberStatus] }}">
                                                    {{ $status[$numberStatus] }}
                                                </option>
                                                <?php
                                                $numberStatus = $numberStatus + 1;
                                                ?>
                                            @endfor
                                        @endif
                                    @endif
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-1" id="divApproval" hidden>
                                <label class="text-sm text-teal-700">Document Approval</label>
                                <div class="flex items-center">
                                    <label id="labelDocumentApproval"
                                        class="flex text-sm text-teal-700 border border-teal-700 rounded-lg px-2 w-40">0
                                        images selected</label>
                                    <button class="btn-sale" id="btnApproval" onclick="btnApprovalEvent()"
                                        type="button">
                                        <span class="text-sm mx-2">Add/view</span>
                                    </button>
                                </div>
                                @error('document_approval')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-1" id="divDescription" hidden>
                                <label class="text-sm text-teal-700">Keterangan</label>
                                <textarea
                                    class="flex w-80 text-sm text-left font-semibold text-teal-900 border rounded-lg p-2 outline-none
                                @error('description') is-invalid @enderror"
                                    id="description" name="description" rows="4" cols="">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-1">
                                <button id="btnSaveProgress"
                                    class="hidden justify-center items-center mx-1 btn-primary mb-2"
                                    title="Update Progress" type="submit">
                                    <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                    </svg>
                                    <span class="ml-2 text-white">Save Progress</span>
                                </button>
                            </div>
                            <!-- Add / view Approval start -->
                            <div id="modalApproval" name="modalApproval"
                                class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
                                <div>
                                    <div class="flex mt-10">
                                        <button id="btnApprovalSubmit"
                                            class="flex justify-center items-center mx-1 btn-primary mb-2" title="Submit"
                                            type="button">
                                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="ml-2 text-white">Submit</span>
                                        </button>
                                        <button id="btnApprovalClear"
                                            class="flex justify-center items-center mx-1 btn-danger mb-2" title="Cancel"
                                            type="button">
                                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z" />
                                            </svg>
                                            <span class="ml-2 text-white">Clear</span>
                                        </button>
                                        <div class="flex justify-end px-2 w-full">
                                            <button id="btnApprovalClose" class="flex" title="Close" type="button">
                                                <svg class="fill-gray-500 w-6 m-auto hover:fill-red-700"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
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
                                                        class="flex justify-center items-center w-44 btn-primary"
                                                        title="Chose Files" type="button"
                                                        onclick="document.getElementById('documentApproval').click()">
                                                        <svg class="fill-current w-[18px]"
                                                            xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                            clip-rule="evenodd" viewBox="0 0 24 24">
                                                            <path
                                                                d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                                        </svg>
                                                        <span class="ml-2">Chose Images</span>
                                                    </button>
                                                    <input class="hidden" id="documentApproval"
                                                        name="document_approval[]" type="file"
                                                        accept="image/png, image/jpg, image/jpeg"
                                                        onchange="previewAppovalImage()" multiple>
                                                </div>
                                                <div class="flex justify-center my-2 border-b-2 border-teal-700">
                                                    <label id="numberApprovalFile" class="text-sm text-teal-700">No
                                                        Files Chosen</label>
                                                </div>
                                                <figure
                                                    class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-teal-700"
                                                    id="approvalImg">

                                                </figure>
                                                <div class="relative m-auto w-[750px] h-max">
                                                    <div id="prevApprovalButton"
                                                        class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                                        <button
                                                            class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                                            type="button">
                                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                                fill-rule="evenodd" clip-rule="evenodd"
                                                                viewBox="0 0 24 24">
                                                                <path
                                                                    d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div id="nextApprovalButton"
                                                        class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                                        <button type="button"
                                                            class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer">
                                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                                fill-rule="evenodd" clip-rule="evenodd"
                                                                viewBox="0 0 24 24">
                                                                <path
                                                                    d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div id="slidesApprovalPreview" class="mt-2">
                                                        {{-- <img class="approval-preview w-full" src="" alt="" hidden> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add / view Approval end -->
                        </form>
                    </div>
                </div>
                <!-- Show Quotatin start -->
                <div>
                    <div id="pdfPreview" class="w-[950px] h-[1345px] mt-2 bg-white">
                        <!-- Header start -->
                        <div class="h-28">
                            <div class="flex w-full justify-center items-center">
                                <img class="mt-3" src="/img/logo-vm.png" alt="">
                            </div>
                            <div class="flex w-full justify-center items-center mt-2">
                                <img src="/img/line-top.png" alt="">
                            </div>
                        </div>
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1125px]">
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-2">
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                        <label class="ml-1 text-sm text-black flex">: </label>
                                        <label
                                            class="ml-1 text-sm text-black flex">{{ $print_instal_quotation->number }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label class="ml-1 text-sm text-black flex">-</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label class="ml-1 text-sm text-black font-semibold flex">Penawaran
                                            Biaya Cetak dan Pasang Materi Iklan Billboard</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <div>
                                            <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                            <label
                                                class="ml-1 text-sm text-black flex font-semibold">{{ $print_instal_quotation->client->company }}</label>
                                            <div class="flex">
                                                <label id="clientPreviewContact"
                                                    class="ml-1 text-sm text-black flex font-semibold">{{ $print_instal_quotation->contact->name }}</label>
                                            </div>
                                            <label class="ml-1 text-sm text-black flex">Di -</label>
                                            <label class="ml-6 text-sm text-black flex">Tempat</label>
                                        </div>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label id="contactPreviewEmail"
                                            class="ml-1 text-sm text-black flex">{{ $print_instal_quotation->contact->email }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <label id="contactPreviewPhone"
                                            class="ml-1 text-sm text-black flex">{{ $print_instal_quotation->contact->phone }}</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>Bersama ini kami menyampaikan surat penawaran biaya cetak dan pasang materi billboard dengan spesifikasi sebagai berikut :</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- quotation table start -->
                            <div class="ml-2">
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <table id="billboardTable" class="table-fix mt-2 w-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-xs text-teal-700 border w-6" rowspan="2">No
                                                    </th>
                                                    <th class="text-xs text-teal-700 border w-16" rowspan="2">
                                                        Jenis</th>
                                                    <th class="text-xs text-teal-700 border" colspan="2">Lokasi
                                                    </th>
                                                    <th class="text-xs text-teal-700 border w-[300px]" colspan="4">
                                                        Deskripsi
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="text-xs text-teal-700 border w-20">Kode</th>
                                                    <th class="text-xs text-teal-700 border">Alamat</th>
                                                    <th class="text-xs text-teal-700 border w-28">Bahan</th>
                                                    <th class="text-xs text-teal-700 border w-8">Luas</th>
                                                    <th class="text-xs text-teal-700 border w-14">Harga</th>
                                                    <th class="text-xs text-teal-700 border w-[100px]">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="billboardsPreviewTBody">
                                                <?php
                                                $products = json_decode($print_instal_quotation->products);
                                                $subTotal = 0;
                                                // $number = 0;
                                                ?>
                                                @foreach ($products->quotationProducts as $product)
                                                    <tr>
                                                        {{-- @if ($number == 0)
                                                            <td class="text-xs text-teal-700 border text-center p-1">
                                                                {{ $number + 1 }}</td>
                                                        @else
                                                            <td class="text-xs text-teal-700 border text-center p-1">
                                                                {{ $number * 2 + 1 }}</td>
                                                        @endif --}}
                                                        <td class="text-xs text-teal-700 border text-center p-1"
                                                            rowspan="2">{{ $loop->iteration }}</td>
                                                        <td class="text-xs text-teal-700 border text-center p-1">
                                                            Cetak</td>
                                                        <td class="text-xs text-teal-700 border text-center p-1"
                                                            rowspan="2">
                                                            {{ $products->quotationProducts[$loop->iteration - 1]->billboard_code }}
                                                        </td>
                                                        <td class="text-xs text-teal-700 border p-1" rowspan="2">
                                                            {{ $products->quotationProducts[$loop->iteration - 1]->billboard_address }}
                                                        </td>
                                                        @if ($products->quotationProducts[$loop->iteration - 1]->print == true)
                                                            <td class="text-xs text-teal-700 border text-center">
                                                                {{ $products->quotationProducts[$loop->iteration - 1]->printProduct }}
                                                            </td>
                                                        @else
                                                            <td class="text-xs text-teal-700 border text-center">
                                                                Free</td>
                                                        @endif

                                                        <td class="text-xs text-teal-700 border text-center p-1"
                                                            rowspan="2">
                                                            {{ $products->quotationProducts[$loop->iteration - 1]->wide }}
                                                        </td>
                                                        @if ($products->quotationProducts[$loop->iteration - 1]->print == true)
                                                            <td class="text-xs text-teal-700 border text-center">
                                                                {{ number_format($products->quotationProducts[$loop->iteration - 1]->print_price) }}
                                                            </td>
                                                            <td class="text-xs text-teal-700 border text-right p-1">
                                                                {{ number_format($products->quotationProducts[$loop->iteration - 1]->print_price * $products->quotationProducts[$loop->iteration - 1]->wide) }}
                                                            </td>
                                                        @else
                                                            <td class="text-xs text-teal-700 border text-center">
                                                                Free</td>
                                                            <td class="text-xs text-teal-700 border text-right p-1">
                                                                Free ke
                                                                {{ $products->quotationProducts[$loop->iteration - 1]->used_print + 1 }}
                                                                dari
                                                                {{ $products->quotationProducts[$loop->iteration - 1]->free_print }}
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        {{-- @if ($number == 0)
                                                            <td class="text-xs text-teal-700 border text-center p-1">
                                                                {{ $number + 2 }}</td>
                                                        @else
                                                            <td class="text-xs text-teal-700 border text-center p-1">
                                                                {{ $number * 2 + 2 }}</td>
                                                        @endif --}}
                                                        <td class="text-xs text-teal-700 border text-center p-1">
                                                            Pasang</td>
                                                        <td class="text-xs text-teal-700 border text-center">
                                                            {{ $products->quotationProducts[$loop->iteration - 1]->installProduct }}
                                                        </td>
                                                        @if ($products->quotationProducts[$loop->iteration - 1]->install == true)
                                                            <td class="text-xs text-teal-700 border text-center">
                                                                {{ number_format($products->quotationProducts[$loop->iteration - 1]->install_price) }}
                                                            </td>
                                                            <td class="text-xs text-teal-700 border text-right p-1">
                                                                {{ number_format($products->quotationProducts[$loop->iteration - 1]->install_price * $products->quotationProducts[$loop->iteration - 1]->wide) }}
                                                            </td>
                                                        @else
                                                            <td class="text-xs text-teal-700 border text-center">
                                                                Free</td>
                                                            <td class="text-xs text-teal-700 border text-right p-1">
                                                                Free ke
                                                                {{ $products->quotationProducts[$loop->iteration - 1]->used_install + 1 }}
                                                                dari
                                                                {{ $products->quotationProducts[$loop->iteration - 1]->free_install }}
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    <?php
                                                    $subTotal = $subTotal + ($products->quotationProducts[$loop->iteration - 1]->print_price * $products->quotationProducts[$loop->iteration - 1]->wide + $products->quotationProducts[$loop->iteration - 1]->install_price * $products->quotationProducts[$loop->iteration - 1]->wide);
                                                    $ppn = ($subTotal * 11) / 100;
                                                    // $number++;
                                                    ?>
                                                @endforeach
                                                <tr>
                                                    <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                        colspan="7">Sub Total</td>
                                                    <td id="subTotalPreview"
                                                        class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                                        {{ number_format($subTotal) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                        colspan="7">PPN 11%</td>
                                                    <td id="ppnValuePreview"
                                                        class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                                        {{ number_format($ppn) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                        colspan="7">Grand Total</td>
                                                    <td id="grandTotalPreview"
                                                        class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                                        {{ number_format($subTotal + $ppn) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- quotation table end -->

                            <!-- quotation note start -->
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-2">
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                    </div>
                                    <div id="notesPreview">
                                        @foreach ($products->quotationProducts[0]->notes as $note)
                                            <div class="flex">
                                                <label class="ml-1 text-sm">-</label>
                                                <textarea class="text-area-notes" rows="1" readonly>{{ $note }}</textarea>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- quotation note end -->

                            <div class="flex justify-center">
                                <div class="flex mt-2">
                                    <textarea class="ml-1 w-[721px] outline-none text-sm" rows="1" readonly>Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-4">
                                    <label class="ml-1 text-sm text-black flex">Denpasar, {{ date('j') }}
                                        {{ $bulan[(int) date('m')] }} {{ date('Y') }}</label>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-[250px]">
                                    <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista
                                        Media</label>
                                    <label class="ml-1 my-2 text-xs text-slate-300 flex">Ditandatangani secara
                                        elektronik
                                        oleh
                                        :</label>
                                    <label id="salesUser"
                                        class="ml-1 text-sm text-black flex font-semibold">{{ $print_instal_quotation->user->name }}</label>
                                    <label id="salesPotition"
                                        class="ml-1 text-sm text-black flex">{{ $print_instal_quotation->user->level }}</label>
                                </div>
                                <div class="w-[475px]">
                                    <div>
                                        {{ QrCode::size(100)->generate('https://www.vistamedia.co.id/dashboard/marketing/print-instal-quotations/preview/' . $print_instal_quotation->id) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Body end -->
                        <!-- Footer start -->
                        <div class="flex items-end justify-center">
                            <div>
                                <div class="flex w-full h-max justify-center mt-2">
                                    <img src="/img/line-bottom.png" alt="">
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-sm font-semibold">PT. Vista Media</span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali -
                                        Indonesia</span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">e-mail : info@vistamedia.co.id |
                                        www.vistamedia.co.id</span>
                                </div>
                            </div>
                        </div>
                        <!-- Footer end -->
                    </div>
                    <?php
                    $number = Str::substr($print_instal_quotation->number, 0, 4);
                    ?>
                    <input type="text" id="saveName"
                        value="{{ $number }} - Cetak & Pasang - {{ $print_instal_quotation->client->name }}"
                        hidden>
                </div>
                <!-- Show Quotatin end -->
            </div>
            <div class="h-10"></div>
        </div>
    </div>
    <!-- Show Quotatin end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        // Create PDF --> start
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
            html2pdf().set(opt).from(element).save();
        };
        // Create PDF --> end

        //Update progress --> start
        const cbUpdate = document.getElementById("cbUpdate");
        const divStatus = document.getElementById("divStatus");
        const divDescription = document.getElementById("divDescription");
        const btnSaveProgress = document.getElementById("btnSaveProgress");
        const cbUpdateValue = document.getElementById("cbUpdateValue");
        const status = document.getElementById("status");
        const divApproval = document.getElementById("divApproval");
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

        statusChange = (sel) => {
            if (sel.value == "Deal") {
                divApproval.removeAttribute("hidden");
            } else {
                divApproval.setAttribute("hidden", "hidden");
            }
        }

        if (Boolean(cbUpdateValue.value) == true) {
            console.log(cbUpdateValue.value);
            cbUpdate.checked = true;
            divStatus.removeAttribute("hidden");
            divApproval.removeAttribute("hidden");
            divDescription.removeAttribute("hidden");
            btnSaveProgress.classList.remove("hidden");
            btnSaveProgress.classList.add("flex");
        } else {
            divStatus.setAttribute("hidden", "hidden");
            divApproval.setAttribute("hidden", "hidden");
            divDescription.setAttribute("hidden", "hidden");
            btnSaveProgress.classList.add("hidden");
            btnSaveProgress.classList.remove("flex");
            cbUpdate.checked = false;
        }

        cbUpdate.addEventListener('click', function() {
            if (cbUpdate.checked == true) {
                divStatus.removeAttribute("hidden");
                divDescription.removeAttribute("hidden");
                btnSaveProgress.classList.remove("hidden");
                btnSaveProgress.classList.add("flex");
                cbUpdateValue.value = true;
            } else {
                divStatus.setAttribute("hidden", "hidden");
                divDescription.setAttribute("hidden", "hidden");
                btnSaveProgress.classList.add("hidden");
                btnSaveProgress.classList.remove("flex");
                cbUpdateValue.value = false;
            }
        });
        //Update progress --> end

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
    </script>
    <!-- Script end -->
@endsection
