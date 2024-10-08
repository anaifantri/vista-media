@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Report start -->
    <div>
        {{-- <input type="text" name="sales_value" id="sales_value" value="{{ $sales }}" hidden> --}}
        <div class="flex mt-10 justify-center">
            <h1 class="text-xl text-cyan-800 font-bold tracking-wider w-[1200px] border-b">LAPORAN PENJUALAN</h1>
        </div>
        @include('sales.reports-header')

        @include('sales.c-reports')

        @include('sales.chart-reports')

    </div>

    <!-- Create Sales Report end -->

    <!-- Script start -->
    <script src="/js/html2pdf.bundle.min.js"></script>

    <script>
        //Format date --> start
        const btnC1Pdf = document.getElementById("btnC1Pdf");
        const btnChartPdf = document.getElementById("btnChartPdf");
        const date = new Date();
        const year = date.getFullYear();
        let month = "";
        let options = [{
            month: 'long'
        }, {
            year: 'numeric'
        }];

        function getFormatDate(date, options, separator) {
            function format(option) {
                let formatter = new Intl.DateTimeFormat('en', option);
                return formatter.format(date);
            }
            return options.map(format).join(separator);
        }
        //Format date --> end

        // Action Type & Periode --> start
        const c1Type = document.getElementById("c1Type");
        const chartType = document.getElementById("chartType");
        const yearReport = document.getElementById("yearReport");
        const monthReport = document.getElementById("monthReport");
        const labelPeriode = document.querySelectorAll("[id='labelPeriode']");
        const c1Report = document.getElementById("c1Report");
        const search = document.getElementById("search");

        monthReport.addEventListener("change", function() {
            // for (i = 0; i < labelPeriode.length; i++) {
            //     labelPeriode[i].innerHTML = "";
            //     labelPeriode[i].innerHTML = getFormatDate(new Date(monthReport.value), options, ' ');
            // }
            search.value = monthReport.value;
        })

        if (search.value) {
            if (c1Type.checked == true) {
                c1Report.classList.remove("hidden");
                c1Report.classList.add("flex");
            }
        }
        if (c1Type.checked == true) {
            monthReport.removeAttribute("hidden");
            c1Report.classList.remove("hidden");
            c1Report.classList.add("flex");
            btnC1Pdf.classList.remove("hidden");
            btnC1Pdf.classList.add("flex");
            chartReport.classList.add("hidden");
            chartReport.classList.remove("flex");
            btnChartPdf.classList.add("hidden");
            btnChartPdf.classList.remove("flex");
            yearReport.setAttribute("hidden", "hidden");
            document.getElementById("divArea").classList.add('hidden');
            document.getElementById("divArea").classList.remove('flex');
        } else if (chartType.checked == true) {
            monthReport.setAttribute("hidden", "hidden");
            c1Report.classList.remove("flex");
            c1Report.classList.add("hidden");
            btnC1Pdf.classList.remove("flex");
            btnC1Pdf.classList.add("hidden");
            chartReport.classList.remove("hidden");
            chartReport.classList.add("flex");
            btnChartPdf.classList.remove("hidden");
            btnChartPdf.classList.add("flex");
            yearReport.removeAttribute("hidden");
            search.value = "";
            monthReport.value == "";
            document.getElementById("divArea").classList.remove('hidden');
            document.getElementById("divArea").classList.add('flex');
        }

        c1Type.addEventListener("click", function() {
            monthReport.removeAttribute("hidden");
            c1Report.classList.remove("hidden");
            c1Report.classList.add("flex");
            chartReport.classList.add("hidden");
            chartReport.classList.remove("flex");
            btnChartPdf.classList.add("hidden");
            btnChartPdf.classList.remove("flex");
            btnC1Pdf.classList.remove("hidden");
            btnC1Pdf.classList.add("flex");
            yearReport.setAttribute("hidden", "hidden");
            document.getElementById("divArea").classList.add('hidden');
            document.getElementById("divArea").classList.remove('flex');
        })

        chartType.addEventListener("click", function() {
            monthReport.setAttribute("hidden", "hidden");
            c1Report.classList.remove("flex");
            c1Report.classList.add("hidden");
            chartReport.classList.remove("hidden");
            chartReport.classList.add("flex");
            btnChartPdf.classList.remove("hidden");
            btnChartPdf.classList.add("flex");
            btnC1Pdf.classList.remove("flex");
            btnC1Pdf.classList.add("hidden");
            yearReport.removeAttribute("hidden");
            search.value = "";
            monthReport.value == "";

            document.getElementById("divArea").classList.remove('hidden');
            document.getElementById("divArea").classList.add('flex');
        })

        // Action Type & Periode --> end

        // Create PDF --> start
        document.getElementById("btnC1Pdf").onclick = function() {
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: 'test.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 300,
                    scale: 2,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'px',
                    format: [1200, 848],
                    orientation: 'landscape',
                    putTotalPages: true
                }
            };
            html2pdf().set(opt).from(element).save();
        };

        document.getElementById("btnChartPdf").onclick = function() {
            var element = document.getElementById('pdfChartPreview');
            var opt = {
                margin: 0,
                filename: 'test.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 300,
                    scale: 4,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'px',
                    format: [1290, 910],
                    orientation: 'landscape',
                    putTotalPages: true
                }
            };
            html2pdf().set(opt).from(element).save();
        };
        // Create PDF --> end
    </script>
    <!-- Script end -->
@endsection
