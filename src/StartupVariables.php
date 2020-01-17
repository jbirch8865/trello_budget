<?php
$calendar_exlude_dates_icon = '<img class = "calendar_icon" src = "../images/calendar.png" height = "20px;" width = "20px;" data-toggle="tooltip" title="Pick dates to exclude">';
$calendar_icon = '<img class = "calendar_icon" src = "../images/calendar.png" height = "20px;" width = "20px;" data-toggle="tooltip" title="Pick a day">';
$cConfigs = new \config\ConfigurationFile();

$flaggers_needed_icon = '<img class = "flaggers_needed_icon" src = "../images/flaggers_needed.png" height = "20px;" width = "20px;"  data-toggle="tooltip" title="This job still has shifts that need workers">';
$job_confirmed_icon = '<img class = "job_confirmed_icon" src = "../images/confirmed.png" height = "20px;" width = "20px;"  data-toggle="tooltip" title="This job has been confirmed">';
$job_unconfirmed_icon = '<img class = "job_unconfirmed_icon" src = "../images/unconfirmed.png" height = "20px;" width = "20px;"  data-toggle="tooltip" title="This job has not been confirmed">';
$clear_job_customer_icon = '<img class = "clear_job_customer_icon" src = "../images/clear.png" height = "20px;" width = "20px;"  data-toggle="tooltip" title="clear customer">';

if(!isset($_SESSION['Add_Info'])){$_SESSION['Add_Info'] = array();}
if(!isset($_SESSION['Add_Warning'])){$_SESSION['Add_Warning'] = array();}

