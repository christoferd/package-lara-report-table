<?php

namespace Christoferd\LaraReportTable;

use Exception;
use Illuminate\Contracts\Support\Arrayable;

class LaraReportTable implements Arrayable
{
    /**
     * Number of data columns expected in $rows
     * Helps addRow() allowing less args to be sent and the function auto fills the rest.
     */
    public ?int $numberOfColumns = null;

    /**
     * Divs that will appear above the table.
     * Use addReportTitle('My Title')
     * Example: ['My Title', 'Another Title', ...]
     */
    public array $reportTitles = [];

    /**
     * Titles for the first column of each row. (Optional)
     */
    public array $rowTitles = [];

    public array $rows = [];

    public array $colTitles = [];

    public string $replaceBlankOrNullColTitlesWith = '&nbsp;';

    public string $replaceBlankOrNullRowTitlesWith = '&nbsp;';

    public string $replaceBlankOrNullFooterRowTitlesWith = '&nbsp;';

    /**
     * Titles for the first column of each footer row. (Optional)
     */
    public array $footerRowTitles = [];

    public array $footerRows = [];

    public array $cssClasses = [
        'lr-shell' => '',
        // Div that wraps all the titles and the download
        'lr-header-shell' => 'flex justify-between items-top gap-6',
        // Titles wrapper div - each title is wrapped with this class
        'lr-header-titles' => '',
        // Header action buttons wrapper
        'lr-header-actions' => 'pt-2',
        // There may be more than one title row/div. One string for each title.
        // e.g. Having only one title: ['text-2xl'],
        // e.g. Having two titles: ['text-2xl font-bold', 'text-xl'],
        'lr-title' => ['text-2xl font-bold', 'text-xl'],
        'lr-jump-to-totals' => 'text-right text-indigo-600',
        'lr-jump-to-totals-a' => '',
        'lr-jump-to-top' => 'text-right text-indigo-600',
        'lr-jump-to-top-a' => '',
        'lr-table' => '',
        'lr-thead-tr' => '',
        'lr-thead-td' => 'px-4 text-right text-gray-800 font-bold',
        'lr-tr' => 'odd:bg-white even:bg-slate-100',
        // The row title will NOT inherit the "td" classes because in most cases the style will be different
        'lr-row-title' => 'text-gray-800 font-medium pl-4',
        'lr-td' => 'px-4 text-right',
        'lr-tfoot-tr' => 'text-right border-t border-gray-300',
        'lr-tfoot-td' => 'px-4',
        // The row title will NOT inherit the "td" classes because in most cases the style will be different
        'lr-tfoot-row-title' => 'text-left text-gray-800 pl-4',
        'lr-no-results-message' => '',
        'lr-report-totals' => 'mt-8',
        'lr-report-totals-title' => 'font-bold text-gray-800 pl-4',
        'lr-report-totals-table' => '',
        'lr-report-totals-tr' => 'odd:bg-white even:bg-slate-100',
        'lr-report-totals-td' => 'px-4',
        // Column 1
        'lr-report-totals-label' => 'text-left font-medium text-gray-800',
        // Column 2
        'lr-report-totals-value' => 'text-right pl-20',
        'lr-info' => 'my-6 px-4 py-3 border rounded',
        'lr-info-ul' => '',
        'lr-info-li' => '',
    ];

    /**
     * HTML id used for jump links.
     */
    public string $topLocationId = 'lrReportTop';

    /**
     * HTML id used for jump links.
     */
    public string $totalsLocationId = 'lrReportTotals';

    /**
     * Arrayable
     */
    public function toArray(): array
    {
        return [
            'showLinkJumpToTotals' => $this->showLinkJumpToTotals,
            'showBackToTopLink' => $this->showBackToTopLink,
            'numberOfColumns' => $this->numberOfColumns,
            'reportTitles' => $this->reportTitles,
            'colTitles' => $this->colTitles,
            'rowTitles' => $this->rowTitles,
            'footerRowTitles' => $this->footerRowTitles,
            'rows' => $this->rows,
            'footerRows' => $this->footerRows,
            'noResultsMessage' => $this->noResultsMessage,
            'cssClasses' => $this->cssClasses,
            'totals' => $this->totals,
            'information' => $this->information,
            'topLocationId' => $this->topLocationId,
            'totalsLocationId' => $this->totalsLocationId,
            'menuLinks' => $this->menuLinks,
        ];
    }

    /**
     * Message to be displayed when there are no results.
     */
    public ?string $noResultsMessage = null;

    /**
     * Totals format example:
     *    [
     *      'Subtotals' => [
     *          'Row Title' => '$999.00',
     *          'Second Row Title' => '$999.00',
     *          ...
     *      ],
     *      'Totals' => [
     *          'Row Title' => '$999.00',
     *          'Second Row Title' => '$999.00',
     *          ...
     *      ],
     *      ...
     *    ]
     */
    public array $totals = [];

