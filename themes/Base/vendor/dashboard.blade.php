@extends('layouts.vendor')
@section('content')
    <section class="ps-dashboard">
        <div class="ps-section__left">
            <div class="row">
                <div class="col-md-8">
                    <div class="ps-card ps-card--sale-report">
                        <div class="ps-card__header">
                            <h4>Sales Reports</h4>
                        </div>
                        <div class="ps-card__content" style="position: relative;">
                            <div id="chart" style="min-height: 365px;"><div id="apexcharts7qp47rho" class="apexcharts-canvas apexcharts7qp47rho apexcharts-theme-light" style="width: 440px; height: 350px;"><svg id="SvgjsSvg1486" width="440" height="350" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg apexcharts-zoomable hovering-zoom" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1488" class="apexcharts-inner apexcharts-graphical" transform="translate(45.359375, 30)"><defs id="SvgjsDefs1487"><clipPath id="gridRectMask7qp47rho"><rect id="SvgjsRect1500" width="392.640625" height="292.2" x="-4" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask7qp47rho"><rect id="SvgjsRect1501" width="388.640625" height="292.2" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1506" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1507" stop-opacity="0.65" stop-color="rgba(252,184,0,0.65)" offset="0"></stop><stop id="SvgjsStop1508" stop-opacity="0.5" stop-color="rgba(254,220,128,0.5)" offset="1"></stop><stop id="SvgjsStop1509" stop-opacity="0.5" stop-color="rgba(254,220,128,0.5)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1496" x1="127.71354166666666" y1="0" x2="127.71354166666666" y2="288.2" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="127.71354166666666" y="0" width="1" height="244.7813720703125" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1512" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1513" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1515" font-family="Helvetica, Arial, sans-serif" x="64.10677083333333" y="317.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1516">20 Sep</tspan><title>20 Sep</title></text><text id="SvgjsText1518" font-family="Helvetica, Arial, sans-serif" x="128.21354166666666" y="317.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1519">21 Sep</tspan><title>21 Sep</title></text><text id="SvgjsText1521" font-family="Helvetica, Arial, sans-serif" x="192.3203125" y="317.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1522">22 Sep</tspan><title>22 Sep</title></text><text id="SvgjsText1524" font-family="Helvetica, Arial, sans-serif" x="256.4270833333333" y="317.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1525">23 Sep</tspan><title>23 Sep</title></text><text id="SvgjsText1527" font-family="Helvetica, Arial, sans-serif" x="320.53385416666663" y="317.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1528">24 Sep</tspan><title>24 Sep</title></text><text id="SvgjsText1530" font-family="Helvetica, Arial, sans-serif" x="384.64062499999994" y="317.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1531">25 Sep</tspan><title>25 Sep</title></text><text id="SvgjsText1533" font-family="Helvetica, Arial, sans-serif" x="448.74739583333326" y="317.2" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1534"></tspan><title></title></text></g><line id="SvgjsLine1535" x1="0" y1="289.2" x2="384.640625" y2="289.2" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1"></line></g><g id="SvgjsG1554" class="apexcharts-grid"><g id="SvgjsG1555" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine1563" x1="0" y1="0" x2="384.640625" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1564" x1="0" y1="41.17142857142857" x2="384.640625" y2="41.17142857142857" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1565" x1="0" y1="82.34285714285714" x2="384.640625" y2="82.34285714285714" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1566" x1="0" y1="123.5142857142857" x2="384.640625" y2="123.5142857142857" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1567" x1="0" y1="164.68571428571428" x2="384.640625" y2="164.68571428571428" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1568" x1="0" y1="205.85714285714286" x2="384.640625" y2="205.85714285714286" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1569" x1="0" y1="247.02857142857144" x2="384.640625" y2="247.02857142857144" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1570" x1="0" y1="288.2" x2="384.640625" y2="288.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1556" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine1557" x1="64.10677083333333" y1="289.2" x2="64.10677083333333" y2="295.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1558" x1="128.21354166666666" y1="289.2" x2="128.21354166666666" y2="295.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1559" x1="192.3203125" y1="289.2" x2="192.3203125" y2="295.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1560" x1="256.4270833333333" y1="289.2" x2="256.4270833333333" y2="295.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1561" x1="320.53385416666663" y1="289.2" x2="320.53385416666663" y2="295.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1562" x1="384.64062499999994" y1="289.2" x2="384.64062499999994" y2="295.2" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1572" x1="0" y1="288.2" x2="384.640625" y2="288.2" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1571" x1="0" y1="1" x2="0" y2="288.2" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1502" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1503" class="apexcharts-series" seriesName="series1" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1510" d="M 0 288.2L 0 247.0285714285714C 22.437369791666665 247.0285714285714 41.66940104166666 164.68571428571425 64.10677083333333 164.68571428571425C 86.544140625 164.68571428571425 105.77617187499999 251.1457142857143 128.21354166666666 251.1457142857143C 150.65091145833333 251.1457142857143 169.88294270833333 144.10000000000002 192.3203125 144.10000000000002C 214.75768229166667 144.10000000000002 233.98971354166665 135.86571428571426 256.4270833333333 135.86571428571426C 278.864453125 135.86571428571426 298.096484375 123.51428571428573 320.5338541666667 123.51428571428573C 342.9712239583333 123.51428571428573 362.20325520833336 49.405714285714225 384.640625 49.405714285714225C 384.640625 49.405714285714225 384.640625 49.405714285714225 384.640625 288.2M 384.640625 49.405714285714225z" fill="url(#SvgjsLinearGradient1506)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask7qp47rho)" pathTo="M 0 288.2L 0 247.0285714285714C 22.437369791666665 247.0285714285714 41.66940104166666 164.68571428571425 64.10677083333333 164.68571428571425C 86.544140625 164.68571428571425 105.77617187499999 251.1457142857143 128.21354166666666 251.1457142857143C 150.65091145833333 251.1457142857143 169.88294270833333 144.10000000000002 192.3203125 144.10000000000002C 214.75768229166667 144.10000000000002 233.98971354166665 135.86571428571426 256.4270833333333 135.86571428571426C 278.864453125 135.86571428571426 298.096484375 123.51428571428573 320.5338541666667 123.51428571428573C 342.9712239583333 123.51428571428573 362.20325520833336 49.405714285714225 384.640625 49.405714285714225C 384.640625 49.405714285714225 384.640625 49.405714285714225 384.640625 288.2M 384.640625 49.405714285714225z" pathFrom="M -1 658.7428571428571L -1 658.7428571428571L 64.10677083333333 658.7428571428571L 128.21354166666666 658.7428571428571L 192.3203125 658.7428571428571L 256.4270833333333 658.7428571428571L 320.5338541666667 658.7428571428571L 384.640625 658.7428571428571"></path><path id="SvgjsPath1511" d="M 0 247.0285714285714C 22.437369791666665 247.0285714285714 41.66940104166666 164.68571428571425 64.10677083333333 164.68571428571425C 86.544140625 164.68571428571425 105.77617187499999 251.1457142857143 128.21354166666666 251.1457142857143C 150.65091145833333 251.1457142857143 169.88294270833333 144.10000000000002 192.3203125 144.10000000000002C 214.75768229166667 144.10000000000002 233.98971354166665 135.86571428571426 256.4270833333333 135.86571428571426C 278.864453125 135.86571428571426 298.096484375 123.51428571428573 320.5338541666667 123.51428571428573C 342.9712239583333 123.51428571428573 362.20325520833336 49.405714285714225 384.640625 49.405714285714225" fill="none" fill-opacity="1" stroke="#fcb800" stroke-opacity="1" stroke-linecap="butt" stroke-width="4" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask7qp47rho)" pathTo="M 0 247.0285714285714C 22.437369791666665 247.0285714285714 41.66940104166666 164.68571428571425 64.10677083333333 164.68571428571425C 86.544140625 164.68571428571425 105.77617187499999 251.1457142857143 128.21354166666666 251.1457142857143C 150.65091145833333 251.1457142857143 169.88294270833333 144.10000000000002 192.3203125 144.10000000000002C 214.75768229166667 144.10000000000002 233.98971354166665 135.86571428571426 256.4270833333333 135.86571428571426C 278.864453125 135.86571428571426 298.096484375 123.51428571428573 320.5338541666667 123.51428571428573C 342.9712239583333 123.51428571428573 362.20325520833336 49.405714285714225 384.640625 49.405714285714225" pathFrom="M -1 658.7428571428571L -1 658.7428571428571L 64.10677083333333 658.7428571428571L 128.21354166666666 658.7428571428571L 192.3203125 658.7428571428571L 256.4270833333333 658.7428571428571L 320.5338541666667 658.7428571428571L 384.640625 658.7428571428571"></path><g id="SvgjsG1504" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1578" r="0" cx="128.21354166666666" cy="251.1457142857143" class="apexcharts-marker w0eoo9xm9i no-pointer-events" stroke="#ffffff" fill="#fcb800" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1505" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1573" x1="0" y1="0" x2="384.640625" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1574" x1="0" y1="0" x2="384.640625" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1575" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1576" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1577" class="apexcharts-point-annotations"></g><rect id="SvgjsRect1579" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect><rect id="SvgjsRect1580" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect></g><rect id="SvgjsRect1495" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1536" class="apexcharts-yaxis" rel="0" transform="translate(15.359375, 0)"><g id="SvgjsG1537" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1538" font-family="Helvetica, Arial, sans-serif" x="20" y="31.7" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1539">160</tspan></text><text id="SvgjsText1540" font-family="Helvetica, Arial, sans-serif" x="20" y="72.87142857142858" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1541">150</tspan></text><text id="SvgjsText1542" font-family="Helvetica, Arial, sans-serif" x="20" y="114.04285714285716" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1543">140</tspan></text><text id="SvgjsText1544" font-family="Helvetica, Arial, sans-serif" x="20" y="155.21428571428572" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1545">130</tspan></text><text id="SvgjsText1546" font-family="Helvetica, Arial, sans-serif" x="20" y="196.3857142857143" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1547">120</tspan></text><text id="SvgjsText1548" font-family="Helvetica, Arial, sans-serif" x="20" y="237.55714285714288" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1549">110</tspan></text><text id="SvgjsText1550" font-family="Helvetica, Arial, sans-serif" x="20" y="278.72857142857146" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1551">100</tspan></text><text id="SvgjsText1552" font-family="Helvetica, Arial, sans-serif" x="20" y="319.90000000000003" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1553">90</tspan></text></g></g><g id="SvgjsG1489" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 175px;"></div><div class="apexcharts-tooltip apexcharts-theme-light" style="left: 184.573px; top: 248.2px;"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">21/09/20 00:00</div><div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(252, 184, 0);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">series1: </span><span class="apexcharts-tooltip-text-value">99</span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light" style="left: 115.362px; top: 320.2px;"><div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 93.4219px;">21/09/20 00:00</div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 441px; height: 366px;"></div></div><div class="contract-trigger"></div></div></div>
                        <div class="ps-card__footer">
                            <div class="row">
                                <div class="col-md-8">
                                    <p>Items Earning Sales ($)</p>
                                </div>
                                <div class="col-md-4"><a href="#">Export Report<i class="icon icon-cloud-download ml-2"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ps-card ps-card--earning">
                        <div class="ps-card__header">
                            <h4>Earnings</h4>
                        </div>
                        <div class="ps-card__content">
                            <div class="ps-card__chart">
                                <div id="donut-chart" style="min-height: 228.7px;"><div id="apexcharts2b7926ne" class="apexcharts-canvas apexcharts2b7926ne apexcharts-theme-light" style="width: 205px; height: 228.7px;"><svg id="SvgjsSvg1467" width="205" height="228.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1469" class="apexcharts-inner apexcharts-graphical" transform="translate(-9.5, 0)"><defs id="SvgjsDefs1468"><clipPath id="gridRectMask2b7926ne"><rect id="SvgjsRect1471" width="232" height="250" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask2b7926ne"><rect id="SvgjsRect1472" width="230" height="252" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1473" class="apexcharts-pie"><g id="SvgjsG1474" transform="translate(0, 0) scale(1)"><circle id="SvgjsCircle1475" r="74.01317073170732" cx="113" cy="113" fill="transparent"></circle><g id="SvgjsG1476" class="apexcharts-slices"><g id="SvgjsG1477" class="apexcharts-series apexcharts-pie-series" seriesName="seriesx1" rel="1" data:realIndex="0"><path id="SvgjsPath1478" d="M 113 8.756097560975604 A 104.2439024390244 104.2439024390244 0 0 1 215.39745633205894 93.46664052342959 L 185.70219399576183 99.131314771635 A 74.01317073170732 74.01317073170732 0 0 0 113 38.98682926829268 L 113 8.756097560975604 z" fill="rgba(0,143,251,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="79.2" data:startAngle="0" data:strokeWidth="2" data:value="22" data:pathOrig="M 113 8.756097560975604 A 104.2439024390244 104.2439024390244 0 0 1 215.39745633205894 93.46664052342959 L 185.70219399576183 99.131314771635 A 74.01317073170732 74.01317073170732 0 0 0 113 38.98682926829268 L 113 8.756097560975604 z" stroke="#ffffff"></path></g><g id="SvgjsG1479" class="apexcharts-series apexcharts-pie-series" seriesName="seriesx2" rel="2" data:realIndex="1"><path id="SvgjsPath1480" d="M 215.39745633205894 93.46664052342959 A 104.2439024390244 104.2439024390244 0 0 1 57.1433238599944 201.01603789257595 L 73.34175994059603 175.49138690372894 A 74.01317073170732 74.01317073170732 0 0 0 185.70219399576183 99.131314771635 L 215.39745633205894 93.46664052342959 z" fill="rgba(0,227,150,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="133.2" data:startAngle="79.2" data:strokeWidth="2" data:value="37" data:pathOrig="M 215.39745633205894 93.46664052342959 A 104.2439024390244 104.2439024390244 0 0 1 57.1433238599944 201.01603789257595 L 73.34175994059603 175.49138690372894 A 74.01317073170732 74.01317073170732 0 0 0 185.70219399576183 99.131314771635 L 215.39745633205894 93.46664052342959 z" stroke="#ffffff"></path></g><g id="SvgjsG1481" class="apexcharts-series apexcharts-pie-series" seriesName="seriesx3" rel="3" data:realIndex="2"><path id="SvgjsPath1482" d="M 57.1433238599944 201.01603789257595 A 104.2439024390244 104.2439024390244 0 0 1 112.98180600686547 8.756099148701026 L 112.98708226487447 38.98683039557773 A 74.01317073170732 74.01317073170732 0 0 0 73.34175994059603 175.49138690372894 L 57.1433238599944 201.01603789257595 z" fill="rgba(254,176,25,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="147.60000000000002" data:startAngle="212.39999999999998" data:strokeWidth="2" data:value="41" data:pathOrig="M 57.1433238599944 201.01603789257595 A 104.2439024390244 104.2439024390244 0 0 1 112.98180600686547 8.756099148701026 L 112.98708226487447 38.98683039557773 A 74.01317073170732 74.01317073170732 0 0 0 73.34175994059603 175.49138690372894 L 57.1433238599944 201.01603789257595 z" stroke="#ffffff"></path></g></g></g></g><line id="SvgjsLine1483" x1="0" y1="0" x2="226" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1484" x1="0" y1="0" x2="226" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1470" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
                                <div class="ps-card__information"><i class="icon icon-wallet"></i><strong>$12,560</strong><small>Balance</small></div>
                                <div class="resize-triggers"><div class="expand-trigger"><div style="width: 206px; height: 230px;"></div></div><div class="contract-trigger"></div></div></div>
                            <div class="ps-card__status">
                                <p class="yellow"><strong> $20,199</strong><span>Income</span></p>
                                <p class="red"><strong> $1,021</strong><span>Taxes</span></p>
                                <p class="green"><strong> $992.00</strong><span>Fees</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-card">
                <div class="ps-card__header">
                    <h4>Recent Orders</h4>
                </div>
                <div class="ps-card__content">
                    <div class="table-responsive">
                        <table class="table ps-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Payment</th>
                                <th>Fullfillment</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>#A580</td>
                                <td><strong> Aug, 15, 2020</strong></td>
                                <td><a href="order-detail.html"><strong>Unero Black Military</strong></a></td>
                                <td><span class="ps-badge success">Paid</span>
                                </td>
                                <td><span class="ps-fullfillment success">delivered</span>
                                </td>
                                <td><strong>$56.00</strong></td>
                                <td>
                                    <div class="dropdown"><a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-ellipsis"></i></a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item" href="#">Delete</a></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#B260</td>
                                <td><strong> Aug, 15, 2020</strong></td>
                                <td><a href="order-detail.html"><strong>Marsh Speaker</strong></a></td>
                                <td><span class="ps-badge gray">Unpaid</span>
                                </td>
                                <td><span class="ps-fullfillment success">delivered</span>
                                </td>
                                <td><strong>$56.00</strong></td>
                                <td>
                                    <div class="dropdown"><a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-ellipsis"></i></a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item" href="#">Delete</a></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#A583</td>
                                <td><strong> Aug, 15, 2020</strong></td>
                                <td><a href="order-detail.html"><strong>Lined Blend T-Shirt</strong></a></td>
                                <td><span class="ps-badge success">Paid</span>
                                </td>
                                <td><span class="ps-fullfillment warning">In Progress</span>
                                </td>
                                <td><strong>$516.00</strong></td>
                                <td>
                                    <div class="dropdown"><a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-ellipsis"></i></a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item" href="#">Delete</a></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#A583</td>
                                <td><strong> Aug, 15, 2020</strong></td>
                                <td><a href="order-detail.html"><strong>DJI MAcvic Quadcopter</strong></a></td>
                                <td><span class="ps-badge gray">Unpaid</span>
                                </td>
                                <td><span class="ps-fullfillment success">delivered</span>
                                </td>
                                <td><strong>$112.00</strong></td>
                                <td>
                                    <div class="dropdown"><a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-ellipsis"></i></a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item" href="#">Delete</a></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#A112</td>
                                <td><strong> Aug, 15, 2020</strong></td>
                                <td><a href="order-detail.html"><strong>Black T-Shirt</strong></a></td>
                                <td><span class="ps-badge success">Paid</span>
                                </td>
                                <td><span class="ps-fullfillment danger">Cancel</span>
                                </td>
                                <td><strong>$30.00</strong></td>
                                <td>
                                    <div class="dropdown"><a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-ellipsis"></i></a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item" href="#">Delete</a></div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="ps-card__footer"><a class="ps-card__morelink" href="orders.htmls">View Full Orders<i class="icon icon-chevron-right"></i></a></div>
            </div>
        </div>
        <div class="ps-section__right">
            <section class="ps-card ps-card--statics">
                <div class="ps-card__header">
                    <h4>Statics</h4>
                    <div class="ps-card__sortby"><i class="icon-calendar-empty"></i>
                        <div class="form-group--select">
                            <select class="form-control">
                                <option value="1">Last 30 days</option>
                                <option value="2">Last 90 days</option>
                                <option value="3">Last 180 days</option>
                            </select><i class="icon-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="ps-card__content">
                    <div class="ps-block--stat yellow">
                        <div class="ps-block__left"><span><i class="icon-cart"></i></span></div>
                        <div class="ps-block__content">
                            <p>Orders</p>
                            <h4>254<small class="asc"><i class="icon-arrow-up"></i><span>12,5%</span></small></h4>
                        </div>
                    </div>
                    <div class="ps-block--stat pink">
                        <div class="ps-block__left"><span><i class="icon-cart"></i></span></div>
                        <div class="ps-block__content">
                            <p>Revenue</p>
                            <h4>$6,260<small class="asc"><i class="icon-arrow-up"></i><span>7.1%</span></small></h4>
                        </div>
                    </div>
                    <div class="ps-block--stat green">
                        <div class="ps-block__left"><span><i class="icon-cart"></i></span></div>
                        <div class="ps-block__content">
                            <p>Revenue</p>
                            <h4>$2,567<small class="desc"><i class="icon-arrow-down"></i><span>0.32%</span></small></h4>
                        </div>
                    </div>
                </div>
            </section>
            <section class="ps-card ps-card--top-country">
                <div class="ps-card__header">
                    <h4>Top Countries</h4>
                </div>
                <div class="ps-card__content">
                    <div class="row">
                        <div class="col-6">
                            <figure class="organge">
                                <figcaption>United States</figcaption><strong>80%</strong>
                            </figure>
                        </div>
                        <div class="col-6">
                            <figure class="red">
                                <figcaption>United Kingdom</figcaption><strong>65%</strong>
                            </figure>
                        </div>
                        <div class="col-6">
                            <figure class="green">
                                <figcaption>Germany</figcaption><strong>65%</strong>
                            </figure>
                        </div>
                        <div class="col-6">
                            <figure class="cyan">
                                <figcaption>Russia</figcaption><strong>35%</strong>
                            </figure>
                        </div>
                    </div><img src="img/map-and-bundle.png" alt="">
                    <p>We only started collecting region data from January 2015</p>
                </div>
            </section>
        </div>
    </section>
@endsection
