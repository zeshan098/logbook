@extends('admin.template.admin_template')



@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Immobilienmakler</h4>

                     

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row h-100">
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                    <i class="ri-money-euro-circle-fill align-middle"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-uppercase fw-medium fs-12 text-muted mb-1">Total Volume</p>
                                @foreach($total_vol as $total_volume )
                                <h4 class=" mb-0">€ <span class="counter-value"
                                        data-target="{{$total_volume->price}}">0</span></h4>
                                @endforeach
                            </div>

                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                    <i class="ri-money-euro-circle-fill align-middle"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-uppercase fw-medium fs-12 text-muted mb-1">Total Provision</p>
                                @foreach($total_pro as $total_provision )
                                <h4 class=" mb-0">€ <span class="counter-value"
                                        data-target="{{$total_provision->price}}">0</span></h4>
                                @endforeach
                            </div>

                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                    <i class="ri-money-euro-circle-fill align-middle"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-uppercase fw-medium fs-12 text-muted mb-1">Average Customer Value</p>
                                @foreach($total_count as $total_count )
                                <h4 class=" mb-0">€ <span class="counter-value"
                                        data-target="{{$total_count->price}}">0</span></h4>
                                @endforeach
                            </div>

                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

        </div><!-- end row -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card crm-widget">
                    <div class="card-body p-0">
                        <div class="row row-cols-xxl-5 row-cols-md-4 row-cols-1 g-0">
                            <div class="col">
                                <div class="py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Pipeline
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-space-ship-line display-6"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0"> <span class="counter-value"
                                                    data-target="{{$pipeline_status}}">0</span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="mt-3 mt-md-0 py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Holds
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-shield-keyhole-fill display-6"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0"> <span class="counter-value"
                                                    data-target="{{$holds_status}}">0</span>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="mt-3 mt-md-0 py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13">Won
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-trophy-line display-6" style="color: green;"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0"> <span class="counter-value"
                                                    data-target="{{$won_status}}">0</span>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="mt-3 mt-lg-0 py-4 px-3">
                                    <h5 class="text-muted text-uppercase fs-13"> Lost
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="ri-arrow-down-line display-6" style="color: red;"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h2 class="mb-0"> <span class="counter-value"
                                                    data-target="{{$lost_status}}">0</span>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                        </div><!-- end row -->
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Channels-vergleich</h4>

                    </div>

                    <div class="card-body">

                        <div class="row align-items-center">
                            <div class="col-6">
                                <h6 class="text-muted text-uppercase fw-semibold text-truncate fs-12 mb-3">
                                    Gesamtzahl der Kunden</h6>
                                <h4 class="fs- mb-0">{{$total_ref_pg}}</h4>

                            </div><!-- end col -->
                            <div class="col-6">
                                <div class="text-center">
                                    <img src="../admin_file/assets/images/illustrator-1.png" class="img-fluid" alt="">
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                        <div class="mt-3 pt-2">
                            <div class="progress progress-lg rounded-pill">
                                @foreach($service_count as $service_count)
                                <div class="progress-bar {{$service_count->bg_colr}}" role="progressbar"
                                    style="width: {{$service_count->percentage}}%; background-color: {{$service_count->bg_colr}};"
                                    aria-valuenow="{{$service_count->percentage}}" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                @endforeach

                            </div>
                        </div><!-- end -->

                        <div class="mt-3 pt-2">
                            @foreach($service_counts as $service_counts)
                            <div class="d-flex mb-2">
                                <div class="flex-grow-1">
                                    <p class="text-truncate text-muted fs-14 mb-0"><i
                                            class="mdi mdi-circle align-middle  me-2" style="color: {{$service_counts->txt_colr}};"></i>{{$service_counts->service_name}}
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <p class="mb-0">{{$service_counts->percentage}}%</p>
                                </div>
                            </div><!-- end -->
                            @endforeach

                        </div><!-- end -->



                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->


            <div class="col-xl-6 col-md-6">
                <div class="card card-height-100">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Total Volume vs Total Provision</h4>

                    </div><!-- end cardheader -->
                    <div class="card-body">
                        <div id="portfolio_donut_charts" data-colors='[ "--vz-warning", "--vz-success"]'
                            class="apex-charts" dir="ltr"></div>

                        <ul class="list-group list-group-flush border-dashed mb-0 mt-3 pt-2">
                            @foreach($total_vol_p as $total_volume_p )
                            <li class="list-group-item px-0">
                                <div class="d-flex">

                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-1">Volume</h6>

                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1">€ {{$total_volume_p->price}}</h6>

                                    </div>
                                </div>
                            </li><!-- end -->
                            @endforeach

                            @foreach($total_pro_p as $total_pro_p )
                            <li class="list-group-item px-0">
                                <div class="d-flex">

                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-1">Provision</h6>

                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1">€ {{$total_pro_p->price}}</h6>
                                    </div>
                                </div>
                            </li><!-- end -->
                            @endforeach

                        </ul><!-- end -->
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Channel vs Volume</h4>

                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="user_device_pie_charts" data-colors='{{$ch_col}}' class="apex-charts" dir="ltr"></div>

                        <div class="table-responsive mt-3">
                            <table
                                class="table table-borderless table-sm table-centered align-middle table-nowrap mb-0">
                                <tbody class="border-0">
                                    @foreach($total_ch_colume as $total_ch_colume )
                                    <tr>
                                        <td>
                                            <h4 class="text-truncate fs-14 fs-medium mb-0"><i
                                                    class="ri-stop-fill align-middle fs-18  me-2" style="color: {{$total_ch_colume->txt_colr}};"></i>
                                                {{$total_ch_colume->service_name}}</h4>
                                        </td>

                                        <td class="text-end">
                                            <div class="flex-shrink-0 text-end">
                                                <h6 class="mb-1">€ {{$total_ch_colume->vol_ind}}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->


            <div class="col-xl-6">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Channel vs Provision</h4>

                    </div><!-- end card header -->
                    <div class="card-body">
                        <div id="user_device_pie_charts_two" data-colors='{{$ch_col_pro}}' class="apex-charts"
                            dir="ltr"></div>

                        <div class="table-responsive mt-3">
                            <table
                                class="table table-borderless table-sm table-centered align-middle table-nowrap mb-0">
                                <tbody class="border-0">
                                    @foreach($total_pro_colume as $total_pro_colume )
                                    <tr>
                                        <td>
                                            <h4 class="text-truncate fs-14 fs-medium mb-0"><i
                                                    class="ri-stop-fill align-middle fs-18  me-2" style="color: {{$total_pro_colume->txt_colr}};"></i>
                                                {{$total_pro_colume->service_name}}</h4>
                                        </td>

                                        <td class="text-end">
                                            <div class="flex-shrink-0 text-end">
                                                <h6 class="mb-1">€ {{$total_pro_colume->pro_ind}}</h6>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

        </div><!-- end row -->



        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card card-height-100">
                    <div class="card-header  align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Channels vs Won</h4>

                    </div>

                    <div class="card-body">

                        <div class="p-3">


                            <div class="mt-3">
                                @foreach($chanel_review_won as $chanel_review_won )
                                <div class="row align-items-center g-2">
                                    <div class="col-auto">
                                        <div class="p-1">
                                            <h6 class="mb-0">{{$chanel_review_won->service_name}}</h6>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="p-1">
                                            <div class="progress animated-progress progress-sm">
                                                <div class="progress-bar {{$chanel_review_won->bg_colr}}"
                                                    role="progressbar"
                                                    style="width: {{$chanel_review_won->percentage}}%"
                                                    aria-valuenow="{{$chanel_review_won->count}}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="p-1">
                                            <h6 class="mb-0 text-muted">{{$chanel_review_won->count}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                                @endforeach

                            </div>
                        </div>



                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->


            <div class="col-xl-6 col-md-6">
                <div class="card card-height-100">
                    <div class="card-header  align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Channels vs Lost</h4>

                    </div><!-- end cardheader -->
                    <div class="card-body">
                        <div class="p-3">


                            <div class="mt-3">
                                @foreach($chanel_review_lost as $chanel_review_lost )
                                <div class="row align-items-center g-2">
                                    <div class="col-auto">
                                        <div class="p-1">
                                            <h6 class="mb-0">{{$chanel_review_lost->service_name}}</h6>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="p-1">
                                            <div class="progress animated-progress progress-sm">
                                                <div class="progress-bar {{$chanel_review_lost->bg_colr}}"
                                                    role="progressbar"
                                                    style="width: {{$chanel_review_won->percentage}}%"
                                                    aria-valuenow="{{$chanel_review_lost->count}}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="p-1">
                                            <h6 class="mb-0 text-muted">{{$chanel_review_lost->count}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                                @endforeach


                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

        </div>







    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
<!-- apexcharts -->
<script src="{{ asset('admin_file/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<script type="text/javascript">
function formatNumber(number, options) {
    /** @type {Array.<string>} */
    var result = (options['fraction'] ? number.toFixed(options['fraction']) :
        '' + number).split('.');
    return options['prefix'] +
        result[0].replace(/\B(?=(\d{3})+(?!\d))/g,
            /** @type {string} */
            (options['grouping'])) +
        (result[1] ? options['decimal'] + result[1] : '') +
        options['suffix'];
}
//Volume
var jobs = '{{$items_ch}}';
console.log(jobs);
const split_string = jobs.split(",");
console.log(split_string)
//Provision
var jobs_pro = '{{$items_ch_pro}}';
console.log(jobs_pro);
const split_string_pro = jobs_pro.split(",");
console.log(split_string_pro)

function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        var t = document.getElementById(e).getAttribute("data-colors");
        if (t) return (t = JSON.parse(t)).map(function(e) {
            var t = e.replace(" ", "");
            return -1 === t.indexOf(",") ? getComputedStyle(document.documentElement).getPropertyValue(t) ||
                t : 2 == (e = e.split(",")).length ? "rgba(" + getComputedStyle(document.documentElement)
                .getPropertyValue(e[0]) + "," + e[1] + ")" : t
        });
        console.warn("data-colors Attribute not found on:", e)
    }
}

