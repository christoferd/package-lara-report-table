<div id="{!! $topLocationId !!}" class="lr-shell {!! $cssClasses['shell']??'' !!}">
    <div class="{!! $cssClasses['lr-header-shell']??'' !!}">
        @if(!empty($reportTitles))
            <div class="lr-header-titles {!! $cssClasses['lr-header-titles']??'' !!}">
                @foreach($reportTitles as $i => $title)
                    {{-- Title --}}
                    <div class="lr-title {!! $cssClasses['lr-title'][$i]??'' !!}">{!! $title !!}</div>
                @endforeach
            </div>
        @endif
        <div class="{!! $cssClasses['lr-header-actions']??'' !!}">
            @include('package-lara-report-table::partial.report_download_menu')
        </div>
    </div>

    {{-- Links --}}
    @if(!empty($totals) && !empty($showLinkJumpToTotals))
        <div class="lr-jump-to-totals {!! $cssClasses['lr-jump-to-totals']??'' !!}">
            <a href="#lrReportTotals {!! $cssClasses['lr-jump-to-totals-a']??'' !!}">Totals</a>
        </div>
    @endif

    {{-- Report Table --}}
    <div class="lr-table">
        @include('package-lara-report-table::partial.report_table')
    </div>

    {{-- Report Totals --}}
    @if(!empty($totals))
        <div id="{!! $totalsLocationId !!}" class="lr-report-totals {!! $cssClasses['lr-report-totals']??'' !!}">
            @foreach($totals as $totalsTitle => $totalsRows)
                @if(!empty($totalsRows))
                    <div class="lr-report-totals-title {!! $cssClasses['lr-report-totals-title']??'' !!}">
                        {!! $totalsTitle !!}
                    </div>
                    <table class="{!! $cssClasses['lr-report-totals-table']??'' !!}">
                        @foreach($totalsRows as $key => $value)
                            <tr class="{!! $cssClasses['lr-report-totals-tr']??'' !!}">
                                {{-- Blank first column to avoid Google Chrome print issue where 1st column is removed! --}}
                                <td style="width: 1px;padding:0;"></td>
                                <td class="{!! $cssClasses['lr-report-totals-td']??'' !!} {!! $cssClasses['lr-report-totals-label']??'' !!}">{!! $key !!}</td>
                                <td class="{!! $cssClasses['lr-report-totals-td']??'' !!} {!! $cssClasses['lr-report-totals-value']??'' !!}">{!! $value !!}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            @endforeach
        </div>
    @endif

    @if(!empty($rows) && !empty($showBackToTopLink))
        <div class="lr-jump-to-top {!! $cssClasses['lr-jump-to-top']??'' !!}">
            <a href="#lrReportTop" class="{!! $cssClasses['lr-jump-to-top-a']??'' !!}">Top</a>
        </div>
    @endif

    {{-- Information --}}
    @if(!empty($information))
        <div class="lr-info {!! $cssClasses['lr-info']??'' !!}">
            <ul class="lr-info-ul {!! $cssClasses['lr-info-ul']??'' !!}">
                @foreach($information as $message)
                    <li class="lr-info-li {!! $cssClasses['lr-info-li']??'' !!}">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
