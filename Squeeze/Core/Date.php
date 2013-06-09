<?php

namespace Squeeze\Core;
/**
 * Date
 * Date Helper Functions
 */
class Date
{

  /**
   * @access private
   * @var object DateTime
   */
  private $date;

  public function __construct(DateTime $date = null)
  {
    if(is_null($date))
    {
      $this->date = new \DateTime;
      $this->date->modify('midnight');
    }
    else {
      $this->date = $date;
    }
  }

  public function getDate()
  {
    return $this->date;
  }

  public function getWeekDateRange()
  {
    $startDate = $this->date;
    if($startDate->format('l') !== 'Sunday')
    {
      $startDate = $this->date->modify('last Sunday');
    }

    $endDate = clone $startDate;
    $endDate->modify('+7 days');
    return array(
      'start_date' => $startDate,
      'end_date' => $endDate
    );
  }
}