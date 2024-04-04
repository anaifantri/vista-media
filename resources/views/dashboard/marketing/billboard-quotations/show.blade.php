@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quotatin start -->
    <div class="flex justify-center">
        <div class="mt-10">
            <!-- Title Show Quotatin start -->
            <div class="flex border-b">
                <h1 class="text-xl text-cyan-800 font-bold tracking-wider">DETAIL PENAWAWARAN</h1>
            </div>
            <!-- Title Show Quotatin end -->
            <div class="flex">
                <div class="flex justify-center">
                    <div class="flex mx-1">
                        <div class="">
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Nomor</label>
                                    <label
                                        class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1">{{ $billboard_quotation->number }}</label>
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Nama Klien</label>
                                    <label
                                        class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1">{{ $billboard_quotation->client->name }}</label>
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Nama Perusahaan</label>
                                    <label
                                        class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1">{{ $billboard_quotation->client->company }}</label>
                                </div>
                            </div>
                            <div class="flex mt-1">
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kontak Person</label>
                                    <label
                                        class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1">{{ $billboard_quotation->contact->name }}</label>
                                </div>
                            </div>
                            <div class="mt-1">
                                <div class="mt-1">
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Progres Penawaran</label>
                                </div>
                                <div class="mt-1 w-80 h-max border rounded-md py-1 px-2">
                                    @foreach ($billboard_quotation->billboard_quot_statuses as $quotStatus)
                                        <div class="flex w-28 border-b">
                                            <label
                                                class="flex text-sm font-semibold text-teal-900">{{ $quotStatus->status }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="flex w-28 text-sm font-semibold text-teal-900">Tanggal</label>
                                            <label class="flex w-2 text-sm font-semibold text-teal-900">: </label>
                                            <label
                                                class="flex ml-2 w-44 text-sm font-semibold text-teal-900">{{ date('d F Y', strtotime($quotStatus->created_at)) }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="flex w-28 text-sm font-semibold text-teal-900">Oleh</label>
                                            <label class="flex w-2 text-sm font-semibold text-teal-900">: </label>
                                            <label class="flex ml-2 w-44 text-sm font-semibold text-teal-900">
                                                {{ $quotStatus->user->name }}</label>
                                        </div>
                                        <div class="flex mb-3 border-b">
                                            <label class="flex w-28 text-sm font-semibold text-teal-900">Keterangan</label>
                                            <label class="flex w-2 text-sm font-semibold text-teal-900">: </label>
                                            <label class="flex ml-2 w-44 text-sm font-semibold text-teal-900">
                                                {{ $quotStatus->description }}</label>
                                        </div>
                                    @endforeach
                                    @if (count($billboard_quotation->billboard_quot_revisions) != 0)
                                        <div class="mt-1">
                                            <label class="text-sm font-semibold text-teal-900 border-b">Daftar
                                                Revisi</label>
                                            @foreach ($billboard_quotation->billboard_quot_revisions as $billboard_quot_revision)
                                                <a class="flex"
                                                    href="/dashboard/marketing/billboard-quot-revisions/{{ $billboard_quot_revision->id }}">
                                                    <span
                                                        class="text-teal-900 hover:text-emerald-500 text-sm font-semibold">{{ $loop->iteration }}.
                                                        {{ $billboard_quot_revision->number }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="mt-1" hidden>
                                            <label class="text-sm font-semibold text-teal-900 border-b">Daftar
                                                Revisi</label>
                                            <label class="flex text-sm xl:text-md 2xl:text-lg text-teal-700">-</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if (session()->has('success'))
                                <div class="flex alert-success">
                                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                                    </svg>
                                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                                </div>
                            @endif
                            <form class="" action="/dashboard/marketing/billboard-quot-statuses" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input class="@error('billboard_quot_revision_id') is-invalid @enderror"
                                    id="billboard_quot_revision_id" name="billboard_quot_revision_id" type="text"
                                    value="" hidden>
                                <input class="@error('billboard_quotation_id') is-invalid @enderror"
                                    id="billboard_quotation_id" name="billboard_quotation_id" type="text"
                                    value="{{ $billboard_quotation->id }}" hidden>
                                <?php
                                $numberStatus = 0;
                                $lastStatus = $billboard_quotation->billboard_quot_statuses[count($billboard_quotation->billboard_quot_statuses) - 1]->status;
                                $followUp = false;
                                $status = ['Created', 'Sent', 'Follow Up', 'Deal', 'Closed'];
                                ?>
                                @if ($lastStatus == 'Deal' || $lastStatus == 'Closed' || count($billboard_quotation->billboard_quot_revisions) != 0)
                                    <div class="mt-1" hidden>
                                        <input type="checkbox" id="cbUpdateProgress" name="cbUpdateProgress">
                                        <input type="text" id="cbUpdateValue" name="cb-update-value"
                                            value="{{ old('cb-update-value') }}" hidden>
                                        <label class="text-sm font-semibold text-teal-900" for="cbUpdateProgress">
                                            Update
                                            Progress</label>
                                    </div>
                                @else
                                    <div class="mt-1">
                                        <input type="checkbox" id="cbUpdateProgress" name="cbUpdateProgress">
                                        <input type="text" id="cbUpdateValue" name="cb-update-value"
                                            value="{{ old('cb-update-value') }}" hidden>
                                        <label class="text-sm font-semibold text-teal-900" for="cbUpdateProgress">
                                            Update
                                            Progress</label>
                                    </div>
                                @endif
                                {{-- <div class="mt-1" hidden>
                                    <input type="checkbox" id="cbUpdateProgress" name="cbUpdateProgress">
                                    <label class="text-sm font-semibold text-teal-900" for="cbUpdateProgress"> Update
                                        Progress</label>
                                </div> --}}
                                <div class="mt-1" id="divStatus" hidden>
                                    <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Status</label>
                                    <select id="status" name="status"
                                        class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg
                                font-semibold text-teal-900 border rounded-lg p-1 outline-none
                                @error('status') is-invalid @enderror"
                                        type="text" value="{{ old('status') }}">
                                        @if (old('status') == 'Deal')
                                            @foreach ($billboard_quotation->billboard_quot_statuses as $quotStatus)
                                                @if ($quotStatus->status == 'Follow Up')
                                                    <?php
                                                    $followUp = true;
                                                    ?>
                                                @else
                                                    <?php
                                                    $followUp = false;
                                                    ?>
                                                @endif
                                                @if ($followUp != true)
                                                    @if ($quotStatus->status != $status[$loop->iteration - 1])
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
                                            @foreach ($billboard_quotation->billboard_quot_statuses as $quotStatus)
                                                @if ($quotStatus->status == 'Follow Up')
                                                    <?php
                                                    $followUp = true;
                                                    ?>
                                                @else
                                                    <?php
                                                    $followUp = false;
                                                    ?>
                                                @endif
                                                @if ($followUp != true)
                                                    @if ($quotStatus->status != $status[$loop->iteration - 1])
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
                                        <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                        </svg>
                                        <span class="ml-2 text-white">Save Progress</span>
                                    </button>
                                </div>
                                <!-- Add / view Approval start -->
                                <div id="modalApproval" name="modalApproval"
                                    class="absolute justify-center top-0 w-[1100px] h-full bg-black bg-opacity-90 z-50 hidden">
                                    <div>
                                        <div class="flex mt-10">
                                            <button id="btnApprovalSubmit"
                                                class="flex justify-center items-center mx-1 btn-primary mb-2"
                                                title="Submit" type="button">
                                                <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24">
                                                    <path
                                                        d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                                <span class="ml-2 text-white">Submit</span>
                                            </button>
                                            <button id="btnApprovalCancel"
                                                class="flex justify-center items-center mx-1 btn-danger mb-2"
                                                title="Cancel" type="button">
                                                <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                                </svg>
                                                <span class="ml-2 text-white">Cancel</span>
                                            </button>
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
                                                                class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-black bg-opacity-0 hover:bg-opacity-50 transition duration-500 ease-in-out cursor-pointer"
                                                                type="button">
                                                                <svg class="fill-white w-5"
                                                                    xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div id="nextApprovalButton"
                                                            class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                                            <button type="button"
                                                                class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-black bg-opacity-0 hover:bg-opacity-50 transition duration-500 ease-in-out cursor-pointer">
                                                                <svg class="fill-white w-5"
                                                                    xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                                                    clip-rule="evenodd" viewBox="0 0 24 24">
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
                            <div class="flex justify-start mt-5">
                                <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-success"
                                    href="/dashboard/marketing/billboard-quotations">
                                    <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1" clip-rule="evenodd"
                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.012 2c5.518 0 9.997 4.48 9.997 9.998 0 5.517-4.479 9.997-9.997 9.997s-9.998-4.48-9.998-9.997c0-5.518 4.48-9.998 9.998-9.998zm-1.523 6.21s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Back</span>
                                </a>
                                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2"
                                    title="Create PDF" type="button">
                                    <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M12.819 14.427c.064.267.077.679-.021.948-.128.351-.381.528-.754.528h-.637v-2.12h.496c.474 0 .803.173.916.644zm3.091-8.65c2.047-.479 4.805.279 6.09 1.179-1.494-1.997-5.23-5.708-7.432-6.882 1.157 1.168 1.563 4.235 1.342 5.703zm-7.457 7.955h-.546v.943h.546c.235 0 .467-.027.576-.227.067-.123.067-.366 0-.489-.109-.198-.341-.227-.576-.227zm13.547-2.732v13h-20v-24h8.409c4.858 0 3.334 8 3.334 8 3.011-.745 8.257-.42 8.257 3zm-12.108 2.761c-.16-.484-.606-.761-1.224-.761h-1.668v3.686h.907v-1.277h.761c.619 0 1.064-.277 1.224-.763.094-.292.094-.597 0-.885zm3.407-.303c-.297-.299-.711-.458-1.199-.458h-1.599v3.686h1.599c.537 0 .961-.181 1.262-.535.554-.659.586-2.035-.063-2.693zm3.701-.458h-2.628v3.686h.907v-1.472h1.49v-.732h-1.49v-.698h1.721v-.784z" />
                                    </svg>
                                    <span class="ml-2 text-white">Create PDF</span>
                                </button>
                                @if (count($billboard_quotation->billboard_quot_revisions) == 0)
                                    @if ($lastStatus != 'Deal' && $lastStatus != 'Closed')
                                        <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-warning"
                                            href="/dashboard/marketing/quotation-revisions/revision/{{ $billboard_quotation->id }}">
                                            <svg class="fill-current w-4 lg:w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Revisi</span>
                                        </a>
                                    @else
                                        <a class="hidden justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-warning"
                                            href="/dashboard/marketing/quotation-revisions/revision/{{ $billboard_quotation->id }}">
                                            <svg class="hidden fill-current w-4 lg:w-5" clip-rule="evenodd"
                                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Revisi</span>
                                        </a>
                                    @endif
                                @else
                                    @foreach ($billboard_quot_status as $status)
                                        @if (
                                            $status->billboard_quot_revision_id ==
                                                $billboard_quotation->billboard_quot_revisions[count($billboard_quotation->billboard_quot_revisions) - 1]->id)
                                            <?php
                                            $lastStatus = '';
                                            $lastStatus = $status->status;
                                            ?>
                                        @endif
                                    @endforeach
                                    @if ($lastStatus != 'Deal' && $lastStatus != 'Closed')
                                        <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-warning"
                                            href="/dashboard/marketing/quotation-revisions/revision/{{ $billboard_quotation->id }}">
                                            <svg class="fill-current w-4 lg:w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Revisi</span>
                                        </a>
                                    @else
                                        <a class="hidden justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-warning"
                                            href="/dashboard/marketing/quotation-revisions/revision/{{ $billboard_quotation->id }}">
                                            <svg class="hidden fill-current w-4 lg:w-5" clip-rule="evenodd"
                                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Revisi</span>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div id="pdfPreview" class="w-[780px] max-h-max">
                        <!-- Header start -->
                        <div class="w-[780px] h-[1100px] mt-2 bg-white">
                            <div class="h-24 mt-4">
                                <div class="flex w-full justify-center items-center">
                                    <img class="mt-3" src="/img/logo-vm.png" alt="">
                                </div>
                                <div class="flex w-full justify-center items-center mt-2">
                                    <img src="/img/line-top.png" alt="">
                                </div>
                            </div>
                            <!-- Header end -->
                            <!-- Body start -->
                            <div class="h-[900px]">
                                <div class="flex justify-center">
                                    <div class="w-[650px] mt-4">
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                            <label class="ml-1 text-sm text-black flex">:</label>
                                            <label id="quotationNumberBBPreview"
                                                class="ml-1 text-sm text-black flex">{{ $billboard_quotation->number }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                            <label class="ml-1 text-sm text-black flex">:</label>
                                            <label id="attachmentBBPreview"
                                                class="ml-1 text-sm text-black flex">{{ $billboard_quotation->attachment }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                            <label class="ml-1 text-sm text-black flex">:</label>
                                            <label id="subjectBBPreview"
                                                class="ml-1 text-sm text-black flex">{{ $billboard_quotation->subject }}</label>
                                        </div>
                                        <div class="flex mt-4">
                                            <div>
                                                <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                                <label id="clientBBPreview"
                                                    class="ml-1 text-sm text-black flex font-semibold">{{ $billboard_quotation->client->company }}</label>
                                                <label id="contactBBPreview"
                                                    class="ml-1 text-sm text-black flex font-semibold">UP.
                                                    {{ $billboard_quotation->contact->name }}</label>
                                                <label class="ml-1 text-sm text-black flex">Di -</label>
                                                <label class="ml-6 text-sm text-black flex">Tempat</label>
                                            </div>
                                        </div>
                                        <div class="flex mt-4">
                                            <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                            <label class="ml-1 text-sm text-black flex">:</label>
                                            <label id="contactEmailBBPreview"
                                                class="ml-1 text-sm text-black flex">{{ $billboard_quotation->contact->email }}</label>
                                        </div>
                                        <div class="flex">
                                            <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                            <label class="ml-1 text-sm text-black flex">:</label>
                                            <label id="contactPhoneBBPreview"
                                                class="ml-1 text-sm text-black flex">{{ $billboard_quotation->contact->phone }}</label>
                                        </div>
                                        <div class="flex mt-4">
                                            <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                                        </div>
                                        <div class="flex mt-2">
                                            <label id="letterBodyBBPreview"
                                                class="ml-1 w-[650px] h-max text-sm text-black flex">{{ $billboard_quotation->body_top }}</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Billboard Location Table Preview start -->
                                <div id="" class="ml-2">
                                    <div class="flex justify-center">
                                        <div id="tableWidth" class="w-[650px]">
                                            <table id="" class="table-fix mt-2 w-full">
                                                <thead>
                                                    <tr>
                                                        <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">
                                                            No
                                                        </th>
                                                        <th class="text-[0.7rem] text-teal-700 border w-16"
                                                            rowspan="2">
                                                            Kode
                                                        </th>
                                                        <th class="text-[0.7rem] text-teal-700 border w-48"
                                                            rowspan="2">
                                                            Lokasi
                                                        </th>
                                                        <th class="text-[0.7rem] text-teal-700 border w-28"
                                                            colspan="3">
                                                            Deskripsi
                                                        </th>
                                                        <th class="text-[0.7rem] text-teal-700 border w-20"
                                                            colspan="5">
                                                            Harga
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-[0.7rem] text-teal-700 border w-6">Jenis</th>
                                                        <th class="text-[0.7rem] text-teal-700 border w-6">BL/FL</th>
                                                        <th class="text-[0.7rem] text-teal-700 border w-16">Size - V/H
                                                        </th>
                                                        <?php
                                                        $objLocations = json_decode($billboard_quotation->billboards);
                                                        ?>
                                                        @if ($objLocations->locations[0]->price->periodeMonth->cbPeriode == true)
                                                            <th class="text-[0.7rem] text-teal-700 border w-20">
                                                                {{ $objLocations->locations[0]->price->periodeMonth->periode }}
                                                            </th>
                                                        @endif
                                                        @if ($objLocations->locations[0]->price->periodeQuarter->cbPeriode == true)
                                                            <th class="text-[0.7rem] text-teal-700 border w-20">
                                                                {{ $objLocations->locations[0]->price->periodeQuarter->periode }}
                                                            </th>
                                                        @endif
                                                        @if ($objLocations->locations[0]->price->periodeHalf->cbPeriode == true)
                                                            <th class="text-[0.7rem] text-teal-700 border w-20">
                                                                {{ $objLocations->locations[0]->price->periodeHalf->periode }}
                                                            </th>
                                                        @endif
                                                        @if ($objLocations->locations[0]->price->periodeYear->cbPeriode == true)
                                                            <th class="text-[0.7rem] text-teal-700 border w-20">
                                                                {{ $objLocations->locations[0]->price->periodeYear->periode }}
                                                            </th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody id="previewBBTBody">
                                                    <?php
                                                    $objLocations = json_decode($billboard_quotation->billboards);
                                                    ?>
                                                    @foreach ($objLocations->locations as $location)
                                                        <tr>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{ $location->code }} - {{ $location->city }}
                                                            </td>
                                                            <td class="text-[0.7rem] text-teal-700 border">
                                                                {{ $location->address }}
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                @if ($location->category == 'Billboard')
                                                                    BB
                                                                @elseif ($location->category == 'Bando')
                                                                    BD
                                                                @elseif ($location->category == 'Baliho')
                                                                    BLH
                                                                @elseif ($location->category == 'Midiboard')
                                                                    MB
                                                                @endif
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                @if ($location->lighting == 'Frontlight')
                                                                    FL
                                                                @elseif ($location->lighting == 'Backlight')
                                                                    BL
                                                                @endif
                                                            </td>
                                                            <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                {{ $location->size }} -
                                                                @if ($location->orientation == 'Horizontal')
                                                                    H
                                                                @elseif ($location->orientation == 'Vertikal')
                                                                    V
                                                                @endif
                                                            </td>
                                                            @if ($location->price->periodeMonth->cbPeriode == true)
                                                                <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                    Rp.
                                                                    {{ number_format($location->price->periodeMonth->priceMonth) }},-
                                                                </td>
                                                            @endif
                                                            @if ($location->price->periodeQuarter->cbPeriode == true)
                                                                <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                    Rp.
                                                                    {{ number_format($location->price->periodeQuarter->priceQuarter) }},-
                                                                </td>
                                                            @endif
                                                            @if ($location->price->periodeHalf->cbPeriode == true)
                                                                <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                    Rp.
                                                                    {{ number_format($location->price->periodeHalf->priceHalf) }},-
                                                                </td>
                                                            @endif
                                                            @if ($location->price->periodeYear->cbPeriode == true)
                                                                <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                    Rp.
                                                                    {{ number_format($location->price->periodeYear->priceYear) }},-
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Billboard Location Table Preview end -->

                                <!-- billboard note start -->
                                <div class="flex justify-center">
                                    <div id="previewBBNote" class="w-[650px] mt-2">
                                        <div class="flex">
                                            <label class="ml-1 text-[0.7rem] text-black flex w-20">Catatan</label>
                                            <label class="ml-1 text-[0.7rem] text-black flex">:</label>
                                        </div>
                                        <?php
                                        $objNotes = json_decode($billboard_quotation->note);
                                        $payment = $objNotes->notes[6];
                                        ?>
                                        @foreach ($objNotes->notes as $note)
                                            @if ($loop->iteration != 7)
                                                @if ($loop->iteration == 3 || $loop->iteration == 4 || $loop->iteration == 5)
                                                    @if ($note->cbNote == 'true')
                                                        <div>
                                                            <div class="flex">
                                                                <label
                                                                    class="ml-4 text-[0.7rem] text-black w-full">{{ $note->textNote }}</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    @if ($note->cbNote == 'true')
                                                        <div>
                                                            <div class="flex">
                                                                <label
                                                                    class="ml-1 text-[0.7rem] text-black flex">{{ $note->labelNote }}</label>
                                                                <label
                                                                    class="ml-2 text-[0.7rem] text-black w-full">{{ $note->textNote }}</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @else
                                                @foreach ($payment as $term)
                                                    <div>
                                                        <div class="flex">
                                                            <label class="ml-4 text-[0.7rem] text-black flex">•
                                                                {{ $payment[$loop->iteration - 1]->termValue }} %
                                                                {{ $payment[$loop->iteration - 1]->termNote }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <!-- billboard note end -->

                                <div class="flex justify-center">
                                    <div class="flex mt-2 w-[650px]">
                                        <label
                                            class="ml-1 w-[650px] h-max text-sm text-black flex">{{ $billboard_quotation->body_end }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <?php
                                    $quotationDate = date('d F Y');
                                    ?>
                                    <div class="w-[650px] mt-2">
                                        <label class="ml-1 text-sm text-black flex">Denpasar,
                                            {{ date('d F Y', strtotime($billboard_quotation->created_at)) }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[250px]">
                                        <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
                                        <label class="ml-1 my-2 text-xs text-slate-300 flex">Ditandatangani secara
                                            elektronik
                                            oleh
                                            :</label>
                                        <label id="salesUser"
                                            class="ml-1 text-sm text-black flex font-semibold">{{ $billboard_quotation->user->name }}</label>
                                        <label id="salesPotition"
                                            class="ml-1 text-sm text-black flex">{{ $billboard_quotation->user->level }}</label>
                                    </div>
                                    <div class="w-[400px]">
                                        <div>
                                            {{ QrCode::size(100)->generate('https://www.vistamedia.co.id/dashboard/marketing/billboard-quotations/' . $billboard_quotation->id) }}
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
                                        <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia</span>
                                    </div>
                                    <div class="flex items-center w-full justify-center">
                                        <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                                    </div>
                                    <div class="flex items-center w-full justify-center">
                                        <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Footer end -->
                        <?php
                        $objLocations = json_decode($billboard_quotation->billboards);
                        ?>
                        @foreach ($objLocations->locations as $location)
                            <div id="preview" name="preview" class="ml-2 w-[780px] h-[1100px] bg-white mt-2">
                                <div class="flex w-full justify-center items-center">
                                    <img class="mt-3" src="/img/logo-vm.png" alt="">
                                </div>
                                <div class="flex w-full justify-center items-center mt-2">
                                    <img src="/img/line-top.png" alt="">
                                </div>
                                <div class="flex w-full h-[44px] justify-center items-center mt-1">
                                    <div
                                        class="flex w-[700px] h-[44px] justify-start items-center bg-slate-50 border rounded-t-xl">
                                        <span
                                            class="flex justify-end items-center w-20 h-[36px] text-lg text-red-700 font-bold">{{ $location->code }}</span>
                                        <span class="flex justify-start items-center w-24 h-[36px] text-lg font-bold ml-1">
                                            -
                                            {{ $location->city }}
                                        </span>
                                        <img class="h-10" src="/img/code-line.png" alt="">
                                        <span
                                            class="flex items-center w-[575px] h-[36px] text-base font-semibold">{{ $location->address }}</span>
                                    </div>
                                </div>
                                <div class="flex w-full h-[465px] justify-center mt-[1px]">
                                    <div
                                        class="flex w-[700px] h-[465px] justify-center items-center bg-slate-50 border rounded-b-xl">
                                        <img class="m-auto w-[670px] h-[435px]"
                                            src="{{ asset('storage/' . $location->photo) }}" alt="">
                                    </div>
                                </div>
                                <div class="flex w-full h-[385px] justify-center mt-1">
                                    <div class="flex w-[700px] h-[385px] bg-white">
                                        <div class="flex w-[476px] h-[385px] bg-white justify-center">
                                            <div class="">
                                                <div
                                                    class="flex w-[476px] h-7 bg-slate-50 items-center border justify-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                    Google Maps
                                                    Koordinat :
                                                    {{ number_format($location->lat, 7) . ', ' . number_format($location->lng, 7) }}
                                                </div>
                                                <div class="flex relative w-[476px] h-[355px] mt-[1px] rounded-b-lg">
                                                    <div class="flex absolute w-[100px] mt-[250px] ml-1">
                                                        {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $location->lat . ',' . $location->lng . '/@' . $location->lat . ',' . $location->lng . ',15z') }}
                                                    </div>
                                                    <?php
                                                    $src = 'https://maps.googleapis.com/maps/api/staticmap?center=' . $location->lat . ',' . $location->lng . '&zoom=15&size=480x355&maptype=terrain&markers=icon:https://vistamedia.co.id/img/marker-red.png%7C' . $location->lat . ',' . $location->lng . '&key=AIzaSyCZT6TYRimJY8YoPn0cABAdGnbVLGVusWg';
                                                    ?>
                                                    <img class="w-[476px] h-[355px] border rounded-b-xl" id="myImage"
                                                        name="myImage" src="{{ $src }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex w-[220px] h-[385px] bg-white justify-center ml-1">
                                            <div class="">
                                                <div
                                                    class="flex p-1 items-center justify-center w-[220px] h-7 bg-slate-50 border rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                    Deskripsi Billboard
                                                </div>
                                                <div class="w-[220px] h-[92px] bg-slate-50 mt-[1px] rounded-b-lg border">
                                                    <div class="flex mt-1">
                                                        <span
                                                            class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Jenis</span>
                                                        <span
                                                            class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                            {{ $location->category }}
                                                        </span>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <span
                                                            class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Ukuran</span>
                                                        <span
                                                            class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                            {{ $location->size }}
                                                            sisi</span>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <span
                                                            class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Orientasi</span>
                                                        <span
                                                            class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                            {{ $location->orientation }}
                                                        </span>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <span
                                                            class="w-[80px] text-xs font-sans font-bold tracking-wide text-teal-900 ml-2">Penerangan</span>
                                                        <span
                                                            class="w-[140px] text-xs font-sans font-bold tracking-wide text-teal-900">:
                                                            {{ $location->lighting }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex w-[220px] h-7 p-1 bg-slate-50 mt-[1px] border justify-center items-center rounded-t-lg text-sm font-bold font-mono text-teal-900">
                                                    Informasi Area
                                                </div>
                                                <div
                                                    class="flex w-[220px] h-[234px] border bg-slate-50 mt-[1px] rounded-b-lg">
                                                    <div>
                                                        <div class="flex">
                                                            <span
                                                                class="w-[100px] text-xs font-mono text-teal-900 ml-2">Type
                                                                Jalan</span>
                                                            <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                                {{ $location->road }}
                                                            </span>
                                                        </div>
                                                        <div class="flex">
                                                            <span
                                                                class="w-[100px] text-xs font-mono text-teal-900 ml-2">Jarak
                                                                Pandang</span>
                                                            <span class="w-[120px] text-xs font-mono text-teal-900">:
                                                                {{ $location->distance }}
                                                            </span>
                                                        </div>
                                                        <div class="flex">
                                                            <span
                                                                class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kecepatan
                                                                Kend.</span>
                                                            <span
                                                                class="w-[120px] text-xs font-mono font-thin text-teal-900">:
                                                                {{ $location->speed }}
                                                            </span>
                                                        </div>
                                                        <div class="flex">
                                                            <span
                                                                class="w-[100px] text-xs font-mono font-thin text-teal-900 ml-2">Kawasan
                                                                <br><br><br><br><br>
                                                                {{ QrCode::size(100)->generate('https://vistamedia.co.id/preview/' . $location->id) }}
                                                            </span>
                                                            <span
                                                                class="flex w-[120px] text-xs font-mono font-thin text-teal-900">
                                                                <div>:</div>

                                                                <?php
                                                                $data = $location->sector;
                                                                $sectors = explode('-', $data);
                                                                ?>
                                                                <div>
                                                                    @foreach ($sectors as $key => $sector)
                                                                        @if ($sector != end($sectors))
                                                                            <div>
                                                                                - {{ $sector }}
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex
                                w-full h-max justify-center mt-1">
                                    <img src="/img/line-bottom.png" alt="">
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-sm font-semibold">PT. Vista Media</span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia</span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
                                </div>
                            </div>
                        @endforeach
                        <!-- Footer end -->
                    </div>
                    <div class="h-10"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Show Quotatin end -->

    <!-- Script start -->
    <script src="/js/showbillboardquotation.js"></script>
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>
    <!-- Script end -->
@endsection
