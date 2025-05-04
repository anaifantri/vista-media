@extends('dashboard.layouts.main');

@section('container')
    @php
        $angka = [
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

        $products = [];
        $product = json_decode($sales[0]->product);
        foreach ($sales as $sale) {
            array_push($products, json_decode($sale->product));
        }

        $manual_terms = [];
        $dataTitles = ['Produksi', 'Pemakaian Listrik', 'Jasa', 'Pajak Reklame', 'Lainnya'];
        for ($indexManual = 0; $indexManual < count($dataTitles); $indexManual++) {
            $manual_term = new stdClass();
            $manual_term->title = $dataTitles[$indexManual];
            $manual_term->number = '';
            $manual_term->term = 0;
            $manual_term->nominal = 0;
            $manual_term->dpp = 0;
            $manual_term->ppn = 0;
            $manual_term->set_collect = false;
            array_push($manual_terms, $manual_term);
        }

        $auto_terms = [];
        $indexAuto = 0;
        foreach ($payment_terms->dataPayments as $paymentTerm) {
            $indexAuto++;
            $auto_term = new stdClass();
            $auto_term->title = 'Penempatan';
            $auto_term->number = $indexAuto;
            $auto_term->term = $paymentTerm->term;
            $auto_term->nominal = $sale_price * ($paymentTerm->term / 100);
            $auto_term->dpp = round((($sale_price * ($paymentTerm->term / 100)) / 12) * 11);
            $auto_term->ppn = $sale_price * ($paymentTerm->term / 100) * ($sales[0]->ppn / 100);
            $auto_term->set_collect = false;
            array_push($auto_terms, $auto_term);
        }

        foreach ($price->dataTitle as $dataTitle) {
            if ($dataTitle->checkbox == true) {
                $priceTitle = $dataTitle->title;
            }
        }

        if (request('set_preview')) {
            if (request('set_preview') == true) {
                $set_preview = true;
            } else {
                $set_preview = false;
            }
        } else {
            $set_preview = false;
        }

        $bill_terms = [];

        if (request('bill_terms')) {
            $bill_terms = json_decode(request('bill_terms'));
        } else {
            if (request('rbTerms') == 'manualTerm') {
                $bill_terms = $manual_term;
            } else {
                $bill_terms = $auto_terms;
            }
        }

        $totalNominal = 0;
        $totalPpn = 0;
        $totalDpp = 0;
        $grandTotal = 0;
        $lightings = [];
        if (count($sales) == 2) {
            array_push($lightings, json_decode($products[0]->description)->lighting);
            array_push($lightings, json_decode($products[1]->description)->lighting);
        } else {
            array_push($lightings, json_decode($products[0]->description)->lighting);
        }

        $totalTerms = 0;
        $termCollects = [];
        $getTermCollect = '';
        $getTermTitle = '';
        $termTitles = [];
        $indexTermCollect = 0;
        $indexTermTitle = 0;
        $termTypes = [];
        if (request('rbTerm') && request('rbTerm') == 'autoTerm') {
            foreach ($bill_terms as $item) {
                if ($item->set_collect == true) {
                    array_push($termCollects, $item);
                }
            }
            foreach ($termCollects as $termCollect) {
                $indexTermCollect++;
                $totalTerms = $totalTerms + $termCollect->term;
                if (count($termCollects) == 1) {
                    $getTermCollect = $getTermCollect . $termCollect->number;
                } elseif (count($termCollects) == 2) {
                    if ($indexTermCollect == count($termCollects)) {
                        $getTermCollect = $getTermCollect . ' & ' . $termCollect->number;
                    } else {
                        $getTermCollect = $getTermCollect . $termCollect->number;
                    }
                } else {
                    if ($indexTermCollect == count($termCollects)) {
                        $getTermCollect = $getTermCollect . ' & ' . $termCollect->number;
                    } else {
                        $getTermCollect = $getTermCollect . $termCollect->number . ', ';
                    }
                }
            }
        } elseif (request('rbTerm') && request('rbTerm') == 'manualTerm') {
            foreach ($bill_terms as $item) {
                if ($item->set_collect == true) {
                    array_push($termTitles, $item->title);
                }
            }
            foreach ($termTitles as $itemTitle) {
                $indexTermTitle++;
                if (count($termTitles) == 1) {
                    $getTermTitle = $getTermTitle . $itemTitle;
                } elseif (count($termTitles) == 2) {
                    if ($indexTermTitle == count($termTitles)) {
                        $getTermTitle = $getTermTitle . ' & ' . $itemTitle;
                    } else {
                        $getTermTitle = $getTermTitle . $itemTitle;
                    }
                } else {
                    if ($indexTermTitle == count($termTitles)) {
                        $getTermTitle = $getTermTitle . ' & ' . $itemTitle;
                    } else {
                        $getTermTitle = $getTermTitle . $itemTitle . ', ';
                    }
                }
            }
        }
        $invoice_descriptions = [];
        if (count($sales) == 2) {
            $saleNumber = substr($sales[0]->number, 0, 4) . '-' . substr($sales[1]->number, 0, 4);
        } else {
            $saleNumber = substr($sales[0]->number, 0, 4);
        }
        $saleYear = date('y', strtotime($sales[0]->created_at));
        foreach ($bill_terms as $termItem) {
            if ($termItem->set_collect == true) {
                $totalNominal = $totalNominal + $termItem->nominal;
                $totalPpn = $totalPpn + $termItem->ppn;
                $totalDpp = $totalDpp + $termItem->ppn;
                $grandTotal = $totalNominal + $totalPpn;

                $invoice_description = new stdClass();
                $invoice_description->title =
                    'Jasa ' .
                    $termItem->title .
                    ' Media Luar Ruang Tahap Ke-' .
                    $termItem->number .
                    ' (' .
                    $termItem->term .
                    '%)';
                $invoice_description->nominal = $termItem->nominal;
                if (count($sales) == 2) {
                    if ($lightings[0] == $lightings[1]) {
                        $invoice_description->type = $products[0]->category . ' - ' . $lightings[0];
                    } else {
                        $invoice_description->type =
                            $products[0]->category . ' - ' . $lightings[0] . ' & ' . $lightings[1];
                    }
                } else {
                    $invoice_description->type = $products[0]->category . ' - ' . $lightings[0];
                }
                $invoice_description->area = $products[0]->area;
                $invoice_description->city = $products[0]->city;
                $invoice_description->size =
                    $products[0]->size . ' x ' . $products[0]->side . ' - ' . $products[0]->orientation;
                $invoice_description->qty = count($sales) . ' (' . $angka[count($sales)] . ') Unit';
                $invoice_description->periode =
                    $priceTitle .
                    ' (' .
                    date('d', strtotime($sales[0]->start_at)) .
                    ' ' .
                    $bulan[(int) date('m', strtotime($sales[0]->start_at))] .
                    ' ' .
                    date('Y', strtotime($sales[0]->start_at)) .
                    ' s.d. ' .
                    date('d', strtotime($sales[0]->end_at)) .
                    ' ' .
                    $bulan[(int) date('m', strtotime($sales[0]->end_at))] .
                    ' ' .
                    date('Y', strtotime($sales[0]->end_at)) .
                    ')';
                if (count($sales) == 2) {
                    $invoice_description->location =
                        $products[0]->code .
                        '-' .
                        $products[0]->city_code .
                        ' | ' .
                        $products[0]->address .
                        '*' .
                        $products[1]->code .
                        '-' .
                        $products[1]->city_code .
                        ' | ' .
                        $products[1]->address;
                } else {
                    $invoice_description->location =
                        $products[0]->code . '-' . $products[0]->city_code . ' | ' . $products[0]->address;
                }

                array_push($invoice_descriptions, $invoice_description);
            }
        }

        $receipt_description = new stdClass();
        $receipt_description->nominal = $grandTotal;
        $receipt_description->terbilang = '# ' . terbilang($grandTotal) . ' Rupiah #';
        if (request('rbTerm') && request('rbTerm') == 'autoTerm') {
            $receipt_description->title =
                'Jasa ' .
                $bill_terms[0]->title .
                ' Media Luar Ruang Tahap Ke- ' .
                $getTermCollect .
                ' (' .
                $totalTerms .
                '%)';
        } elseif (request('rbTerm') && request('rbTerm') == 'manualTerm') {
            $receipt_description->title =
                $getTermTitle .
                ' Media Luar Ruang Tahap Ke- ' .
                $bill_terms[0]->number .
                ' (' .
                $bill_terms[0]->term .
                '%)';
        } else {
            $receipt_description->title = '';
        }
        if (count($sales) == 2) {
            if ($lightings[0] == $lightings[1]) {
                $receipt_description->type = $products[0]->category . ' - ' . $lightings[0];
            } else {
                $receipt_description->type = $products[0]->category . ' - ' . $lightings[0] . ' & ' . $lightings[1];
            }
        } else {
            $receipt_description->type = $products[0]->category . ' - ' . $lightings[0];
        }
        $receipt_description->size =
            $products[0]->size . ' x ' . $products[0]->side . ' - ' . $products[0]->orientation;
        $receipt_description->qty = count($sales) . ' (' . $angka[count($sales)] . ') Unit';
        $receipt_description->periode =
            $priceTitle .
            ' (' .
            date('d', strtotime($sales[0]->start_at)) .
            ' ' .
            $bulan[(int) date('m', strtotime($sales[0]->start_at))] .
            ' ' .
            date('Y', strtotime($sales[0]->start_at)) .
            ' s.d. ' .
            date('d', strtotime($sales[0]->end_at)) .
            ' ' .
            $bulan[(int) date('m', strtotime($sales[0]->end_at))] .
            ' ' .
            date('Y', strtotime($sales[0]->end_at)) .
            ')';
        if (count($sales) == 2) {
            $receipt_description->location =
                $products[0]->code .
                '-' .
                $products[0]->city_code .
                ' | ' .
                $products[0]->address .
                '*' .
                $products[1]->code .
                '-' .
                $products[1]->city_code .
                ' | ' .
                $products[1]->address;
        } else {
            $receipt_description->location =
                $products[0]->code . '-' . $products[0]->city_code . ' | ' . $products[0]->address;
        }

        $bill_client = new stdClass();
        $bill_client->id = $client->id;
        $bill_client->company = $client->company;
        $bill_client->address = $client->address;
        if ($quotationClient->contact_name) {
            if ($quotationClient->contact_gender == 'Male') {
                $bill_client->contact = 'Bapak ' . $quotationClient->contact_name;
            } else {
                $bill_client->contact = 'Ibu ' . $quotationClient->contact_name;
            }
        } else {
            $bill_client->contact = '-';
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
        foreach ($quotation_orders as $order) {
            $quotationOrder = new stdClass();
            $quotationOrder->id = $order->id;
            $quotationOrder->number = $order->number;
            $quotationOrder->date = $order->date;
            array_push($bill_documents->orders, $quotationOrder);
        }
        $bill_documents->agreements = [];
        foreach ($quotation_agreements as $agreement) {
            $quotationAgreement = new stdClass();
            $quotationAgreement->id = $agreement->id;
            $quotationAgreement->number = $agreement->number;
            $quotationAgreement->date = $agreement->date;
            array_push($bill_documents->agreements, $quotationAgreement);
        }

        $invoice = new stdClass();
        $invoice->description = $invoice_descriptions;
        $invoice->approval = $bill_documents->approval;
        $invoice->orders = $bill_documents->orders;
        $invoice->agreements = $bill_documents->agreements;
        $invoice->data_sales = [];

        foreach ($sales as $getSale) {
            $dataSale = new stdClass();
            $dataSale->id = $getSale->id;
            $dataSale->nominal = 0;
            foreach ($bill_terms as $getBillTerm) {
                if ($getBillTerm->set_collect == true) {
                    $dataSale->nominal = $dataSale->nominal + ($getBillTerm->term / 100) * $getSale->price;
                }
            }

            array_push($invoice->data_sales, $dataSale);
        }

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
                <input type="text" name="sale_id" value="{{ $sale_id }}" hidden>
                <input type="text" name="sale_year" value="{{ $saleYear }}" hidden>
                <input type="text" name="sale_number" value="{{ $saleNumber }}" hidden>
                <input type="text" name="category" value="Media" hidden>
                <input type="text" id="invoice" name="invoice_content" value="{{ json_encode($invoice) }}" hidden>
                <input type="text" id="receipt" name="receipt_content" value="{{ json_encode($receipt_description) }}"
                    hidden>
                <input type="text" id="client" name="client" value="{{ json_encode($bill_client) }}" hidden>
                <input type="text" name="dpp" value="{{ $totalDpp }}" hidden>
                <input type="text" name="ppn" value="{{ $totalPpn }}" hidden>
                <input type="text" name="nominal" value="{{ $totalNominal }}" hidden>
                <input type="text" name="created_by" value="{{ json_encode($created_by) }}" hidden>
                <input type="text" name="updated_by" value="{{ json_encode($created_by) }}" hidden>
                <div class="flex items-center w-[1200px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[1200px]">Membuat Invoice & Kwitansi</h1>
                    <!-- Title end -->
                    <div id="divButton" class="hidden w-[150px] justify-end">
                        <button class="flex justify-center items-center mx-1 btn-primary" title="Back" type="button"
                            onclick="previewMediaBack()">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                            <span class="mx-1 text-white">Back</span>
                        </button>
                        <button class="flex justify-center items-center mx-1 btn-success" title="Save">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="mx-1 text-white">Save</span>
                        </button>
                    </div>
                    <div>
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
            @include('billings.sale-detail')
            <div class="flex justify-center w-full">
                <div class="w-[1200px] mb-10 p-2">
                    <!-- Modal Select Term start-->
                    @include('billings.select-term')
                    <!-- Modal Select Term end-->

                    <!-- Modal Preview start-->
                    @include('billings.media-preview')
                    <!-- Modal Preview end-->
                </div>
            </div>
        </div>
    </div>

    <!-- Script Preview Image start-->
    <script src="/js/createbillings.js"></script>
    <script>
        var getProduct = @json($product);
    </script>
    <!-- Script Preview Image end-->
@endsection
