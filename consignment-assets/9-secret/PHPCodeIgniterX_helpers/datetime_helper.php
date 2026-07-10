<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  function datetime_getCurrent($format='Y-m-d H:i:s'){
    $temp_dateTime = new DateTime(date('Y-m-d H:i:s'));

    return $temp_dateTime->format($format);
  }

  function datetime_manipulate($date,$modifier){
    $temp_dateTime = new DateTime($date);
    $temp_dateTime->modify($modifier);

    return $temp_dateTime->format('Y-m-d H:i:s');
  }

  function datetime_validate($date, $format = 'Y-m-d H:i:s'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }

?>