$icon = new \bootstrap\icon();
/////Code Icons
$shift_confirmed = '<img src = "'.$icon->Get_File_Name_From_Code_ID(1).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Shift Confirmed">';
$white_clipboard_icon = '<img class = "cursor_pointer white_clipboard" src = "'.$icon->Get_File_Name_From_Code_ID(2).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Add a note">';
$white_dollar_icon = '<img class = "white_dollar" src = "'.$icon->Get_File_Name_From_Code_ID(3).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Prevailing Wage">';
$starting_program_has_icon_number = 4;
while($starting_program_has_icon_number < 12)
{
    $variable_name = "number_of_shifts".$starting_program_has_icon_number;
    $$variable_name = '<img class = "" src = "'.$icon->Get_File_Name_From_Code_ID($starting_program_has_icon_number).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="#">';
    $starting_program_has_icon_number = $starting_program_has_icon_number + 1;
}
$person_has_multiple_shifts = '<img class = "" src = "'.$icon->Get_File_Name_From_Code_ID(12).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Person Has Multiple Shifts">';
$assumed_available = '<img class = "schedule_icon" src = "'.$icon->Get_File_Name_From_Code_ID(13).'" height = "35px;" width = "35px;" data-toggle="tooltip" title="I know this flagger is going to be available">';
$available_icon = '<img class = "schedule_icon" src = "'.$icon->Get_File_Name_From_Code_ID(14).'" height = "35px;" width = "35px;" data-toggle="tooltip" title="This flagger is available for work today">';
$unavailable_icon = '<img class = "schedule_icon" src = "'.$icon->Get_File_Name_From_Code_ID(15).'" height = "35px;" width = "35px;" data-toggle="tooltip" title="Flagger is not available for work">';
$green_send_sms_icon = '<img class = "schedule_icon" src = "'.$icon->Get_File_Name_From_Code_ID(16).'" height = "35px;" width = "35px;" data-toggle="tooltip" title="Still need to reach out to flagger">';
$waiting_for_reply_icon = '<img class = "schedule_icon" src = "'.$icon->Get_File_Name_From_Code_ID(17).'" height = "35px;" width = "35px;" data-toggle="tooltip" title="Haven\'t heard back from flagger yet.">';
if($cConfigs->Is_Feature_Enabled('eastereggs'))
{
    $setup_icon = '<img class = "setup_icon" src = "../images/setup.png" height = "20px;" width = "20px;" data-toggle="tooltip" title="This is a setup job, likely not needing an actual flagger but instead a pawn not worthy of mattering in the grand scheme of things.">';
}else
{
    $setup_icon = '<img class = "setup_icon" src = "'.$icon->Get_File_Name_From_Code_ID(18).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="This is a setup only job.">';
}
$pending_job_icon = '<img class = "pending_icon" src = "'.$icon->Get_File_Name_From_Code_ID(19).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="This job is currently set to tentative">';
$assigned_icon = '<img src = "'.$icon->Get_File_Name_From_Code_ID(20).'" height = "35px;" width = "35px;" data-toggle="tooltip" title="">';
$unassigned_icon = '<img src = "'.$icon->Get_File_Name_From_Code_ID(21).'" height = "35px;" width = "35px;" data-toggle="tooltip" title="Flagger is not currently assigned">';
$confirmed_assignment_icon = '<img src = "'.$icon->Get_File_Name_From_Code_ID(22).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Flagger has confirmed ALL assigned work">';
$Clear_Icon = '<img src = "'.$icon->Get_File_Name_From_Code_ID(24).'" height = "35px;" width = "35px;" data-toggle="tooltip" title="Clear This Field">';
$Unread_SMS = '<span style = "display:none;">Unread</span><img class = "Unread_SMS" src = "'.$icon->Get_File_Name_From_Code_ID(25).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Unread text messages">';
$flagger_details_sent_icon = '<img src = "'.$icon->Get_File_Name_From_Code_ID(26).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Flagger details sent to flagger">';
$number_of_shifts12 = '<img class = "" src = "'.$icon->Get_File_Name_From_Code_ID(27).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="#">';
$need_linked = '<img class = "" src = "'.$icon->Get_File_Name_From_Code_ID(28).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="This need is linked.">';
$expand_icon = '<img class = "details-control" src = "'.$icon->Get_File_Name_From_Code_ID(29).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Expand details">';
$collapse_icon = '<img class = "details-control" src = "'.$icon->Get_File_Name_From_Code_ID(30).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Collapse details">';
$transfer_failed_icon = '<img src = "'.$icon->Get_File_Name_From_Code_ID(31).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Did not transfer anything">';
$transfer_started_icon = '<img src = "'.$icon->Get_File_Name_From_Code_ID(32).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Employee Not Available">';
$transfer_completed_icon = '<img src = "'.$icon->Get_File_Name_From_Code_ID(33).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Transfer Fully Completed">';
$refresh_icon = '<img class = "rounded mr-2" src = "'.$icon->Get_File_Name_From_Code_ID(34).'" height = "20px;" width = "20px;">';
$oos_icon = '<img class = "rounded mr-2" src = "'.$icon->Get_File_Name_From_Code_ID(35).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="This equipment is out of service">';
$iis_icon = '<img class = "rounded mr-2" src = "'.$icon->Get_File_Name_From_Code_ID(36).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="This equipment is in service">';
$expand_company_icon = '<img class = "details-company" src = "'.$icon->Get_File_Name_From_Code_ID(29).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Expand details">';
$collapse_company_icon = '<img class = "details-company" src = "'.$icon->Get_File_Name_From_Code_ID(30).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Collapse details">';
$flagger_need_reconfirmed_icon = '<img src = "'.$icon->Get_File_Name_From_Code_ID(37).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Flagger details changed">';
$welcome_image = '<img src = "'.$icon->Get_File_Name_From_Code_ID(38).'" height = "'.$icon->Get_Height_From_Code_ID(38).'px;" width = "'.$icon->Get_Width_From_Code_ID(38).'px;">';

/////Skills Icons
$flagger_skill_id = $cConfigs->Configurations()['Flagger_Workforce'];
$flagger_icon = '<img src = "'.$icon->Get_File_Name_From_Skill_ID($flagger_skill_id).'" height = "20px;" width = "20px;" data-toggle="tooltip" title="Flagger">';
?>