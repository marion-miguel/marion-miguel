<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>



<style>
        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            
        }
        td, th, tr, input {
            text-align: center;
            padding: 1.5px;
            border: 1px solid #ccc  ;
        } 
        
        label {
            display: block;
        }
        input, textarea, select {
            width: 100%;
            box-sizing: border-box;
            text-align: center;

        }
        button {
            padding: 10px 20px;
            margin: 10px 5px;
            text-align: left;
            row-gap: 20px;
        }
        h1{
            text-align: center;
        }
.form-container {
    width: 80%;
    margin: 1px ;
    
}

.form-group,
.form-group-horizontal {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.form-group-horizontal label,
.form-group-horizontal input {
    margin-right: 1px;
}

label {
    min-width: 150px;
    text-align: right;
}

input[type="text"],
input[type="date"] {
    padding: 5px;
}

button {
    padding: 5px 10px;
}

  </style>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-braille" style="color:#1976d2"></i>&nbsp Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-wallet"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                    <?php 
                                        $this->db->where('status','ACTIVE');
                                        $this->db->from("employee");
                                        echo $this->db->count_all_results();
                                    ?>  Employees</h3>
                                        <a href="<?php echo base_url(); ?>employee/Employees" class="text-muted m-b-0">View Employee</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                             <?php 
                                                    $this->db->where('leave_status','Approve');
                                                    $this->db->from("emp_leave");
                                                    echo $this->db->count_all_results();
                                                ?> Leaves
                                        </h3>
                                        <a href="<?php echo base_url(); ?>leave/Application" class="text-muted m-b-0">View Leave</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> 
                                         <?php 
                                                $this->db->where('pro_status','running');
                                                $this->db->from("project");
                                                echo $this->db->count_all_results();
                                            ?> Projects
                                        </h3>
                                        <a href="<?php echo base_url(); ?>Projects/All_Projects" class="text-muted m-b-0">View Project</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-settings"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                         <?php 
                                                $this->db->where('status','Granted');
                                                $this->db->from("loan");
                                                echo $this->db->count_all_results();
                                            ?> Loan 
                                        </h3>
                                        <a href="<?php echo base_url(); ?>Loan/View" class="text-muted m-b-0">View Loan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- Row -->
                
                <div class="row ">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-info">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white">
                                    <?php 
                                        $this->db->where('status','INACTIVE');
                                        $this->db->from("employee");
                                        echo $this->db->count_all_results();
                                    ?>
                                </h1>
                                <h6 class="text-white">Ex-employees</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-success card-inverse">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                             <?php 
                                                    $this->db->where('leave_status','Approve');
                                                    $this->db->from("emp_leave");
                                                    echo $this->db->count_all_results();
                                                ?> 
                                </h1>
                                <h6 class="text-white">Leave Application</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-danger">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                     <?php 
                                            $this->db->where('pro_status','upcoming');
                                            $this->db->from("project");
                                            echo $this->db->count_all_results();
                                        ?> 
                                </h1>
                                <h6 class="text-white">Upcomming Project</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-dark">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                         <?php 
                                                $this->db->where('status','Granted');
                                                $this->db->from("loan");
                                                echo $this->db->count_all_results();
                                            ?> 
                                </h1>
                                <h6 class="text-white">Loan Application</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
            </div> 
            <div class="container-fluid">
                <?php $notice = $this->notice_model->GetNoticelimit(); 
                $running = $this->dashboard_model->GetRunningProject(); 
                $userid = $this->session->userdata('user_login_id');
                $todolist = $this->dashboard_model->GettodoInfo($userid);                 
                $holiday = $this->dashboard_model->GetHolidayInfo();                 
                ?>



                <!-- Row -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title">Time Keeping Dashboard</h1>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive slimScrollDiv" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box ">
                                    <form id="workLogForm">
        <table>
            <hr>
                <tr colspan="4">
                    <button type="button" id="timeInButton">Time In</button>
                    <button type="button" id="timeOutButton">Time Out</button>
                    <button type="submit">Submit</button>
                </tr>
        </table>
        <br>
        <table>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><label for="date">Date:</label></td>
                <td><label for="work_type">Work Type:</label></td>
                <td><label for="schedule">Schedule:</label></td>
                <td><label for="time_in">Time In:</label></td>
                <td><label for="time_out">Time Out:</label></td>
            </tr>
            <tr>
                <td><input type="email" id="email" name="email" required ></td>
                <td><input type="date" id="date" name="date" required></td>
                <td><input type="text" id="work_type" name="work_type" value="Office" readonly></td>
                <td><input type="text" id="schedule" name="schedule" value="8 AM to 5 PM" readonly></td>
                <td><input type="time" id="time_in" name="time_in" min="08:00" max="17:00" required></td>
                <td><input type="time" id="time_out" name="time_out" min="09:00" max="18:00" required></td>
            </tr>
        </table>
        <br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Work Type</th>
                    <th>Schedule</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Time Pairs</th>
                    <th>Late</th>
                    <th>Undertime</th>
                    <th>Absent</th>
                    <th>Hours Worked</th>
                    <th>ProdHrs</th>
                    <th>Remarks</th>
                    <th>Analysis</th>
                    <th>Last Update</th>
                </tr>
            </thead>
            <tbody id="userRecords">
                <!-- Records will be dynamically inserted here -->
            </tbody>
        </table>
        <script src="/hr-payroll-master/application/views/backend/user.js"></script>
    </form>
    <script>
            $(document).ready(function() {
        // Function to update Absent field based on Time In
        function updateAbsentField() {
            let timeIn = $('#time_in').val();
            let absentField = $('#absent');

            if (timeIn) {
                absentField.val('0'); // Not absent
            } else {
                absentField.val('1'); // Absent
            }
        }
            $('#timeInButton').click(function() {
                let now = new Date();
                let hours = String(now.getHours()).padStart(2, '0');
                let minutes = String(now.getMinutes()).padStart(2, '0');
                let timeString = hours + ':' + minutes;
                $('#time_in').val(timeString);
                updateAbsentField();

            });

            $('#timeOutButton').click(function() {
                let now = new Date();
                let hours = String(now.getHours()).padStart(2, '0');
                let minutes = String(now.getMinutes()).padStart(2, '0');
                let timeString = hours + ':' + minutes;
                $('#time_out').val(timeString);
            });

           

            $('#workLogForm').submit(function(e) {
                e.preventDefault();

                let timeIn = $('#time_in').val();
                let timeOut = $('#time_out').val();
                let lateMinutes = calculateLateMinutes(timeIn);
                let late = lateMinutes > 0 ? `${Math.floor(lateMinutes / 60)}:${lateMinutes % 60}` : '00:00';
                $('#late').val(late);

                // Calculate undertime
                let undertime = calculateUndertime(timeOut);
                $('#undertime').val(undertime);

                $.post('/hr-payroll-master/application/views/backend/submit.php', $(this).serialize(), function(response) {
                    alert(response);
                    $('#workLogForm')[0].reset(); // Reset the form fields
                });
            });

            function calculateLateMinutes(timeIn) {
                if (!timeIn) return 0;

                let timeInParts = timeIn.split(':');
                let timeInHours = parseInt(timeInParts[0], 10);
                let timeInMinutes = parseInt(timeInParts[1], 10);

                let lateMinutes = 0;
                if (timeInHours >= 8 && timeInHours < 12) {
                    lateMinutes = (timeInHours - 8) * 60 + timeInMinutes;
                } else if (timeInHours >= 13 && timeInHours < 17) {
                    lateMinutes = (timeInHours - 13) * 60 + timeInMinutes;
                }

                return lateMinutes;
            }

            function calculateUndertime(timeOut) {
                if (!timeOut) return '00:00';

                let timeOutTimestamp = new Date('1970-01-01T' + timeOut + 'Z').getTime();
                let expectedTimeOutTimestamp = new Date('1970-01-01T17:00:00Z').getTime();
                let undertimeMinutes = (expectedTimeOutTimestamp - timeOutTimestamp) / (1000 * 60); // Convert to minutes

                if (undertimeMinutes <= 0) return '00:00';

                let hours = Math.floor(undertimeMinutes / 60);
                let minutes = Math.floor(undertimeMinutes % 60);
                return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
            }
        });
    </script>
                                        <tbody>
                                           <?php foreach($notice AS $value): ?>
                                            <tr class="scrollbar" style="vertical-align:top">
                                                <td><?php echo $value->title ?></td>
                                                <td><mark><a href="<?php echo base_url(); ?>assets/images/notice/<?php echo $value->file_url ?>" target="_blank"><?php echo $value->file_url ?></a></mark>
                                                </td>
                                                <td style="width:100px"><?php echo $value->date ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    
                    <!-- Column -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">To Do list</h4>
                                <h6 class="card-subtitle">List of your next task to complete</h6>
                                <div class="to-do-widget m-t-20" style="height:550px;overflow-y:scroll">
                                            <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                                               <?php foreach($todolist as $value): ?>
                                                <li class="list-group-item" data-role="task">
                                                   <?php if($value->value == '1'){ ?>
                                                    <div class="checkbox checkbox-info">
                                                        <input class="to-do" data-id="<?php echo $value->id?>" data-value="0" type="checkbox" id="<?php echo $value->id?>" >
                                                        <label for="<?php echo $value->id?>"><span><?php echo $value->to_dodata; ?></span></label>
                                                    </div>
                                                    <?php } else { ?>
                                                    <div class="checkbox checkbox-info">
                                                        <input class="to-do" data-id="<?php echo $value->id?>" data-value="1" type="checkbox" id="<?php echo $value->id?>" checked>
                                                        <label class="task-done" for="<?php echo $value->id?>"><span><?php echo $value->to_dodata; ?></span></label>
                                                    </div> 
                                                    <?php } ?>                                                   
                                                </li>

                                                <?php endforeach; ?>
                                            </ul>                                    
                                </div>
                                <div class="new-todo">
                                   <form method="post" action="add_todo" enctype="multipart/form-data" id="add_todo" >
                                    <div class="input-group">
                                        <input type="text" name="todo_data" class="form-control" style="border: 1px solid #fff !IMPORTANT;" placeholder="Add new task">
                                        <span class="input-group-btn">
                                        <input type="hidden" name="userid" value="<?php echo $this->session->userdata('user_login_id'); ?>">
                                        <button type="submit" class="btn btn-success todo-submit"><i class="fa fa-plus"></i></button>
                                        </span> 
                                    </div>
                                    </form>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Row -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Running Project</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($running AS $value): ?>
                                            <tr style="vertical-align:top;background-color:#e3f0f7">
                                                <td><a href="<?php echo base_url(); ?>Projects/view?P=<?php echo base64_encode($value->id); ?>"><?php echo substr("$value->pro_name",0,25).'...'; ?></a></td>
                                                <td><?php echo $value->pro_start_date; ?></td>
                                                <td><?php echo $value->pro_end_date; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Holidays
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box">
                                       <thead>
                                            <tr>
                                                <th>Holiday Name</th>
                                                <th>Date</th>
                                            </tr>                                           
                                       </thead>
                                       <tbody>
                                          <?php foreach($holiday as $value): ?>
                                           <tr style="background-color:#e3f0f7">
                                               <td><?php echo $value->holiday_name ?></td>
                                               <td><?php echo $value->from_date; ?></td>
                                           </tr>
                                           <?php endforeach ?>
                                       </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
<script>
  $(".to-do").on("click", function(){
      //console.log($(this).attr('data-value'));
      $.ajax({
          url: "Update_Todo",
          type:"POST",
          data:
          {
          'toid': $(this).attr('data-id'),         
          'tovalue': $(this).attr('data-value'),
          },
          success: function(response) {
              location.reload();
          },
          error: function(response) {
            console.error();
          }
      });
  });			
</script>                                               
<?php $this->load->view('backend/footer'); ?>