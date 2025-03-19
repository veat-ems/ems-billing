<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('tgl_indo'))
{
	function tgl_indo($tanggal)	
	{
		$tgl=substr($tanggal,8,2);
		$bln=substr($tanggal,5,2);
		$thn=substr($tanggal,0,4);
		$awal="$tgl-$bln-$thn";
		return $awal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('tgl_indodikit'))
{
	function tgl_indodikit($tanggal)	
	{
		
    	$tgl=substr($tanggal,8,2);
    	$bln=substr($tanggal,5,2);
    	  if($bln=="01"){
    		$namabln = "Jan";
    		}
    	  elseif($bln=="02"){
    		$namabln = "Feb";
    		}
    	  elseif($bln=="03"){
    		$namabln = "Mar";
    		}
    	  elseif($bln=="04"){
    		$namabln = "Apr";
    		}
    	  elseif($bln=="05"){
    		$namabln = "Mei";
    		}
    	  elseif($bln=="06"){
    		$namabln = "Jun";
    		}
    	  elseif($bln=="07"){
    		$namabln = "Jul";
    		}
    	  elseif($bln=="08"){
    		$namabln = "Agus";
    		}
    	  elseif($bln=="09"){
    		$namabln = "Sep";
    		}
    	  elseif($bln=="10"){
    		$namabln = "Okt";
    		}
    	  elseif($bln=="11"){
    		$namabln = "Nop";
    		}
    	  elseif($bln=="12"){
    		$namabln = "Des";
    		}
    
    	$thn=substr($tanggal,0,4);
    	$awal="$tgl-$namabln-$thn";
    	return $awal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('tgl_indolengkap'))
{
	function tgl_indolengkap($tanggal)	
	{
		
    	$tgl=substr($tanggal,8,2);
    	$bln=substr($tanggal,5,2);
    	  if($bln=="01"){
    		$namabln = "Januari";
    		}
    	  elseif($bln=="02"){
    		$namabln = "Februari";
    		}
    	  elseif($bln=="03"){
    		$namabln = "Maret";
    		}
    	  elseif($bln=="04"){
    		$namabln = "April";
    		}
    	  elseif($bln=="05"){
    		$namabln = "Mei";
    		}
    	  elseif($bln=="06"){
    		$namabln = "Juni";
    		}
    	  elseif($bln=="07"){
    		$namabln = "Juli";
    		}
    	  elseif($bln=="08"){
    		$namabln = "Agustus";
    		}
    	  elseif($bln=="09"){
    		$namabln = "September";
    		}
    	  elseif($bln=="10"){
    		$namabln = "Oktober";
    		}
    	  elseif($bln=="11"){
    		$namabln = "Nopember";
    		}
    	  elseif($bln=="12"){
    		$namabln = "Desember";
    		}
    
    	$thn=substr($tanggal,0,4);
    	$awal="$tgl $namabln $thn";
    	return $awal;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('bln_indolengkap'))
{
	function bln_indolengkap($tanggal)	
	{
		
    	$bln=substr($tanggal,5,2);
    	  if($bln=="01"){
    		$namabln = "Januari";
    		}
    	  elseif($bln=="02"){
    		$namabln = "Februari";
    		}
    	  elseif($bln=="03"){
    		$namabln = "Maret";
    		}
    	  elseif($bln=="04"){
    		$namabln = "April";
    		}
    	  elseif($bln=="05"){
    		$namabln = "Mei";
    		}
    	  elseif($bln=="06"){
    		$namabln = "Juni";
    		}
    	  elseif($bln=="07"){
    		$namabln = "Juli";
    		}
    	  elseif($bln=="08"){
    		$namabln = "Agustus";
    		}
    	  elseif($bln=="09"){
    		$namabln = "September";
    		}
    	  elseif($bln=="10"){
    		$namabln = "Oktober";
    		}
    	  elseif($bln=="11"){
    		$namabln = "Nopember";
    		}
    	  elseif($bln=="12"){
    		$namabln = "Desember";
    		}
    
    	$thn=substr($tanggal,0,4);
    	$awal="$namabln $thn";
    	return $awal;
	}
}




// ------------------------------------------------------------------------

if ( ! function_exists('bln_indodikit'))
{
	function bln_indodikit($tanggal)	
	{
		
    	$bln=substr($tanggal,5,2);
    	  if($bln=="01"){
    		$namabln = "Jan";
    		}
    	  elseif($bln=="02"){
    		$namabln = "Feb";
    		}
    	  elseif($bln=="03"){
    		$namabln = "Mar";
    		}
    	  elseif($bln=="04"){
    		$namabln = "Apr";
    		}
    	  elseif($bln=="05"){
    		$namabln = "Mei";
    		}
    	  elseif($bln=="06"){
    		$namabln = "Jun";
    		}
    	  elseif($bln=="07"){
    		$namabln = "Jul";
    		}
    	  elseif($bln=="08"){
    		$namabln = "Ags";
    		}
    	  elseif($bln=="09"){
    		$namabln = "Sep";
    		}
    	  elseif($bln=="10"){
    		$namabln = "Okt";
    		}
    	  elseif($bln=="11"){
    		$namabln = "Nop";
    		}
    	  elseif($bln=="12"){
    		$namabln = "Des";
    		}
    
    	$thn=substr($tanggal,0,4);
    	$awal="$namabln $thn";
    	return $awal;
	}
}





// ------------------------------------------------------------------------
