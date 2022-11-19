<?php
    function get_time_diff($start_time, $end_time) {
        $interval = date_diff($start_time, $end_time);
        $interval_str = '';
        if($interval->format('%y') === '0') {
            if($interval->format('%m') === '0') {
                if($interval->format('%d') === '0') {
                    if($interval->format('%h') === '0') {
                        if($interval->format('%i') === '0') {
                            //Seconds
                            $interval_str = $interval->format('%s');
                            if($interval_str === '1') {
                                $interval_str .= ' second';
                            }
                            else {
                                $interval_str .= ' seconds';
                            }
                        }
                        else {
                            //minutes
                            $interval_str = $interval->format('%i');
                            if($interval_str === '1') {
                                $interval_str .= ' minute';
                            }
                            else {
                                $interval_str .= ' minutes';
                            }
                        }
                    }
                    else {
                        //hours
                        $interval_str = $interval->format('%h');
                        if($interval_str === '1') {
                            $interval_str .= ' hour';
                        }
                        else {
                            $interval_str .= ' hours';
                        }
                    }
                }
                else {
                    //days
                    $interval_str = $interval->format('%d');
                    if($interval_str === '1') {
                        $interval_str .= ' day';
                    }
                    else {
                        $interval_str .= ' days';
                    }
                }
            }
            else {
                //months
                $interval_str = $interval->format('%m');
                if($interval_str === '1') {
                    $interval_str .= ' month';
                }
                else {
                    $interval_str .= ' months';
                }
            }
        }
        else {
            //years
            $interval_str = $interval->format('%y');
            if($interval_str === '1') {
                $interval_str .= ' year';
            }
            else {
                $interval_str .= ' years';
            }
        }
        return $interval_str;
    }
?>