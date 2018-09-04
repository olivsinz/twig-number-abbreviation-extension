<?php

namespace olivers\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 *
 * This Twig extension to create abbreviation of number.
 *
 */
class NumberAbbreviationExtension extends AbstractExtension
{

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new TwigFilter('exact_abbr', array($this, 'exactAbbreviation')),
            new TwigFilter('general_abbr', array($this, 'generalAbbreviation')),
        );
    }

    /**
     * Function that converts a numeric value into an exact abbreviation.
     * If you are willing to display exactly the abbreviation of the providen
     * number, this function will do the trick
     *
     * @param integer
     *
     * @return string
     */
    public function exactAbbreviation($number, $precision = 1)
    {
        if (!is_numeric($number)) {
          return "\"" . $number . "\"" . ' is not a numeric.';
        }

        // $number = intval($number);
        if ($number < 900) {
          //  0 - 900
          $number_format = number_format($number, $precision);
          $suffix = '';
        } else if ($number < 900000){
          // 0.9k - 850k
          $number_format = number_format($number / 1000, $precision);
          $suffix = 'K';
        } else if ($number < 900000000) {
          //0.9m - 850m
          $number_format = number_format($number / 1000000, $precision);
          $suffix = 'M';
        } else if ($number < 900000000000) {
          # 0.9b - 850b
          $number_format = number_format($number / 1000000000, $precision);
          $suffix = 'B';
        } else {
          # 0.9t+
          $number_format = number_format($number / 1000000000000, $precision);
          $suffix = 'T';
        }

        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ( $precision > 0 ) {
      		$dotzero = '.' . str_repeat( '0', $precision );
      		$number_format = str_replace( $dotzero, '', $number_format );
      	}
      	return $number_format . $suffix;
    }

    /**
     * If you are willing to display only the important part of the providen
     * number (without exact group of thousand), this function will do the trick
     *
     * @param integer $number
     *
     * @return string
     */
    public function generalAbbreviation($number)
    {
        if (!is_numeric($number)) {
          return $number . ' is not a numeric.';
        }

        if ($number > 0 && $number < 1000) {
          # 1 - 999
          $number_format = floor($number);
          $suffix = '';
        } else if ($number >= 1000 && $number < 1000000) {
          # 1k - 999999
          $number_format = floor($number / 1000);
          $suffix = 'K+';
        } else if ($number >= 1000000 && $number < 1000000000) {
          # 1m - 999m
          $number_format = floor($number / 1000000);
          $suffix = 'M+';
        } else if ($number >= 1000000000 && $number < 1000000000000) {
          # 1b - 999b
          $number_format = floor($number / 1000000000);
          $suffix = 'B+';
        } else if ($number >= 1000000000000) {
          # 1t+
          $number_format = floor($number / 1000000000000);
          $suffix = 'T+';
        }

        return !empty($number_format . $suffix) ? $number_format . $suffix : 0;
    }
}
