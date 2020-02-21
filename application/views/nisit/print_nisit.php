<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

$post = $this->Post_model->fetch_post_join_print($post_id); //fetch all post in id_user

// print_r("<pre>");
// print_r($post);
// print_r("</pre>");

$nisit = array();
$cou = 0;
foreach ($reg as $r) {
    if ($r['reg_status'] == "allow") {
        $nisit[$cou++] = $this->User_model->fetch_user_id_st_print($r['st_id']);
    }
}

// print_r("<pre>");
// print_r($nisit);
// print_r("</pre>");

// Config
// $title = 'Reg_TA_report';
$photo = base_url('resources/pdf/reg_ta.jpg');  //รูป pdf
$dateToDay = convDate(date("m/j/Y")); // วันที่

$id_subject = $post[0]['sj_id']; // รหัสวิชา
$name_subject = $post[0]['sj_name_thai']; // ชื่อวิชา
$term = $post[0]['poif_term'];
$year = $post[0]['poif_years'];

$section = $post[0]['poif_section'];
$num_nisit_reg = $post[0]['poif_num_st']; // จำนวนนิสิตลงทะเบียน


//NISIT 1
$name_nisit = $nisit[0][0]['st_title'] . $nisit[0][0]['st_name'] . $nisit[0][0]['st_surname']; // EDIT!! ชื่อ
$id_nisit = $nisit[0][0]['st_id']; // EDIT!! รหัสนิสิต

$degree = "ตรี"; // ระดับปริญญา
$years_nisit = (date('Y') + 543) - $nisit[0][0]['st_year']; // EDIT!!
$gpa = $nisit[0][0]['st_gpax']; // EDIT!!
$tel = $nisit[0][0]['st_tel']; // EDIT!!

if ($cou > 1) {
    //NISIT 2
    $name_nisit_2 = $nisit[1][0]['st_title'] . $nisit[1][0]['st_name'] . $nisit[1][0]['st_surname']; // EDIT!! ชื่อ
    $id_nisit_2 = $nisit[1][0]['st_id']; // EDIT!! รหัสนิสิต

    $degree_2 = "ตรี"; // ระดับปริญญา
    $years_nisit_2 = (date('Y') + 543) - $nisit[1][0]['st_year']; // EDIT!!
    $gpa_2 = $nisit[1][0]['st_gpax']; // EDIT!!
    $tel_2 = $nisit[1][0]['st_tel']; // EDIT!!
}


$work_day = day_conv($post[0]['poif_daywork']);
$work_time_start = $post[0]['poif_timework_start']; // EDIT!! เวลาเริ่มปฎิบัติงาน
$work_time_end = $post[0]['poif_timework_end']; // EDIT!! เวลาสิ้นสุดปฎิบัติงาน

$work_day_start = convDate($post[0]['poif_work_start']);
$work_day_end = convDate($post[0]['poif_work_end']);

$teachar_name = $post[0]['tc_name_thai'];



// PDF

$this->fpdf->SetTitle($title);
$this->fpdf->SetAuthor('เอาไงทีม.');

$this->fpdf->Image($photo, 0, 0, 205, 0, 'jpg'); // JPG, JPEG, PNG, GIF Only

$this->fpdf->AddFont('THSarabun', '', 'THSarabunNew.php');

// สำเนา
// $this->fpdf->SetFont('THSarabun', '', 16);
// $this->fpdf->SetXY(165, 10);
// $this->fpdf->Cell(0, 20, iconv('UTF-8', 'TIS-620', 'ก๊อปปี้'), 1, 1, 'C');

// วันที่
$this->fpdf->SetFont('THSarabun', '', 16);
$this->fpdf->SetXY(125, 40);
$this->fpdf->Cell(50, 10, iconv('UTF-8', 'TIS-620', $dateToDay), 0, 1, 'L');

// รหัสวิชา
$this->fpdf->SetXY(55, 75);
$this->fpdf->Cell(18, 10, $id_subject, 0, 1, 'C');

// ชื่อวิชา
if (strlen($name_subject) > 85) {
    $fontSize = 11;
} else {
    $fontSize = 16;
}
$this->fpdf->SetFont('THSarabun', '', $fontSize);
$this->fpdf->SetXY(88, 75);
$this->fpdf->Cell(54, 10, iconv('UTF-8', 'TIS-620', $name_subject), 0, 1, 'C'); // EDITTTTTTTTTT

// ภาคเรียน
$this->fpdf->SetFont('THSarabun', '', 16);
$this->fpdf->SetXY(163, 75);
$this->fpdf->Cell(7, 10, '1', 0, 1, 'C');

// ปีการศึกษา
$this->fpdf->SetXY(173, 75);
$this->fpdf->Cell(20, 10, '2562', 0, 1, 'L');

// ติ้กถูกหมู่เรียน
$this->fpdf->SetFont('THSarabun', '', 16);
$this->fpdf->SetXY(52.5, 100);
$this->fpdf->Cell(7, 10, '/', 0, 1, 'C');

// หมู่เรียน
$this->fpdf->SetXY(83, 99.5);
$this->fpdf->Cell(10, 10, $section, 0, 1, 'C');

// จำนวนนิสิตที่ลงทะเบียน
$this->fpdf->SetXY(135, 99.5);
$this->fpdf->Cell(10, 10, $num_nisit_reg, 0, 1, 'C');


// คนแรก
// ชื่อสกุล
$this->fpdf->SetXY(62, 109);
$this->fpdf->Cell(53, 10, iconv('UTF-8', 'TIS-620', $name_nisit), 0, 1, 'L');

