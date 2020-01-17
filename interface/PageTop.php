<?php 
  namespace trello_budget;
  header('Cache-Control: max-age=84600');
  require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/ClassLoader.php';
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  $cConfigs = new \gcConfigs;
  $current_user = new \gCurrent_User;
  $aAlerts = new \gaAlerts;
  $System = new \system;
  if(!$System->is_connected())
  {
    $aAlerts->aAlerts->Add_Alert("INTERNET OUTAGE"," ");
  }
  if(empty($_GET['date']))
  {
    $_GET['date'] = date('Y-m-d',strtotime('+1 Days'));
  }else
  {
    $_GET['date'] = date('Y-m-d',strtotime($_GET['date']));
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="images/LogoIcon.jpg">
  <title>D&H Flagging<?php if ($cConfigs->cConfigs->Is_Dev()){echo'-DEV';}?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/lightpick@latest/css/lightpick.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <link href="  https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
  <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />
  <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>
  <script type='text/javascript' src='<?php echo $cConfigs->cConfigs->Get_Vendor_URL();?>/bindWithDelay/bindWithDelay.js'></script>
  <script type='text/javascript' src='<?php echo $cConfigs->cConfigs->Get_Vendor_URL();?>/air-datepicker/dist/js/datepicker.min.js'></script>
  <script type='text/javascript' src='<?php echo $cConfigs->cConfigs->Get_Vendor_URL();?>/air-datepicker/dist/js/i18n/datepicker.en.js'></script>
  <script type='text/javascript' src='<?php echo $cConfigs->cConfigs->Get_Vendor_URL();?>/bootboxer/dist/bootbox.min.js'></script>  
  <link rel="stylesheet" href="<?php echo $cConfigs->cConfigs->Get_Vendor_URL();?>/air-datepicker/dist/css/datepicker.min.css">
  <link rel="stylesheet" href="<?php if(isset($current_dir)){echo $current_dir;}?>style.css">
  
  <script src="<?php if(isset($current_dir)){echo $current_dir;}?>javascriptTop.js"></script>
  
</head>
<body style="background: url('images/background.jpg') no-repeat top/100%, grey;">
<div style = "display: none" id = "images_location"><?php 
    echo $cConfigs->cConfigs->Get_Images_URL();
  ?></div>
<?php
if($cConfigs->cConfigs->Is_Feature_Enabled('save_page_state'))
{
  echo '<div id = "Save_Page_Group" class="btn-group-vertical" role="group" style = "position:fixed;top:75px;left:95%;z-index:2147483638"><img src = "images/unconfirmed.png" height = "35px" width = "35px" id = "show_page_group_options" onClick = "$(\'#Save_Page_Group_Options\').toggleClass(\'item-hidden\');"><div id = "Save_Page_Group_Options" class = "item-hidden" style = "width:35px"><button id = "Ask_Developer_A_Question" class = "btn btn-info" data-toggle="modal" data-target="#AskDeveloperAQuestion">?</button><button id = "Delete_Last_Page" class = "btn btn-danger">-</button><button id = "Save_Current_Page" class = "btn btn-success">+</button></div></div>';
}
  if($cConfigs->cConfigs->Is_Dev())
  {
    echo '<nav class = "navbar navbar-expand-md navbar-light bg-warning sticky-top">';
  }else
  {
    echo '<nav class = "navbar navbar-expand-md navbar-dark bg-dark sticky-top">';
  }
  if($current_user->current_user->Am_I_Currently_Authenticated())
  {
    echo '
    <button class = "navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
        <span class = "navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapse_target">
    <ul class = "navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dispatch-Jobs
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="Job_index.php?job_filter=ALL&date='.date('Y-m-d',strtotime($_GET['date'])).'">All Jobs</a>
            <a class="dropdown-item" href="Job_index.php?job_filter=Transfer&date='.date('Y-m-d',strtotime($_GET['date'])).'">Transfer Review</a>
            <a class="dropdown-item" href="Job_index.php?job_filter=First_Day&date='.date('Y-m-d',strtotime($_GET['date'])).'">First Day/Not Confirmed</a>
            <a class="dropdown-item" href="Job_index.php?job_filter=Confirmed&date='.date('Y-m-d',strtotime($_GET['date'])).'">Not Confirmed</a>
            <a class="dropdown-item" href="Job_index.php?job_filter=Night&date='.date('Y-m-d',strtotime($_GET['date'])).'">Night Missing Texts</a>
            <a class="dropdown-item" href="Job_index.php?job_filter=Text&date='.date('Y-m-d',strtotime($_GET['date'])).'">Missing Texts</a>
            <a class="dropdown-item" href="Job_index.php?job_filter=People_Missing&date='.date('Y-m-d',strtotime($_GET['date'])).'">Missing Flaggers</a>
            <a class="dropdown-item" href="Job_index.php?job_filter=People_Confirmed&date='.date('Y-m-d',strtotime($_GET['date'])).'">Flaggers Not Confirmed</a>
            <a class="dropdown-item" href="Job_index.php?job_filter=Equipment_Assigned&date='.date('Y-m-d',strtotime($_GET['date'])).'">Missing Equipment</a>
            <a class="dropdown-item" href="Job_index.php?job_filter=Unread_Messages&date='.date('Y-m-d',strtotime($_GET['date'])).'">Unread Messages</a>
            <a class="dropdown-item" href="Job_index.php?job_filter=Missing_Drivers&date='.date('Y-m-d',strtotime($_GET['date'])).'">Missing Drivers</a>
            <a class="dropdown-item" href="Schedule_index.php?setup=1&date='.date('Y-m-d',strtotime($_GET['date'])).'">Setup Only</a>
            <a class="dropdown-item" href="Shift_Tags_index.php">Shift Tags</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dispatch-Flaggers
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="Schedule_index.php?ALL=1&date='.date('Y-m-d',strtotime($_GET['date'])).'">All Flaggers</a>
            <a class="dropdown-item" href="Schedule_index.php?CONFIRMED=1&date='.date('Y-m-d',strtotime($_GET['date'])).'">Available Flaggers</a>
            <a class="dropdown-item" href="Schedule_index.php?PENDING=1&date='.date('Y-m-d',strtotime($_GET['date'])).'">No Response Flaggers</a>
            <a class="dropdown-item" href="Schedule_index.php?AVandUN=1&date='.date('Y-m-d',strtotime($_GET['date'])).'">Available/Unassigned Flaggers</a>
            <a class="dropdown-item" href="Schedule_index.php?AS=1&date='.date('Y-m-d',strtotime($_GET['date'])).'">Assigned Flaggers</a>
            <a class="dropdown-item" href="Schedule_index.php?setup=1&date='.date('Y-m-d',strtotime($_GET['date'])).'">Setup Only</a>
            <a class="dropdown-item" href="Schedule_index.php?drivers=1&date='.date('Y-m-d',strtotime($_GET['date'])).'">Scheduled Drivers</a>
            <a class="dropdown-item" href="Bulk_Schedule_index.php?date='.date('Y-m-d',strtotime($_GET['date'])).'">Weekly Schedule</a>
            <a class="dropdown-item" href="Employee_Stat_Report_index.php?date='.date('Y-m-d',strtotime($_GET['date'])).'">Employee Stats</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Organization
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="CRM_index.php">Company Search</a>
            <a class="dropdown-item" href="Enhanced_Search_index.php">Enhanced Search</a>
            <a class="dropdown-item" href="Add_Company_index.php">Add Company</a>
            <a class="dropdown-item" href="Company_Tags_index.php">Company Tags</a>
            <a class="dropdown-item" href="CDM_Master_index.php">Export Company Data</a>
            <a class="dropdown-item" href="Employees_index.php">Employees</a>
            <a class="dropdown-item" href="Employees_Skills_index.php">Employee Skills</a>
            <a class="dropdown-item" href="Equipment_index.php">Equipment</a>
            <a class="dropdown-item" href="Equipment_Types.php">Types</a>
            <a class="dropdown-item" href="Equipment_Subtypes.php">Sub Types</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reports
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="CDM_Master_index.php">CDM Master</a>
            <a class="dropdown-item" href="Schedule_Report_Summary_index.php?date='.$_GET['date'].'">Shift Summary</a>
            <a class="dropdown-item" href="Schedule_Report_Full_index.php?date='.$_GET['date'].'">Shift Summary And Details</a>
            <a class="dropdown-item" href="Weekly_Job_Report_index.php?date='.$_GET['date'].'">Weekly Billing Report</a>
            <a class="dropdown-item" href="Unbilled_Shifts_index.php?date='.$_GET['date'].'">Unbilled Jobs Report</a>
          </div>
        </li>
    </ul>
    </div>';
  }
      if($current_user->current_user->Am_I_Currently_Authenticated())
      {
        echo '<div class = "bg-warning pr-2 pl-2 rounded mr-2 ml-2">'; 
        if($cConfigs->cConfigs->Is_Night_Mode_On())
        {
          echo '<label style = "float:right;" for = "night_mode">Night Mode:<input class = "Toggle_Display" id = "night_mode" type="checkbox"  data-toggle="toggle" data-size="xs" checked></label>';
        }else
        {
          echo '<label style = "float:right;" for = "night_mode">Night Mode:<input class = "Toggle_Display" id = "night_mode" type="checkbox"  data-toggle="toggle" data-size="xs"></label>';
        }
        echo '</div>';
        echo '<a href = "scripts/logout.php" class = "btn btn-warning btn-xs">Logout - '.$current_user->current_user->Get_Username().'</a>';
        if($current_user->current_user->Is_Management()){echo '<a style = "margin-left:15px" class = "btn btn-success btn-xs" data-toggle="modal" data-target="#userModal">Users</a>';}
      }else
      {
        //echo '<button type = "button" class = "btn btn-success" data-toggle="modal" data-target="#loginModal">Login</button>';
      }
      include 'include_scripts/PageTop_HamburgerMenu.php';
?>
</nav>
<div class = "modal fade" role = "dialog" id="userModal">
  <div class = "modal-dialog">
    <div class = "modal-content">
        <div class = "modal-header">
          <h3 class = "modal-title">Users</h3>
          <button type = "buttton" class ="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-lg-8" style = "background-color: grey;">
                <?php if($current_user->current_user->Is_Management()){include 'include_scripts/User_Modal.php';}?>
                <?php new \company_program\Department_Context_Menu;?>
              </div>
            </div>
          </div>
        </div>
        <div class = "modal-footer">
            <?php echo '<button type = "button" class = "btn btn-success" data-toggle="modal" data-target="#registerModal">Create User</button>';?>
        </div>
    </div>
  </div>
</div>
<?php
if($cConfigs->cConfigs->Is_Feature_Enabled('save_page_state'))
{
  echo '<div style = "z-index:2147483638" class = "modal fade" role = "dialog" id="AskDeveloperAQuestion">
    <div class = "modal-dialog">
      <div class = "modal-content">
          <div class = "modal-header">
            <h3 class = "modal-title">Talk to Joel</h3>
            <button type = "buttton" class ="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div id = "question_for_developer_body" class = "form-group">
              <textarea id = "question_for_developer" name="note" class = "form-control" required></textarea>
            </div>
          </div>
          <div class = "modal-footer">
            <button type = "submit" id = "ask_developer_a_question" class = "btn btn-success">Thank You</button>
          </div>
      </div>
    </div>
  </div>';
}
?>
<script>
$("#ask_developer_a_question").on('mouseup',function(){
  
  var data = null;

  var xhr = new XMLHttpRequest();

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
    }
  });
  //list id 5dd44627d679f586e550fc76
  <?php
  if(isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI']))
  {
    echo 'xhr.open("POST", "https://api.trello.com/1/cards?idLabels=5dd445cc8bdee58e0d6557ca&idList=5dd44627d679f586e550fc76&urlSource='.urlencode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']).'&desc='.urlencode($current_user->current_user->Get_Username()).'&name="+$("#question_for_developer").val()+"&key=20a4c2d04ffa684bfa3c7ae4da2877d8&token=d601ab46a8c64fbafb6896c6737021a06e0bac0b9b8a8581da7579f6e86a4663");';
  }else
  {
    echo 'xhr.open("POST", "https://api.trello.com/1/cards?idLabels=5dd445cc8bdee58e0d6557ca&idList=5dd44627d679f586e550fc76&desc='.urlencode($current_user->current_user->Get_Username()).'&name="+$("#question_for_developer").val()+"&key=20a4c2d04ffa684bfa3c7ae4da2877d8&token=d601ab46a8c64fbafb6896c6737021a06e0bac0b9b8a8581da7579f6e86a4663");';
  }
  ?>
  xhr.send(data);
  $("#question_for_developer").remove()
  $("#question_for_developer_body").html("<h3>Thank you for your request.  I will get back to you as soon as possible.</h3>");
  $(this).remove();
})
</script>
<div class = "modal fade" role = "dialog" id="registerModal">
  <div class = "modal-dialog">
    <div class = "modal-content">
      <form action = "scripts/register_new_user.php" method = "POST">
        <div class = "modal-header">
          <h3 class = "modal-title">Register New User</h3>
          <button type = "buttton" class ="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class = "form-group">
            <input type = "text" name="username" class = "form-control" placeholder = "Username" required>
          </div>
        </div>
        <div class = "modal-footer">
          <button type = "submit" class = "btn btn-success">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
      if(!$current_user->current_user->Am_I_Currently_Authenticated())
      {
        if(isset($_SERVER['HTTP_REFERER']))
        {
          if($_SERVER['HTTP_REFERER'])
          {
            $path = $_SERVER['SCRIPT_NAME'];
            if(substr($path,0,9) == "/scripts/"  && $path != "/scripts/login.php")
            {
                $aAlerts->aAlerts->Add_Alert('Action Not Taken',' Due to your login expiring whatever action you just tried to take was not completed.  Please try again.');
            }
          }
        }
          echo '
          <div style = "display:block;" class = "modal fade show" role = "dialog" id="loginModal">
          
          <div class = "modal-dialog">
            <div class = "modal-content" style = "background-color:rgba(0,0,0,0.5);">
              <form id = "login_user_form" action = "/scripts/login.php" method = "POST">
                <div class = "modal-header">
                  <h3 class = "modal-title text-white">Login</h3>
                </div>
                <div class="modal-body">
                  <div class = "form-group">
                    <input type = "text" name="username" class = "form-control" placeholder = "Username" required>
                  </div>
                  <div class = "form-group">
                    <input id = "password" type = "password" name="password" class = "form-control" placeholder = "Password" required>
                  </div>
                  <span class = "text-danger font-weight-bold item-hidden" id = "caps_lock">CAPS LOCK ON</span>
                </div>
                <div class = "modal-footer">
                  <button type = "submit" class = "btn btn-success">Sign In</button>
                </div>
              </form>
            </div>
          </div>
        
          </div>
        ';
      }

