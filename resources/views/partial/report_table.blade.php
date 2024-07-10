@if(!empty($rows) || (isset($rows) && !is_array($rows) && !is_null($rows) && !$rows->isEmpty()))
    {{-- Report Table --}}
    <table class="lr-table {!! $cssClasses['lr-table']??'' !!}">
        {{-- Column Titles --}}
        @if(!empty($colTitles))
            <thead>
            <tr class="{!! $cssClasses['lr-thead-tr']??'' !!}">
                {{-- Blank first column to avoid Google Chrome print issue where 1st column is removed! --}}
                <td style="width: 1px;padding:0;"></td>
                @if(!empty($rowTitles))
                    {{-- Blank first column title when there will be row titles --}}
                    <td class="{!! $cssClasses['lr-thead-td']??'' !!}">&nbsp;</td>
                @endif
                @foreach ($colTitles as $colTitle)
                    <td class="{!! $cssClasses['lr-thead-td']??'' !!}">{!! $colTitle !!}</td>
                @endforeach
            </tr>
            </thead>
        @endif
        {{-- Table Body Contents --}}
        <tbody>
        {{-- Rows --}}
        @foreach($rows as $key => $row)
            <tr class="{!! $cssClasses['lr-tr']??'' !!}">
                {{-- Blank first column to avoid Google Chrome print issue where 1st column is removed! --}}
                <td style="width: 1px;padding:0;"></td>
                {{-- Row Title --}}
                @if(!empty($rowTitles))
                    <td class="lr-row-title {!! $cssClasses['lr-row-title']??'' !!}">
                        {!! ($rowTitles[$key]??'') !!}
                    </td>
                @endif
                {{-- Cells, Values, Table Contents --}}
                @foreach($row as $cellValue)
                    <td class="{!! $cssClasses['lr-td']??'' !!}">
                        {!! $cellValue !!}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        {{-- Table Footer Contents --}}
        <tfoot>
        {{-- Footer Cells --}}
        @foreach($footerRows as $key => $footerRow)
            <tr class="{!! $cssClasses['lr-tfoot-tr']??'' !!}">
                {{-- Blank first column to avoid Google Chrome print issue where 1st column is removed! --}}
                <td style="width: 1px;padding:0;"></td>
                {{-- Row Title --}}
                @if(!empty($footerRowTitles))
                    <td class="lr-tfoot-row-title {!! $cssClasses['lr-tfoot-row-title']??'' !!}">
                        {!! ($footerRowTitles[$key]??'') !!}
                    </td>
                @endif
                @foreach($footerRow as $cellValue)
                    <td class="{!! $cssClasses['lr-tfoot-td']??'' !!}">
                        {!! $cellValue !!}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tfoot>
    </table>
@else
    <div class="lr-no-results-message {!! $cssClasses['lr-no-results-message']??'' !!}">
        {!! (isset($noResultsMessage) ? $noResultsMessage : 'No Results.') !!}
    </div>
@endif
