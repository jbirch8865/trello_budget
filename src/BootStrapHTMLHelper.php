<?php
namespace company_program;


class Alerts extends \bootstrap\Alerts
{
    function __construct()
    {
        parent::__construct();
    }

    function Add_Alert($strong_text = "Unknown Error ",$error_message = false,$hault_execution = false)
    {
        $cConfigs = new \gcConfigs;
        if(!$error_message){$error_message = "Terribly sorry, we have experienced an unknown error, please log out and log back in.  If the problem persists please submit a bug report to ".$cConfigs->cConfigs->Get_Value_If_Enabled('onsite_technician');}
        parent::Add_Alert($strong_text,$error_message,$hault_execution);
    }
}
?>