// รหัสนิสิต
$this->fpdf->SetXY(130, 110.5);
$this->fpdf->Cell(30, 7, $id_nisit, 0, 1, 'C');

// ระดับปริญญา
$this->fpdf->SetXY(71, 117.5);
$this->fpdf->Cell(15, 8, iconv('UTF-8', 'TIS-620', $degree), 0, 1, 'C');

// ชั้นปี
$this->fpdf->SetXY(93, 117.5);
$this->fpdf->Cell(10, 8, $years_nisit, 0, 1, 'C');

// เกรดเฉลี่ย
$this->fpdf->SetXY(118, 117.5);
$this->fpdf->Cell(15, 8, $gpa, 0, 1, 'C');

// เบอร์โทร
$this->fpdf->SetXY(153, 117.5);
$this->fpdf->Cell(30, 8, $tel, 0, 1, 'C');

// ปฏิบัติงานทุกวัน
$this->fpdf->SetXY(68, 124.5);
$this->fpdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', $work_day), 0, 1, 'C');

// เวลา เริ่ม
$this->fpdf->SetXY(119, 124.5);
$this->fpdf->Cell(30, 8, $work_time_start, 0, 1, 'C');

// เวลา จบ
$this->fpdf->SetXY(155, 124.5);
$this->fpdf->Cell(30, 8, $work_time_end, 0, 1, 'C');

if ($cou > 1) {

    // คนที่2
    // ชื่อสกุล
    $this->fpdf->SetXY(62, 109 + 24);
    $this->fpdf->Cell(53, 10, iconv('UTF-8', 'TIS-620', $name_nisit_2), 0, 1, 'L');

    // รหัสนิสิต
    $this->fpdf->SetXY(130, 110.5 + 24);
    $this->fpdf->Cell(30, 7, $id_nisit_2, 0, 1, 'C');

    // ระดับปริญญา
    $this->fpdf->SetXY(71, 117.5 + 24);
    $this->fpdf->Cell(15, 8, iconv('UTF-8', 'TIS-620', $degree_2), 0, 1, 'C');

    // ชั้นปี
    $this->fpdf->SetXY(93, 117.5 + 24);
    $this->fpdf->Cell(10, 8, $years_nisit_2, 0, 1, 'C');

    // เกรดเฉลี่ย
    $this->fpdf->SetXY(118, 117.5 + 24);
    $this->fpdf->Cell(15, 8, $gpa_2, 0, 1, 'C');

    // เบอร์โทร
    $this->fpdf->SetXY(153, 117.5 + 24);
    $this->fpdf->Cell(30, 8, $tel_2, 0, 1, 'C');

    // ปฏิบัติงานทุกวัน
    $this->fpdf->SetXY(68, 148.5);
    $this->fpdf->Cell(40, 8, iconv('UTF-8', 'TIS-620', $work_day), 0, 1, 'C');

    // เวลา เริ่ม
    $this->fpdf->SetXY(119, 148.5);
    $this->fpdf->Cell(30, 8, $work_time_start, 0, 1, 'C');

    // เวลา จบ
    $this->fpdf->SetXY(155, 148.5);
    $this->fpdf->Cell(30, 8, $work_time_end, 0, 1, 'C');
}


// ทำงานตั้งแต่วันที่ เริ่ม
$this->fpdf->SetXY(65, 157.5);
$this->fpdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', $work_day_start), 0, 1, 'C');

// ทำงานตั้งแต่วันที่ จบ
$this->fpdf->SetXY(102, 157.5);
$this->fpdf->Cell(30, 8, iconv('UTF-8', 'TIS-620', $work_day_end), 0, 1, 'C');

// ชื่ออาจารย์
$this->fpdf->SetFont('THSarabun', '', 12);
$this->fpdf->SetXY(114, 220.5);
$this->fpdf->Cell(50, 8, iconv('UTF-8', 'TIS-620', $teachar_name), 0, 1, 'C');


$this->fpdf->Output('Reg_TA.pdf', 'I'); // Name of PDF file
//Can change the type from D=Download the file

?>


<?php
function convDate($date)
{
    list($m, $d, $y) = explode("/", "$date");
    $y = ((int) $y) + 543;

    if ($m == "1") {
        $date = "$d มกราคม $y";
    } elseif ($m == "2") {
        $date = "$d กุมภาพันธ์ $y";
    } elseif ($m == "3") {
        $date = "$d มีนาคม $y";
    } elseif ($m == "4") {
        $date = "$d เมษายน $y";
    } elseif ($m == "5") {
        $date = "$d พฤษภาคม $y";
    } elseif ($m == "6") {
        $date = "$d มิถุนายน $y";
    } elseif ($m == "7") {
        $date = "$d กรกฎาคม $y";
    } elseif ($m == "8") {
        $date = "$d สิงหาคม $y";
    } elseif ($m == "9") {
        $date = "$d กันยายน $y";
    } elseif ($m == "10") {
        $date = "$d ตุลาคม $y";
    } elseif ($m == "11") {
        $date = "$d พฤศจิกายน $y";
    } else {
        $date = "$d ธันวาคม $y";
    }
    return "$date";
}

function day_conv($str)
{
    switch ($str) {
        case "Monday":
            return "จันทร์";
        case "Tuesday":
            return "อังคาร";
        case "Wednesday":
            return "พุธ";
        case "Thursday":
            return "พฤหัสบ่ดี";
        case "Friday":
            return "ศุกร์";
        case "Satuday":
            return "เสาร์";
        case "Sunday":
            return "อาทิตย์";
        default:
            return "ไม่ทราบ";
    }
}
?>
