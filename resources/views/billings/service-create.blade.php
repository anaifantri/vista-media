@extends('dashboard.layouts.main');

@section('container')
    @php
        $huruf = [
            '',
            'Satu',
            'Dua',
            'Tiga',
            'Empat',
            'Lima',
            'Enam',
            'Tujuh',
            'Delapan',
            'Sembilan',
            'Sepuluh',
            'Sebelas',
            'Duabelas',
            'Tigabelas',
            'Empatbelas',
            'Limabelas',
            'Enambelas',
            'Tujuhbelas',
            'Delapanbelas',
            'Sembilanbelas',
            'Duapuluh',
        ];
        function terbilang($nilai)
        {
            $huruf = [
                '',
                'Satu',
                'Dua',
                'Tiga',
                'Empat',
                'Lima',
                'Enam',
                'Tujuh',
                'Delapan',
                'Sembilan',
                'Sepuluh',
                'Sebelas',
            ];
            if ($nilai == 0) {
                return '';
            } elseif (($nilai < 12) & ($nilai != 0)) {
                return '' . $huruf[$nilai];
            } elseif ($nilai < 20) {
                return Terbilang($nilai - 10) . ' Belas ';
            } elseif ($nilai < 100) {
                return Terbilang($nilai / 10) . ' Puluh ' . Terbilang($nilai % 10);
            } elseif ($nilai < 200) {
                return ' Seratus ' . Terbilang($nilai - 100);
            } elseif ($nilai < 1000) {
                return Terbilang($nilai / 100) . ' Ratus ' . Terbilang($nilai % 100);
            } elseif ($nilai < 2000) {
                return ' Seribu ' . Terbilang($nilai - 1000);
            } elseif ($nilai < 1000000) {
                return Terbilang($nilai / 1000) . ' Ribu ' . Terbilang($nilai % 1000);
            } elseif ($nilai < 1000000000) {
                return Terbilang($nilai / 1000000) . ' Juta ' . Terbilang($nilai % 1000000);
            } elseif ($nilai < 1000000000000) {
                return Terbilang($nilai / 1000000000) . ' Milyar ' . Terbilang($nilai % 1000000000);
            } elseif ($nilai < 100000000000000) {
                return Terbilang($nilai / 1000000000000) . ' Trilyun ' . Terbilang($nilai % 1000000000000);
            } elseif ($nilai <= 100000000000000) {
                return 'Maaf Tidak Dapat di Prose Karena Jumlah nilai Terlalu Besar';
            }
        }
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $month = [
            1 => 'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des',
        ];

        $totalNominal = 0;
        $totalPpn = 0;
        $totalDpp = 0;
        $grandTotal = 0;
        $getSize = [];
        $getTheme = [];
        $getCategory = [];
        $index = 0;

        $getService = '';
        $getQty = 1;
        $getSide = 1;

        if ($price->objServiceType->print == true && $price->objServiceType->install == true) {
            $getService = 'Cetak dan Pasang';
        } elseif (
            $price->objServiceType->print == true &&
            ($price->objServiceType->install == false || $price->objInstalls[0]->price == 0)
        ) {
            $getService = 'Cetak';
        } elseif (
            ($price->objPrints[0]->price == 0 || $price->objServiceType->print == false) &&
            $price->objServiceType->install == true
        ) {
            $getService = 'Pasang';
        }

        $invoice_descriptions = [];
        $saleNumber = [];
        $saleYear = date('y', strtotime($sales[0]->created_at));
        foreach ($sales as $sale) {
            array_push($saleNumber, substr($sale->number, 0, 4));
            $totalNominal = $totalNominal + $sale->price;
            $totalPpn = $totalPpn + $sale->price * ($sale->ppn / 100);
            $totalDpp = $totalDpp + $sale->dpp;
            $grandTotal = $totalNominal + $totalPpn;
            $product = json_decode($sale->product);
            $description = json_decode($product->description);
            $install_order = $sale->install_orders->last();
            $getProduct = json_decode($sale->product);
            $install_order = $sale->install_orders->last();
            $pushSize = true;
            $pushCategory = true;
            $pushTheme = true;

            if ($price->objServiceType->print == true) {
                $i = 0;
                foreach ($price->objPrints as $objPrint) {
                    if ($objPrint->code == $getProduct->code) {
                        if ($price->objSideView[$i]->left == true && $price->objSideView[$i]->right == true) {
                            $getQty = 2;
                            $getSide = 2;
                        }
                    }
                    $i++;
                }
            } else {
                $i = 0;
                foreach ($price->objInstalls as $objInstall) {
                    if ($objInstall->code == $getProduct->code) {
                        if ($price->objSideView[$i]->left == true && $price->objSideView[$i]->right == true) {
                            $getQty = 2;
                            $getSide = 2;
                        }
                    }
                    $i++;
                }
            }

            if (count($getSize) != 0) {
                foreach ($getSize as $item) {
                    if ($item == $getProduct->size) {
                        $pushSize = false;
                    }
                }
                if ($pushSize == true) {
                    array_push($getSize, $getProduct->size);
                }
            } else {
                array_push($getSize, $getProduct->size);
            }

            if (count($getCategory) != 0) {
                foreach ($getCategory as $item) {
                    if ($item == $getProduct->category) {
                        $pushCategory = false;
                    }
                }
                if ($pushCategory == true) {
                    array_push($getCategory, $getProduct->category);
                }
            } else {
                array_push($getCategory, $getProduct->category);
            }

            if (count($sale->install_orders) != 0) {
                if (count($getTheme) != 0) {
                    foreach ($getTheme as $item) {
                        if ($item == $install_order->theme) {
                            $pushTheme = false;
                        }
                    }
                    if ($pushTheme == true) {
                        array_push($getTheme, $install_order->theme);
                    }
                } else {
                    array_push($getTheme, $install_order->theme);
                }
            }
            if ($install_order) {
                $theme = $install_order->theme;
            } else {
                $theme = '-';
            }

            $receipt_description = new stdClass();
            $receipt_description->locations = [];

            $invoice_description = new stdClass();
            $invoice_description->title = $getService . ' Visual Media Luar Ruang';
            $invoice_description->sale_id = $sale->id;
            $invoice_description->nominal = $sale->price;
            $invoice_description->type = $product->category . ' - ' . $description->lighting;
            $invoice_description->area = $product->area;
            $invoice_description->city = $product->city;
            $invoice_description->size = $product->size . ' x ' . $getSide . ' sisi - ' . $product->orientation;
            $invoice_description->qty = $getQty . ' Unit';
            $invoice_description->theme = $theme;
            $invoice_description->location = $product->code . '-' . $product->city_code . ' | ' . $product->address;
            array_push($receipt_description->locations, $invoice_description->location);

            array_push($invoice_descriptions, $invoice_description);
        }

        $receiptTheme = '';
        if (count($getTheme) == 0) {
            $receiptTheme = '-';
        } elseif (count($getTheme) == 1) {
            $receiptTheme = $getTheme[0];
        } elseif (count($getTheme) == 2) {
            $receiptTheme = $getTheme[0] . ' | ' . $getTheme[1];
        } else {
            foreach ($getTheme as $item) {
                if ($item == end($getTheme)) {
                    $receiptTheme = $receiptTheme . $item;
                } else {
                    $receiptTheme = $receiptTheme . $item . ' | ';
                }
            }
        }

        $receipt_description->nominal = $grandTotal;
        $receipt_description->terbilang = '# ' . terbilang($grandTotal) . ' Rupiah #';
        $receipt_description->title = $getService . ' Visual Media Luar Ruang';
        if (count($getCategory) == 1) {
            $receipt_description->type = $getCategory[0];
        } elseif (count($getCategory) == 2) {
            $receipt_description->type = $getCategory[0] . ' & ' . $getCategory[1];
        } else {
            foreach ($getCategory as $item) {
                if ($item == end($getCategory)) {
                    $receipt_description->type = ' & ' . $item;
                } elseif ($loop->iteration == count($getCategory) - 1) {
                    $receipt_description->type = $item;
                } else {
                    $receipt_description->type = $item . ', ';
                }
            }
        }

        if (count($getSize) == 1) {
            $receipt_description->size = $getSize[0];
        } elseif (count($getSize) == 2) {
            $receipt_description->size = $getSize[0] . ' & ' . $getSize[1];
        } else {
            $indexSize = 0;
            $receipt_description->size = '';
            foreach ($getSize as $item) {
                if ($item == end($getSize)) {
                    $receipt_description->size = $receipt_description->size . ' & ' . $item;
                } elseif ($indexSize == count($getSize) - 1) {
                    $receipt_description->size = $item;
                } else {
                    $receipt_description->size = $receipt_description->size . $item . ', ';
                }
                $indexSize++;
            }
        }
        $receipt_description->qty = count($sales) . ' (' . $huruf[count($sales)] . ') unit';
        $receipt_description->theme = $receiptTheme;

        if (fmod(count($invoice_descriptions), 4) == 0) {
            $pageQty = count($invoice_descriptions) / 4;
        } else {
            $pageQty = (count($invoice_descriptions) - fmod(count($invoice_descriptions), 4)) / 4 + 1;
        }

        $bill_client = new stdClass();
        $bill_client->id = $client->id;
        $bill_client->company = $client->company;
        $bill_client->address = $client->address;
        if ($quotationClient->contact_name) {
            if ($quotationClient->contact_gender == 'Male') {
                $bill_client->contact_name = 'Bapak ' . $quotationClient->contact_name;
            } else {
                $bill_client->contact_name = 'Ibu ' . $quotationClient->contact_name;
            }
        } else {
            $bill_client->contact_name = '-';
        }
        if ($quotationClient->contact_phone) {
            $bill_client->contact_phone = $quotationClient->contact_phone;
        } else {
            $bill_client->contact_phone = '-';
        }
        if ($quotationClient->contact_email) {
            $bill_client->contact_email = $quotationClient->contact_email;
        } else {
            $bill_client->contact_email = '-';
        }

        $bill_documents = new stdClass();
        $approval = new stdClass();
        $approval->id = $quotation_deal->id;
        $approval->number = $quotation_deal->number;
        $approval->created_at = $quotation_deal->created_at;
        $bill_documents->approval = $approval;
        $bill_documents->orders = [];
        foreach ($quotation_orders as $orders) {
            $quotationOrder = new stdClass();
            $quotationOrder->id = $orders->id;
            $quotationOrder->number = $orders->number;
            $quotationOrder->date = $orders->date;
            array_push($bill_documents->orders, $quotationOrder);
        }

        $invoice = new stdClass();
        $invoice->description = $invoice_descriptions;
        $invoice->approval = $bill_documents->approval;
        $invoice->orders = $bill_documents->orders;

        // $saleIdShorted = sort($sale_id);

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;
    @endphp
    <div class="flex justify-center bg-black p-10">
        <div>
            <form action="/accounting/billings" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="company_id" value="{{ $company->id }}" hidden>
                <input type="text" name="sale_id" value="{{ json_encode($sale_id) }}" hidden>
                <input type="text" name="sale_number" value="{{ json_encode($saleNumber) }}" hidden>
                <input type="text" name="sale_year" value="{{ $saleYear }}" hidden>
                <input type="text" name="category" value="Service" hidden>
                <input type="text" id="invoice" name="invoice_content" value="{{ json_encode($invoice) }}" hidden>
                <input type="text" id="receipt" name="receipt_content" value="{{ json_encode($receipt_description) }}"
                    hidden>
                <input type="text" id="client" name="client" value="{{ json_encode($bill_client) }}" hidden>
                <input type="text" name="dpp" value="{{ ($totalDpp / 12) * 11 }}" hidden>
                <input type="text" name="ppn" value="{{ $totalPpn }}" hidden>
                <input type="text" name="nominal" value="{{ $totalNominal }}" hidden>
                <input type="text" name="created_by" value="{{ json_encode($created_by) }}" hidden>
                <input type="text" name="updated_by" value="{{ json_encode($created_by) }}" hidden>
                <div class="flex items-center w-[1200px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[1200px]">Membuat Invoice & Kwitansi</h1>
                    <!-- Title end -->
                    <div class="flex w-[150px] justify-end">
                        <a href="/billings/select-sale/service/{{ $company->id }}"
                            class="flex justify-center items-center mx-1 btn-primary" title="Back">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                            <span class="mx-1 text-white">Back</span>
                        </a>
                        <button class="flex justify-center items-center mx-1 btn-success" title="Save">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="mx-1 text-white">Save</span>
                        </button>
                        <a href="/billings/index/{{ $company->id }}"
                            class="flex justify-center items-center mx-1 btn-danger" title="Cancel">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1 text-white">Cancel</span>
                        </a>
                    </div>
                </div>
            </form>
            <div>
                <div class="flex w-full">
                    <span class="text-center w-full text-lg font-semibold text-white">Preview Invoice & Kwitansi</span>
                </div>

                <!-- Surat Invoice start -->
                <div class="flex justify-center w-full mt-2">
                    <div>
                        @for ($i = 0; $i < $pageQty; $i++)
                            <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                                <!-- Header start -->
                                @include('dashboard.layouts.letter-header')
                                <!-- Header end -->
                                <!-- Body start -->
                                @include('billings.invoice-service-body')
                                <!-- Body end -->
                                @if ($pageQty > 1)
                                    <div class="flex w-[850px] justify-end text-sm">
                                        Halaman {{ $i + 1 }} dari {{ $pageQty }}
                                    </div>
                                @endif
                                <!-- Footer start -->
                                @include('dashboard.layouts.letter-footer')
                                <!-- Footer end -->
                            </div>
                        @endfor
                    </div>
                </div>
                <!-- Surat Invoice end -->

                <!-- Kwitansi start -->
                <div class="flex justify-center w-full mt-2">
                    <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                        <!-- Header start -->
                        @include('billings.receipt-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        @include('billings.receipt-service-body')
                        <!-- Body end -->
                        <!-- Sign start -->
                        @include('billings.receipt-service-sign')
                        <!-- Sign end -->
                        {{-- <div class="flex w-full justify-center items-center pt-2">
                            <div class="border-t h-2 border-slate-500 border-dashed w-full">
                            </div>
                        </div> --}}
                        <!-- Header start -->
                        {{-- @include('billings.receipt-header') --}}
                        <!-- Header end -->
                        <!-- Body start -->
                        {{-- @include('billings.receipt-service-body') --}}
                        <!-- Body end -->
                        <!-- Sign start -->
                        {{-- @include('billings.receipt-service-sign') --}}
                        <!-- Sign end -->
                    </div>
                </div>
                <!-- Kwitansi end -->
            </div>
        </div>
    </div>

    <!-- Script Preview Image start-->
    <script src="/js/createbillings.js"></script>
    <!-- Script Preview Image end-->
@endsection