var options, chart, donutchartportfolioColors = getChartColorsArray("portfolio_donut_charts"),
    MarketchartColors = (donutchartportfolioColors && (options = {
            series: [{{$total_volume->price}}, {{$total_provision->price}}],
            labels: ["Volume", "Provision"],
            chart: {
                type: "donut",
                height: 224
            },
            plotOptions: {
                pie: {
                    size: 100,
                    offsetX: 0,
                    offsetY: 0,
                    donut: {
                        size: "70%",
                        labels: {
                            show: !0,
                            name: {
                                show: !0,
                                fontSize: "18px",
                                offsetY: -5
                            },
                            value: {
                                show: !0,
                                fontSize: "20px",
                                color: "#343a40",
                                fontWeight: 500,
                                offsetY: 5,
                                formatter: function(e) {
                                    return "€" + e
                                }
                            },
                            total: {
                                show: !0,
                                fontSize: "13px",
                                label: "Total value",
                                color: "#9599ad",
                                fontWeight: 500,
                                formatter: function(e) {
                                    return "€" + e.globals.seriesTotals.reduce(function(e, t) {
                                        s = e + t
                                        // console.log(s.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, "."))
                                        return s
                                    }, 0)
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: !1
            },
            legend: {
                show: !1
            },
            yaxis: {
                labels: {
                    formatter: function(e) {
                        return "€" + e.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")
                    }
                }
            },
            stroke: {
                lineCap: "round",
                width: 2
            },
            colors: donutchartportfolioColors
        }, (chart = new ApexCharts(document.querySelector("#portfolio_donut_charts"), options)).render()),
        getChartColorsArray("Market_chart")),
    areachartbitcoinColors = (MarketchartColors && (options = {
        series: [{
            data: [{
                x: new Date(15387786e5),
                y: [6629.81, 6650.5, 6623.04, 6633.33]
            }, {
                x: new Date(15387804e5),
                y: [6632.01, 6643.59, 6620, 6630.11]
            }, {
                x: new Date(15387822e5),
                y: [6630.71, 6648.95, 6623.34, 6635.65]
            }, {
                x: new Date(1538784e6),
                y: [6635.65, 6651, 6629.67, 6638.24]
            }, {
                x: new Date(15387858e5),
                y: [6638.24, 6640, 6620, 6624.47]
            }, {
                x: new Date(15387876e5),
                y: [6624.53, 6636.03, 6621.68, 6624.31]
            }, {
                x: new Date(15387894e5),
                y: [6624.61, 6632.2, 6617, 6626.02]
            }, {
                x: new Date(15387912e5),
                y: [6627, 6627.62, 6584.22, 6603.02]
            }, {
                x: new Date(1538793e6),
                y: [6605, 6608.03, 6598.95, 6604.01]
            }, {
                x: new Date(15387948e5),
                y: [6604.5, 6614.4, 6602.26, 6608.02]
            }, {
                x: new Date(15387966e5),
                y: [6608.02, 6610.68, 6601.99, 6608.91]
            }, {
                x: new Date(15387984e5),
                y: [6608.91, 6618.99, 6608.01, 6612]
            }, {
                x: new Date(15388002e5),
                y: [6612, 6615.13, 6605.09, 6612]
            }, {
                x: new Date(1538802e6),
                y: [6612, 6624.12, 6608.43, 6622.95]
            }, {
                x: new Date(15388038e5),
                y: [6623.91, 6623.91, 6615, 6615.67]
            }, {
                x: new Date(15388056e5),
                y: [6618.69, 6618.74, 6610, 6610.4]
            }, {
                x: new Date(15388074e5),
                y: [6611, 6622.78, 6610.4, 6614.9]
            }, {
                x: new Date(15388092e5),
                y: [6614.9, 6626.2, 6613.33, 6623.45]
            }, {
                x: new Date(1538811e6),
                y: [6623.48, 6627, 6618.38, 6620.35]
            }, {
                x: new Date(15388128e5),
                y: [6619.43, 6620.35, 6610.05, 6615.53]
            }, {
                x: new Date(15388146e5),
                y: [6615.53, 6617.93, 6610, 6615.19]
            }, {
                x: new Date(15388164e5),
                y: [6615.19, 6621.6, 6608.2, 6620]
            }, {
                x: new Date(15388182e5),
                y: [6619.54, 6625.17, 6614.15, 6620]
            }, {
                x: new Date(153882e7),
                y: [6620.33, 6634.15, 6617.24, 6624.61]
            }, {
                x: new Date(15388218e5),
                y: [6625.95, 6626, 6611.66, 6617.58]
            }, {
                x: new Date(15388236e5),
                y: [6619, 6625.97, 6595.27, 6598.86]
            }, {
                x: new Date(15388254e5),
                y: [6598.86, 6598.88, 6570, 6587.16]
            }, {
                x: new Date(15388272e5),
                y: [6588.86, 6600, 6580, 6593.4]
            }, {
                x: new Date(1538829e6),
                y: [6593.99, 6598.89, 6585, 6587.81]
            }, {
                x: new Date(15388308e5),
                y: [6587.81, 6592.73, 6567.14, 6578]
            }, {
                x: new Date(15388326e5),
                y: [6578.35, 6581.72, 6567.39, 6579]
            }, {
                x: new Date(15388344e5),
                y: [6579.38, 6580.92, 6566.77, 6575.96]
            }, {
                x: new Date(15388362e5),
                y: [6575.96, 6589, 6571.77, 6588.92]
            }, {
                x: new Date(1538838e6),
                y: [6588.92, 6594, 6577.55, 6589.22]
            }, {
                x: new Date(15388398e5),
                y: [6589.3, 6598.89, 6589.1, 6596.08]
            }, {
                x: new Date(15388416e5),
                y: [6597.5, 6600, 6588.39, 6596.25]
            }, {
                x: new Date(15388434e5),
                y: [6598.03, 6600, 6588.73, 6595.97]
            }, {
                x: new Date(15388452e5),
                y: [6595.97, 6602.01, 6588.17, 6602]
            }, {
                x: new Date(1538847e6),
                y: [6602, 6607, 6596.51, 6599.95]
            }, {
                x: new Date(15388488e5),
                y: [6600.63, 6601.21, 6590.39, 6591.02]
            }, {
                x: new Date(15388506e5),
                y: [6591.02, 6603.08, 6591, 6591]
            }, {
                x: new Date(15388524e5),
                y: [6591, 6601.32, 6585, 6592]
            }, {
                x: new Date(15388542e5),
                y: [6593.13, 6596.01, 6590, 6593.34]
            }, {
                x: new Date(1538856e6),
                y: [6593.34, 6604.76, 6582.63, 6593.86]
            }, {
                x: new Date(15388578e5),
                y: [6593.86, 6604.28, 6586.57, 6600.01]
            }, {
                x: new Date(15388596e5),
                y: [6601.81, 6603.21, 6592.78, 6596.25]
            }, {
                x: new Date(15388614e5),
                y: [6596.25, 6604.2, 6590, 6602.99]
            }, {
                x: new Date(15388632e5),
                y: [6602.99, 6606, 6584.99, 6587.81]
            }, {
                x: new Date(1538865e6),
                y: [6587.81, 6595, 6583.27, 6591.96]
            }, {
                x: new Date(15388668e5),
                y: [6591.97, 6596.07, 6585, 6588.39]
            }, {
                x: new Date(15388686e5),
                y: [6587.6, 6598.21, 6587.6, 6594.27]
            }, {
                x: new Date(15388704e5),
                y: [6596.44, 6601, 6590, 6596.55]
            }, {
                x: new Date(15388722e5),
                y: [6598.91, 6605, 6596.61, 6600.02]
            }, {
                x: new Date(1538874e6),
                y: [6600.55, 6605, 6589.14, 6593.01]
            }, {
                x: new Date(15388758e5),
                y: [6593.15, 6605, 6592, 6603.06]
            }, {
                x: new Date(15388776e5),
                y: [6603.07, 6604.5, 6599.09, 6603.89]
            }, {
                x: new Date(15388794e5),
                y: [6604.44, 6604.44, 6600, 6603.5]
            }, {
                x: new Date(15388812e5),
                y: [6603.5, 6603.99, 6597.5, 6603.86]
            }, {
                x: new Date(1538883e6),
                y: [6603.85, 6605, 6600, 6604.07]
            }, {
                x: new Date(15388848e5),
                y: [6604.98, 6606, 6604.07, 6606]
            }]
        }],
        chart: {
            type: "candlestick",
            height: 294,
            toolbar: {
                show: !1
            }
        },
        plotOptions: {
            candlestick: {
                colors: {
                    upward: MarketchartColors[0],
                    downward: MarketchartColors[1]
                }
            }
        },
        xaxis: {
            type: "datetime"
        },
        yaxis: {
            tooltip: {
                enabled: !0
            },
            labels: {
                formatter: function(e) {
                    return "€" + e.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")
                }
            }
        },
        tooltip: {
            shared: !0,
            y: [{
                formatter: function(e) {
                    return void 0 !== e ? e.toFixed(0) : e.toString().replace(
                        /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")
                }
            }, {
                formatter: function(e) {
                    return void 0 !== e ? "€" + e.toFixed(2) + "k" : e.toString().replace(
                        /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")
                }
            }, {
                formatter: function(e) {
                    return void 0 !== e ? e.toFixed(0) + " Sales" : e.toString().replace(
                        /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")
                }
            }]
        }
    }));
</script>
<script>
var columnoptions, options, chart, chartHeatMapBasicColors = getChartColorsArray("audiences-sessions-country-charts"),
    chartAudienceColumnChartsColors = (chartHeatMapBasicColors && (options = {
            series: [{
                name: "Sat",
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Fri",
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Thu",
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Wed",
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Tue",
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Mon",
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Sun",
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }],
            chart: {
                height: 400,
                type: "heatmap",
                offsetX: 0,
                offsetY: -8,
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                heatmap: {
                    colorScale: {
                        ranges: [{
                            from: 0,
                            to: 50,
                            color: chartHeatMapBasicColors[0]
                        }, {
                            from: 51,
                            to: 100,
                            color: chartHeatMapBasicColors[1]
                        }]
                    }
                }
            },
            dataLabels: {
                enabled: !1
            },
            legend: {
                show: !0,
                horizontalAlign: "center",
                offsetX: 0,
                offsetY: 20,
                markers: {
                    width: 20,
                    height: 6,
                    radius: 2
                },
                itemMargin: {
                    horizontal: 12,
                    vertical: 0
                }
            },
            colors: chartHeatMapBasicColors,
            tooltip: {
                y: [{
                    formatter: function(e) {
                        return void 0 !== e ? e.toFixed(0) + "k" : e
                    }
                }]
            }
        }, (chart = new ApexCharts(document.querySelector("#audiences-sessions-country-charts"), options)).render()),
        getChartColorsArray("audiences_metrics_charts")),
    dountchartUserDeviceColors = (chartAudienceColumnChartsColors && (columnoptions = {
            series: [{
                name: "Last Year",
                data: [25.3, 12.5, 20.2, 18.5, 40.4, 25.4, 15.8, 22.3, 19.2, 25.3, 12.5, 20.2]
            }, {
                name: "Current Year",
                data: [36.2, 22.4, 38.2, 30.5, 26.4, 30.4, 20.2, 29.6, 10.9, 36.2, 22.4, 38.2]
            }],
            chart: {
                type: "bar",
                height: 309,
                stacked: !0,
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "20%",
                    borderRadius: 6
                }
            },
            dataLabels: {
                enabled: !1
            },
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "center",
                fontWeight: 400,
                fontSize: "8px",
                offsetX: 0,
                offsetY: 0,
                markers: {
                    width: 9,
                    height: 9,
                    radius: 4
                }
            },
            stroke: {
                show: !0,
                width: 2,
                colors: ["transparent"]
            },
            grid: {
                show: !1
            },
            colors: chartAudienceColumnChartsColors,
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                axisTicks: {
                    show: !1
                },
                axisBorder: {
                    show: !0,
                    strokeDashArray: 1,
                    height: 1,
                    width: "100%",
                    offsetX: 0,
                    offsetY: 0
                }
            },
            yaxis: {
                show: !1
            },
            fill: {
                opacity: 1
            }
        }, (chart = new ApexCharts(document.querySelector("#audiences_metrics_charts"), columnoptions)).render()),
        getChartColorsArray("user_device_pie_charts"));

dountchartUserDeviceColors && (options = {
        series: [{{$items_vol}}],
        labels: split_string,
        chart: {
            type: "donut",
            height: 219
        },
        plotOptions: {
            pie: {
                size: 100,
                donut: {
                    size: "76%"
                }
            }
        },
        dataLabels: {
            enabled: !1
        },
        legend: {
            show: !1,
            position: "bottom",
            horizontalAlign: "center",
            offsetX: 0,
            offsetY: 0,
            markers: {
                width: 20,
                height: 6,
                radius: 2
            },
            itemMargin: {
                horizontal: 12,
                vertical: 0
            }
        },
        stroke: {
            width: 0
        },
        yaxis: {
            labels: {
                formatter: function(e) {
                    return e
                }
            },
            tickAmount: 4,
            min: 0
        },
        colors: dountchartUserDeviceColors
    }, (chart = new ApexCharts(document.querySelector("#user_device_pie_charts"), options)).render()),
    getChartColorsArray("user_device_pie_charts_two");
dountchartUserDeviceColors && (options = {
    series: [{{$items_pro}}],
    labels: split_string_pro,
    chart: {
        type: "donut",
        height: 219
    },
    plotOptions: {
        pie: {
            size: 100,
            donut: {
                size: "76%"
            }
        }
    },
    dataLabels: {
        enabled: !1
    },
    legend: {
        show: !1,
        position: "bottom",
        horizontalAlign: "center",
        offsetX: 0,
        offsetY: 0,
        markers: {
            width: 20,
            height: 6,
            radius: 2
        },
        itemMargin: {
            horizontal: 12,
            vertical: 0
        }
    },
    stroke: {
        width: 0
    },
    yaxis: {
        labels: {
            formatter: function(e) {
                return e
            }
        },
        tickAmount: 4,
        min: 0
    },
    colors: dountchartUserDeviceColors
}, (chart = new ApexCharts(document.querySelector("#user_device_pie_charts_two"), options)).render());
</script>
@endsection