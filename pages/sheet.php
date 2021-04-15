<?php
class sheet {
var $i,$a,$n,$x,$d,$l,$b,$h;
function sheet($id){	$this->i=$id;
    $q=mysql_query("SELECT * FROM sh WHERE i='$id'");
	$row=mysql_fetch_assoc($q);
	$this->a=$row['A'];
	$this->n=$row['N'];
	$this->x=$row['X'];
	$this->d=$row['D'];
	$this->l=$row['L'];
	$this->b=json_decode($row['B']);
	$this->h=json_decode($row['H']);
}
function addRow($row){ if($this->b->tabl=='') $this->b->tabl[]=$row;
 else  array_push($this->b->tabl,$row);
}
function save(){
      $r=@mysql_query("UPDATE sh SET n='".$this->n."',d='".$this->d."',b='".$this->jsonFixCyr(addslashes(json_encode($this->b)))."' WHERE i=".$this->i);
}
function addHistory($sobitie){ if($this->h=='') $this->h[]=$sobitie;
 else  array_unshift($this->h,$sobitie);
 $this->saveHistory();
}
function saveHistory(){
      $r=@mysql_query("UPDATE sh SET h='".$this->jsonFixCyr(addslashes(json_encode($this->h)))."' WHERE i=".$this->i." ");
}
function jsonFixCyr($json_str) {
     $cyr_chars = array (
         '\u0430' => 'а', '\u0410' => 'А',
         '\u0431' => 'б', '\u0411' => 'Б',
         '\u0432' => 'в', '\u0412' => 'В',
         '\u0433' => 'г', '\u0413' => 'Г',
         '\u0434' => 'д', '\u0414' => 'Д',
         '\u0435' => 'е', '\u0415' => 'Е',
         '\u0451' => 'ё', '\u0401' => 'Ё',
         '\u0436' => 'ж', '\u0416' => 'Ж',
         '\u0437' => 'з', '\u0417' => 'З',
         '\u0438' => 'и', '\u0418' => 'И',
         '\u0439' => 'й', '\u0419' => 'Й',
         '\u043a' => 'к', '\u041a' => 'К',
         '\u043b' => 'л', '\u041b' => 'Л',
         '\u043c' => 'м', '\u041c' => 'М',
         '\u043d' => 'н', '\u041d' => 'Н',
         '\u043e' => 'о', '\u041e' => 'О',
         '\u043f' => 'п', '\u041f' => 'П',
         '\u0440' => 'р', '\u0420' => 'Р',
         '\u0441' => 'с', '\u0421' => 'С',
         '\u0442' => 'т', '\u0422' => 'Т',
         '\u0443' => 'у', '\u0423' => 'У',
         '\u0444' => 'ф', '\u0424' => 'Ф',
         '\u0445' => 'х', '\u0425' => 'Х',
         '\u0446' => 'ц', '\u0426' => 'Ц',
         '\u0447' => 'ч', '\u0427' => 'Ч',
         '\u0448' => 'ш', '\u0428' => 'Ш',
         '\u0449' => 'щ', '\u0429' => 'Щ',
         '\u044a' => 'ъ', '\u042a' => 'Ъ',
         '\u044b' => 'ы', '\u042b' => 'Ы',
         '\u044c' => 'ь', '\u042c' => 'Ь',
         '\u044d' => 'э', '\u042d' => 'Э',
         '\u044e' => 'ю', '\u042e' => 'Ю',
         '\u044f' => 'я', '\u042f' => 'Я',

         '\r' => '',
         '\n' => '<br />',
         '\t' => ''
     );
     foreach ($cyr_chars as $cyr_char_key => $cyr_char) {
         $json_str = str_replace($cyr_char_key, $cyr_char, $json_str);
     }
     return $json_str;
 }


} // sheet

function rusDate() {
     $translate = array(
     "am" => "дп",
     "pm" => "пп",
     "AM" => "ДП",
     "PM" => "ПП",
     "Monday" => "Понедельник",
     "Mon" => "Пн",
     "Tuesday" => "Вторник",
     "Tue" => "Вт",
     "Wednesday" => "Среда",
     "Wed" => "Ср",
     "Thursday" => "Четверг",
     "Thu" => "Чт",
     "Friday" => "Пятница",
     "Fri" => "Пт",
     "Saturday" => "Суббота",
     "Sat" => "Сб",
     "Sunday" => "Воскресенье",
     "Sun" => "Вс",
     "January" => "Январь",
     "Jan" => "Янв",
     "February" => "Февраль",
     "Feb" => "Фев",
     "March" => "Март",
     "Mar" => "Мар",
     "April" => "Апрель",
     "Apr" => "Апр",
     "May" => "Май",
     "May" => "Май",
     "June" => "Июнь",
     "Jun" => "Июн",
     "July" => "Июль",
     "Jul" => "Июл",
     "August" => "Август",
     "Aug" => "Авг",
     "September" => "Сентябрь",
     "Sep" => "Сен",
     "October" => "Октябрь",
     "Oct" => "Окт",
     "November" => "Ноябрь",
     "Nov" => "Ноя",
     "December" => "Декабрь",
     "Dec" => "Дек",
     "st" => "ое",
     "nd" => "ое",
     "rd" => "е",
     "th" => "ое"
     );

     if (func_num_args() > 1) {
         $timestamp = func_get_arg(1);
         return strtr(date(func_get_arg(0), $timestamp), $translate);
     } else {
         return strtr(date(func_get_arg(0)), $translate);
    }
 }

function dateAdd($interval, $number, $date) {

    $date_time_array = getdate($date);
    $hours = $date_time_array['hours'];
    $minutes = $date_time_array['minutes'];
    $seconds = $date_time_array['seconds'];
    $month = $date_time_array['mon'];
    $day = $date_time_array['mday'];
    $year = $date_time_array['year'];

    switch ($interval) {

        case 'yyyy':
            $year+=$number;
            break;
        case 'q':
            $year+=($number*3);
            break;
        case 'm':
            $month+=$number;
            break;
        case 'y':
        case 'd':
        case 'w':
            $day+=$number;
            break;
        case 'ww':
            $day+=($number*7);
            break;
        case 'h':
            $hours+=$number;
            break;
        case 'n':
            $minutes+=$number;
            break;
        case 's':
            $seconds+=$number;
            break;
    }
       $timestamp= mktime($hours,$minutes,$seconds,$month,$day,$year);
    return $timestamp;
}

?>