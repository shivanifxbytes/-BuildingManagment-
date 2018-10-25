<?php
/**
* @DateOfCreation         23 Aug 2018
* @ShortDescription       Return the Html according to the status provided from view
* @return                 Response
*/
function showStatus($status)
{
    $val = '';
    switch ($status) {
        case '1':
        $val = "<p style='color:green'>Active</p>";
        break;
        case '0':
        $val = "<p style='color:red'>Deactive</p>";
        break;
    }
    return $val;
}

/**
 * @DateOfCreation         23 Aug 2018
 * @ShortDescription       Return the Html according to the status provided from view
 * @return                 Response
 */
function showMaintainenceStatus($status)
{
    $val = '';
    switch ($status) {
        case '1':
        $val = "<p style='color:green'>Paid</p>";
        break;
        case '0':
        $val = "<p style='color:red'>Unpaid</p>";
        break;
         case '2':
        $val = "<p style='color:blue'>Partially Paid</p>";
        break;
        default:
                $val = "<p style='color:red'>Unpaid</p>";

        break;

    }
    return $val;
}
/**
* @DateOfCreation         23 Aug 2018
* @ShortDescription       Return the Html according to the month provided from view
* @return                 Response
*/
function showMonth($month)
{
    $val = '';
    switch ($month) {
        case '1':
            $val = "January";
            break;
            case '2':
            $val = "February";
            break;
            case '3':
            $val = "March";
            break;
            case '4':
            $val = "April";
            break;
            case '5':
            $val = "May";
            break;
            case '6':
            $val = "June";
            break;
            case '7':
            $val = "July";
            break;
            case '8':
            $val = "August";
            break;
            case '9':
            $val = "September";
            break;
            case '10':
            $val = "October";
            break;
            case '11':
            $val = "November";
            break;
            case '12':
            $val = "December";
            break;
            }
    return $val;
}
