<?php declare(strict_types=1);
/**
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2018-2019 Jacques Marneweck.  All rights strictly reserved.
 */

namespace Jacques\Phoenix;

use Carbon\Carbon;

class Date
{
    /**
     * If we expect a minimum date when a column is set to 0000-00-00 00:00:00 we
     * set the date to that minimum date.
     *
     * @param string $start_date
     * @param string $min_date
     * @param string $date_format
     *
     * @return  \Carbon\Carbon
     */
    public static function dateAfterMinOrMin(?string $the_date, string $min_date, string $date_format): \Carbon\Carbon
    {
        try {
            $the_date = Carbon::createFromFormat($date_format, $the_date);

            /**
             * When a date is 0000-00-00 00:00:00 we have over 24000 months in the
             * dropdown list of months to choose from.
             */
            $min_date = Carbon::createFromFormat($date_format, $min_date);
            if ($the_date->lt($min_date)) {
                $the_date = $min_date->clone();
            }
        } catch (\Exception $e) {
            $the_date = Carbon::now()->startOfMonth();
        }

        return $the_date;
    }

    /**
     * Return a list of months from a start date returning the last x months.
     *
     * @param string $start_date
     * @param int    $max
     *
     * @return array
     */
    public static function monthsFromDate(string $start_date, int $max)
    {
        $months = [];

        $start = Carbon::createFromFormat('Y-m-d H:i:s', $start_date);
        $end = Carbon::now()->endOfMonth();

        $date = $start->copy();
        while (!$date->gte($end)) {
            $months[] = ['month_name' => $date->format('F Y'), 'month_yyyymm' => $date->format('Y-m')];
            $date->addMonth();
        }

        $months = array_reverse($months);
        while (sizeof($months) > 3) {
            array_pop($months);
        }
        return $months;
    }
}