?>
<?php
        $aAlerts->aAlerts->Process_Alerts();
?>
<script>
    var time = new Date();
    Post_Ajax('ajax_return_scripts/reauthenticate.php','{}',true,false);

    time.setHours(time.getHours() - 2);
    $(document.body).bind("mousemove keypress", function(e) {
         time = new Date().getTime();
     });

     function refresh_check() {
         console.log('Checking Authentication');
          Post_Ajax('ajax_return_scripts/check_authentication.php','{}',true,false,check_authentication);
          setTimeout(refresh_check, <?php echo $cConfigs->cConfigs->Configurations()['Session_Time_Limit_In_Minutes'];?> * 60000 + 150);
      }

      function reauthenticate() {
         console.log('checking reauthentication');
         if(new Date().getTime() - time <= <?php echo $cConfigs->cConfigs->Configurations()['Session_Time_Limit_In_Minutes'];?> * 60000)
         { 
           Post_Ajax('ajax_return_scripts/reauthenticate.php','{}',true,false);
           setTimeout(reauthenticate, (<?php echo $cConfigs->cConfigs->Configurations()['Session_Time_Limit_In_Minutes'];?> * 60000) - 1000);
         }
      }
      setTimeout(refresh_check, <?php echo $cConfigs->cConfigs->Configurations()['Session_Time_Limit_In_Minutes'];?> * 60000);
      setTimeout(reauthenticate, (<?php echo $cConfigs->cConfigs->Configurations()['Session_Time_Limit_In_Minutes'];?> * 60000) - 1000);
try
{

// Get the input field
var input = document.getElementById("password");

// Get the warning text
var text = document.getElementById("caps_lock");

// When the user presses any key on the keyboard, run the function
input.addEventListener("keyup", function(event) {

  // If "caps lock" is pressed, display the warning text
  if (event.getModifierState("CapsLock")) {
    text.classList.remove("item-hidden");
  } else {
    text.classList.add("item-hidden");
  }
});

} catch (e)
{
  
}

$('#night_mode').on('change',function(){
  if($(this).prop('checked'))
  {
    Post_Ajax('scripts/Turn_On_Night_Mode.php',"{}");
  }else
  {
    Post_Ajax('scripts/Turn_Off_Night_Mode.php',"{}");
  }
})
</script>
<div style = "position:absolute;bottom:250px;right:25px;z-index:99999" role="alert" aria-live="assertive" aria-atomic="true" class="toast item-hidden" id = "Not_Refreshed_In_5" data-autohide="false">
  <div class="toast-header">
    <?php echo $refresh_icon;?>
    <strong class="mr-auto">Refresh</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    It's been 5 minutes since you last refreshed.  Recommend refreshing your screen to see the latest information.
  </div>
</div>