    /**
     * Information messages to be displayed below the table.
     *
     * @var array array of strings
     */
    public array $information = [];

    public bool $showLinkJumpToTotals = true;

    public bool $showBackToTopLink = true;

    /**
     * Data used to build the downloads menu
     * cssClasses: (optional) If provided, the default link class will be replaced with 'cssClasses'
     * Example:
     * [ ['label'=>'CSV', 'url'=>'/report-download/my-cash-report', 'cssClasses'=>'px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 '],
     *   [...] ]
     */
    public array $menuLinks = [];

    public function getDownloadLinks(): array
    {
        return $this->menuLinks;
    }

    public function setMenuLinks(array $menuLinks): void
    {
        $this->menuLinks = $menuLinks;
    }

    public function isShowLinkJumpToTotals(): bool
    {
        return $this->showLinkJumpToTotals;
    }

    public function setShowLinkJumpToTotals(bool $boolTF): void
    {
        $this->showLinkJumpToTotals = $boolTF;
    }

    public function isShowBackToTopLink(): bool
    {
        return $this->showBackToTopLink;
    }

    public function setShowBackToTopLink(bool $boolTF): void
    {
        $this->showBackToTopLink = $boolTF;
    }

    public function reset()
    {
        $this->rowTitles = [];
        $this->rows = [];
        $this->numberOfColumns = null;
    }

    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Add $row of information to the $rows
     * Uses: $this->numberOfColumns to automatically fill missing columns of data with nulls.
     *
     * @param  mixed  ...$args  Supports any number of arguments and will add to a new row, automatically filling in the extra spaces with null!
     *                          Supports array. When an array is given, or when an array is the first argument,
     *                          it will add a row using values from the array. (29-Aug-2024)
     *
     * @throws Exception
     */
    public function addRow(...$args): void
    {
        if (isset($args[0]) && is_array($args[0])) {
            $arr = $args[0];
        } else {
            $arr = $args;
        }
        // check col count
        if (! empty($this->numberOfColumns)) {
            if (count($arr) > $this->numberOfColumns) {
                throw new \Exception('Adding row with too many columns. numberOfColumns = '.$this->numberOfColumns);
            } elseif (count($arr) < $this->numberOfColumns) {
                // fill with null values
                for ($i = count($arr), $iend = $this->numberOfColumns; $i < $iend; $i++) {
                    $arr[$i] = null;
                }
            }
        }
        $this->rows[] = $arr;
    }

    /**
     * Add a blank row to the $rows
     *
     * @throws \Exception
     */
    public function addBlankRow(): void
    {
        $this->addRowTitle('');
        if (empty($this->numberOfColumns)) {
            throw new \Exception('$numberOfColumns is required to use '.__FUNCTION__);
        }
        $arr = [];
        for ($i = 0; $i < $this->numberOfColumns; $i++) {
            $arr[] = null;
        }
        $this->addRow($arr);
    }

    /**
     * Add a title to the $rowTitles class array
     *
     * @param  ?string  $title  Blank string or null will be replaced
     * @param  string  $spanClass  HTML Class to place inside <span> tags. Otherwise will just be the value without <span>
     */
    public function addRowTitle(?string $title, string $spanClass = ''): void
    {
        if ($title === '' || $title === null) {
            $this->rowTitles[] = $this->replaceBlankOrNullRowTitlesWith;
        } else {
            if ($spanClass) {
                $title = $this->spanCssWrap($title, $spanClass);
            }
            $this->rowTitles[] = $title;
        }
    }

    /**
     * Add a title to the $footerRowTitles class array
     *
     * @param  ?string  $title  Blank string or null will be replaced
     * @param  string  $spanClass  HTML Class to place inside <span> tags. Otherwise will just be the value without <span>
     */
    public function addFooterRowTitle(?string $title, string $spanClass = ''): void
    {
        if ($title === '' || $title === null) {
            $this->footerRowTitles[] = $this->replaceBlankOrNullFooterRowTitlesWith;
        } else {
            if ($spanClass) {
                $title = $this->spanCssWrap($title, $spanClass);
            }
            $this->footerRowTitles[] = $title;
        }
    }

    public function getFooterRowTitles(): array
    {
        return $this->footerRowTitles;
    }

    /**
     * Add a title to the $colTitles class array
     * Note: this will automatically set the $numberOfColumns to the amount of values in this $colTitles array.
     *
     * @param  ?string  $title  Blank string or null will be replaced
     * @param  string  $spanClass  HTML Class to place inside <span> tags. Otherwise will just be the value without <span>
     */
    public function addColTitle(?string $title, string $spanClass = ''): void
    {
        if ($title === '' || $title === null) {
            $this->colTitles[] = $this->replaceBlankOrNullColTitlesWith;
        } else {
            $this->colTitles[] = $this->spanCssWrap($title, $spanClass);
        }

        $this->setNumberOfColumns(count($this->colTitles));
    }

