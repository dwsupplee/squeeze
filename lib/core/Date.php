<?php

/**
 * SQ_Date
 * Date Helper Functions
 */
class SQ_Date {

  /**
   * @access private
   * @var object DateTime
   */
  private $date;

  public function __construct(DateTime $date = null) {
    if(is_null($date)) {
      $this->date = new DateTime;
    }
    else {
      $this->date = $date;
    }
  }

  public function getDate() {
    return $this->date;
  }

  public function getWeekDateRange() {
    var_dump($date);
    $day_of_week = $date->format("w");
    $date->modify("-$day_of_week day");
    print_R($day_of_week);
    print_R($date);
  }
}