<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('format_kirim'))
{
	function format_kirim($link)	
	{
		$aplikasi = 'IAS PREPAID METERING SYSTEM';
		$datalink = $aplikasi.'IPMS'.file_get_contents($link).'IPMS'.$aplikasi;
		$data = base64_encode($datalink);
		return $data;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('format_terima'))
{
	function format_terima($data)	
	{
		$databaru = array();
		$dataterima = base64_decode($data);
		$databaru	= explode("IPMS",$dataterima);
		$dataasli	= $databaru[1];		
		return $dataasli;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('ims_base64_encode'))
{
	function ims_base64_encode($a,$b,$c)	
	{
		$d = date('YmdHis');
		$data = $a.''.$b.''.$d.''.$c;
		$dbacak = base64_encode($data);
		$dbacak1 = substr($dbacak,0,5);
		$dbacak2 = substr($dbacak,5,5);	
		$dbacak3 = substr($dbacak,10,5);		
		$dbacak4 = substr($dbacak,15,5);	
		$dbacak5 = substr($dbacak,20,-4);	
		$dbacak6 = substr($dbacak,-4);
		$dtencode = $dbacak2.''.$dbacak5.''.$dbacak1.''.$dbacak4.''.$dbacak3.''.$dbacak6;	
		return $dtencode;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('ims_base64_decode'))
{
	function ims_base64_decode($base)	
	{
		$dbacak	 = substr($base,-19);			
		$dbacak1 = substr($dbacak,0,5);	
		$dbacak2 = substr($base,0,5);
		$dbacak3 = substr($dbacak,10,5);	
		$dbacak4 = substr($dbacak,5,5);		
		$dbacak5 = substr($base,5,-19);		
		$dbacak6 = substr($base,-4);
		$dtterima = $dbacak1.''.$dbacak2.''.$dbacak3.''.$dbacak4.''.$dbacak5.''.$dbacak6;
		$dtdecode = base64_decode($dtterima);	
		return $dtdecode;
	}
}


// ------------------------------------------------------------------------

if ( ! function_exists('crc16'))
{

    function crc16($data)
     {
       $crc = 0xFFFF;
       for ($i = 0; $i < strlen($data); $i++)
       {
         $x = (($crc >> 8) ^ ord($data[$i])) & 0xFF;
         $x ^= $x >> 4;
         $crc = (($crc << 8) ^ ($x << 12) ^ ($x << 5) ^ $x) & 0xFFFF;
       }
	   $crc = dechex($crc);
	   $crc = str_pad($crc,4,'0',STR_PAD_LEFT);
       return $crc;
     }
}

if ( ! function_exists('buangspasi'))
{

    function buangspasi($teks){
      $teks= trim($teks);
      while( strpos($teks, ' ') ){
      $hasil= str_replace(' ', '', $teks);
      }
      return $teks;
    }

}



if ( ! function_exists('tanggaltoken'))
{

    function tanggaltoken($tanggal){
      
      $dd = substr($tanggal,0,2);
      $mm = substr($tanggal,3,2);
      $yy = substr($tanggal,6,4);
      $HH = substr($tanggal,11,2);
      $ii = substr($tanggal,14,2);
      $ss = substr($tanggal,17,2);
      
      $date = $yy.'-'.$mm.'-'.$dd.' '.$HH.':'.$ii.':'.$ss;
      return $date;
    }

}

// ------------------------------------------------------------------------

if ( ! function_exists('getip'))
{
	function getip()	
	{
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      		$ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
          	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else{
          	$ip=$_SERVER['REMOTE_ADDR'];
        }	
		return $ip;
	}
}



// ------------------------------------------------------------------------

if ( ! function_exists('gethostname'))
{
	function gethostname()	
	{
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		return $hostname;
	}
}

// ------------------------------------------------------------------------


