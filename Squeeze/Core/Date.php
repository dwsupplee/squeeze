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

  /**
   * __construct
   * Set the date that we'll be running operations on later.
   * If none is supplied a new instance of DateTime will be used.
   * @param DateTime|null $date
   * @return null
   * @access public
   */
  public function __construct(DateTime $date = null)
  {
    if(is_null($date))
    {
      $this->date = new \DateTime;
    }
    else {
      $this->date = $date;
    }
  }

  /**
   * getDate
   * Return the stored Date object.
   * @return DateTime
   * @access public
   */
  public function getDate()
  {
    return $this->date;
  }

  /**
   * getWeekDateRange
   * Returns an array of DateTime objects
   * `start_date` is the beginning of the week
   * `end_date` is the end of the week.
   * @return array
   * @access public
   */
  public function getWeekDateRange()
  {
    $startDate = $this->date->modify('midnight');
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