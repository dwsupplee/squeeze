<?php

class SQUEEZE_Date {
  private $date;

  public function __construct($date = null) {
    if(is_null($date)) {
      $this->date = date('Y-m-d');
    }
    else {
      $this->date = $date;
    }
  }

  public function getDate() {
    return $this->date;
  }

  public function getWeekDateRange() {
    $getRange = function($date) {
      $ts = strtotime($date);
      $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
      return array(date('Y-m-d', $start),
                   date('Y-m-d', strtotime('next saturday', $start)));
    };

    return $getRange($this->date);
  }
}