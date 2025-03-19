<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('format_angka'))
{
	function format_angka($angka)	
	{
		$hasil =  number_format($angka,2, ",",".");
		return $hasil;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('format_rupiah'))
{
    function format_rupiah($angka)
    {
		$hasil = 'Rp. '.number_format($angka,2, ",",".");
		return $hasil;
        
    }
}

// ------------------------------------------------------------------------