    public function setColTitles(array $titles, string $spanClass = ''): void
    {
        $this->colTitles = [];
        foreach ($titles as $title) {
            $this->addColTitle($title, $spanClass);
        }
    }

    public function getNumberOfColumns(): ?int
    {
        return $this->numberOfColumns;
    }

    public function setNumberOfColumns(?int $numberOfColumns): void
    {
        $this->numberOfColumns = $numberOfColumns;
    }

    /**
     * Build report table.
     *
     * @throws \Throwable
     */
    public function renderHtml(): string
    {
        // dd($this->toArray());
        return view('package-lara-report-table::finance_report', $this->toArray())->render();
    }

    public function getTotals(): array
    {
        return $this->totals;
    }

    public function setTotals(array $totals): void
    {
        $this->totals = $totals;
    }

    /**
     * Add a section of totals data.
     *
     * @param  string  $sectionTitle  Title to appear above the totals data
     * @param  array  $totalsData  [ key => value, key => value, key => value, key => value, ... ]
     * @return void
     */
    public function addTotals(string $sectionTitle, array $totalsData)
    {
        $this->totals[$sectionTitle] = $totalsData;
    }

    public function addReportTitle(string $title, string $spanCssClass = '')
    {
        $this->reportTitles[] = $this->spanCssWrap($title, $spanCssClass);
    }

    public function getReportTitles(): array
    {
        return $this->reportTitles;
    }

    public function addFooterRow(...$args): void
    {
        $this->footerRows[] = $args;
    }

    /**
     * Wrap $title with <span class="...">
     *     ! NOTE ! Only if $spanClass is not a blank string
     *
     * @param  string|mixed  $title  Something that can be converted to a string!
     * @return string Will just return $title when $spanClass is an empty string.
     */
    protected function spanCssWrap(mixed $title, string $spanClass = ''): string
    {
        if ($spanClass === '') {
            return $title;
        }

        return sprintf('<span class="%s">%s</span>', $spanClass, \strval($title));
    }

    /**
     * Add a message to $information
     *
     * @param  string  $spanClass  HTML Class to place inside <span> tags. Otherwise will just be the value without <span>
     */
    public function addInformation(string $info, string $spanClass = ''): void
    {
        $this->information[] = $this->spanCssWrap($info, $spanClass);
    }

    public function getInformation(): array
    {
        return $this->information;
    }

    public function setCssClass(string $existingCssClassesKey, string $newCssClasses)
    {
        if (! isset($this->cssClasses[$existingCssClassesKey])) {
            throw new \Exception(\class_basename(__CLASS__).' cssClasses Key does not exist: '.$existingCssClassesKey);
        }
        $this->cssClasses[$existingCssClassesKey] = $newCssClasses;
    }

    public function getCssClasses(): array
    {
        return $this->cssClasses;
    }

    /**
     * Generates an array used for building a download file.
     *
     * @param  bool  $stripTags  Strip HTML tags on all titles, values, etc.
     * @return array Array of Arrays
     */
    public function generateDownloadData(bool $stripTags = true): array
    {
        $d = [];

        // Report Titles
        foreach ($this->reportTitles as $title) {
            $d[] = [$title];
        }

        // Table
        // - Header
        // -- Column Titles
        $t = $this->colTitles;
        // ? add blank first cell before col titles?
        if (! empty($this->rowTitles)) {
            \array_unshift($t, '');
        }
        $d[] = $t;

        // - Table Body
        // -- Data Rows
        foreach ($this->rows as $i => $row) {
            $r = $row;
            // ? add title in first cell?
            if (! empty($this->rowTitles)) {
                \array_unshift($r, ($this->rowTitles[$i] ?? ''));
            }
            // add to data
            $d[] = $r;
        }

        // - Table Footer
        foreach ($this->footerRows as $i => $row) {
            $r = $row;
            // ? add title in first cell?
            if (! empty($this->footerRowTitles)) {
                \array_unshift($r, ($this->footerRowTitles[$i] ?? ''));
            }
            // add to data
            $d[] = $r;
        }

        // Blank row
        $d[] = [''];

        // - Report Totals
        foreach ($this->totals as $sectionTitle => $rowsArr) {
            $d[] = [$sectionTitle];
            foreach ($rowsArr as $label => $value) {
                $d[] = [$label, $value];
            }
        }

        // Blank row
        $d[] = [''];

        // - Report Information Messages
        foreach ($this->information as $message) {
            // add to data
            $d[] = [$message];
        }

        // ? Strip HTML Tags ?
        if ($stripTags) {
            foreach ($d as &$dArr) {
                foreach ($dArr as &$val) {
                    if (is_string($val)) {
                        $val = strip_tags($val);
                    }
                }
            }
        }

        return $d;
    }
}
