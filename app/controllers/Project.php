<?php 
class Project extends Controller
{
  public function index()
  {
    // if(!isset($_SESSION)){
    //   session_start();
    // }
    if(!isset($_SESSION["Login"])) {
      header('Location: '. BASEURL .'/Auth');
      exit;
    }
    
    if (isset($_SESSION["S_Login"])) {
      $npm = $_COOKIE['npm'];
      $student = $this->model('Student_model')->getStudentByNpm($npm);
      $data['name'] = isset ($student['name']) ? $student['name'] : 'Student' ;
      $data['image'] = $student['profile_image'];
      $data['student'] = $student;
      $data['active_state'] = "Project";

      // GET FRIEND REQUEST
      $requests = $this->model('Friends_model')->getFriendRequest($_COOKIE['npm']);
      $data['requester_name'] = [];
      foreach ($requests as $request) {
        $student = $this->model('Student_model')->getStudentByNpm($request['relating_student']);
        array_push($data['requester_name'], $student['name']);
      } 
    }

    if (isset($_POST['create_project'])) {
      if ($this->model('Project_model')->addProject($_POST) > 0) {
        Alert::setAlertPopup(
          'Successfully Created', 
          'New Project Created, Share project key to student to let them work on it',
          'success', 
          'document.location.href = "'. BASEURL .'/Project"'
        );
        echo Alert::AlertPopup();          
      } else {
        Alert::setAlertPopup(
          'Failed',
          'Unable to create the project, Please try again later', 
          'error',
          'document.location.href = "'. BASEURL .'/Project'
        );          
        echo Alert::AlertPopup();   
      }      
    }
    
    if (isset($_SESSION["L_Login"])) {
      $nidn = $_COOKIE['nidn'];
      $lecturer = $this->model('Lecturer_model')->getLecturerByNidn($nidn);
      $data['name'] = isset ($lecturer['name']) ? $lecturer['name'] : 'Lecturer' ;
      $data['image'] = $lecturer['profile_image'];
      $data['lecturer'] = $lecturer;
      $data['active_state'] = "Project";
    }
    
    $this->view('templates/project/header', $data);
    $this->view('project/index', $data);
    $this->view('templates/project/footer', $data);
  }

  public function List()
  {
    if (isset($_SESSION["S_Login"])) {
      $npm = $_COOKIE['npm'];
      $page = (isset($_POST['page'])) ? $_POST['page'] : 1;
      $limit = 3; 
      $limit_start = ($page - 1) * $limit;
      $no = $limit_start + 1;

      $student = $this->model('Student_model')->getStudentByNpm($npm);
      $teams= $this->model('Team_model')->getStudentTeams($npm, $limit_start, $limit);
      $teams_count = $this->model('Team_model')->countTeams($npm);
      $data['name'] = isset ($student['name']) ? $student['name'] : 'Student' ;
      $data['image'] = $student['profile_image'];
      $data['teams'] = $teams;
      $data['student'] = $student;

      // GET PROJECT
      $data['page'] = $page;
      $data['teams_total'] = $teams_count['total'];
      $data['teams_limit'] = $limit;
      $data['student_id'] = $student['npm'];
      $data['project_id'] = [];
      $data['project_name'] = [];
      $data['project_description'] = [];
      $data['project_key'] = [];
      $data['project_start_date'] = [];
      $data['project_end_date'] = [];
      $data['project_subject'] = [];
      $data['project_lecturer'] = [];
      $data['project_group'] = [];
      $data['active_state'] = "Project";
      foreach ($teams as $team) {
        array_push($data['project_group'], $team['groups']);
        $projects = $this->model('Project_model')->getProjectById($team['project_id']);
        array_push($data['project_id'], $projects['id']);
        array_push($data['project_name'], $projects['name']);
        array_push($data['project_description'], $projects['description']);
        array_push($data['project_key'], $projects['project_key']);
        array_push($data['project_start_date'], $projects['start_date']);
        array_push($data['project_end_date'], $projects['end_date']);
        $subject = $this->model('Subject_model')->getSubjectById($projects['subject_id']);
        $lecturer = $this->model('Lecturer_model')->getLecturerByNidn($projects['lecturer_id']);
        array_push($data['project_subject'], $subject['name']);
        array_push($data['project_lecturer'], $lecturer['name']);
      }

      // GET FRIEND REQUEST
      $requests = $this->model('Friends_model')->getFriendRequest($_COOKIE['npm']);
      $data['requester_name'] = [];
      foreach ($requests as $request) {
        $student = $this->model('Student_model')->getStudentByNpm($request['relating_student']);
        array_push($data['requester_name'], $student['name']);
      } 
    }

    if (isset($_POST['create_project'])) {
      if ($this->model('Project_model')->addProject($_POST) > 0) {
        Alert::setAlertPopup(
          'Successfully Created', 
          'New Project Created, Share project key to student to let them work on it',
          'success', 
          'document.location.href = "'. BASEURL .'/Project"'
        );
        echo Alert::AlertPopup();          
      } else {
        Alert::setAlertPopup(
          'Failed',
          'Unable to create the project, Please try again later', 
          'error',
          'document.location.href = "'. BASEURL .'/Project'
        );          
        echo Alert::AlertPopup();   
      }      
    }
    
    if (isset($_SESSION["L_Login"])) {
      $nidn = $_COOKIE['nidn'];
      $page = (isset($_POST['page'])) ? $_POST['page'] : 1;
      $limit = 4; 
      $limit_start = ($page - 1) * $limit;
      $no = $limit_start + 1;
      
      $lecturer = $this->model('Lecturer_model')->getLecturerByNidn($nidn);
      $data['name'] = isset ($lecturer['name']) ? $lecturer['name'] : 'Lecturer' ;
      $data['image'] = $lecturer['profile_image'];
      $data['lecturer'] = $lecturer;
      $data['active_state'] = "Project";

      $subjects = $this->model('Subject_model')->getSubjectByLecturerId($nidn);
      $data['subject'] = $subjects;
      $data['subject_id'] = [];
      $data['subject_name'] = [];
      foreach ($subjects as $subject) {
        array_push($data['subject_name'], $subject['name']);
        array_push($data['subject_id'], $subject['id']);
      }
      $projects = $this->model('Project_model')->getProjectByLecturer($nidn, $limit_start, $limit);
      $data['lecturer_nidn'] = $nidn;
      $data['project'] = $projects;
      $data['project_id'] = [];
      $data['project_name'] = [];
      $data['project_subject'] = [];
      $data['project_description'] = [];

      $projects_count = $this->model('Project_model')->countProjects($nidn);
      $data['page'] = $page;
      $data['projects_total'] = $projects_count['total'];
      $data['projects_limit'] = $limit;
      foreach ($projects as $project) {
        $project_subject = $this->model('Subject_model')->getSubjectById($project['subject_id']);
        array_push($data['project_id'], $project['id']);
        array_push($data['project_name'], $project['name']);
        array_push($data['project_subject'], $project_subject['name']);
        array_push($data['project_description'], $project['description']);
      }
    }

    $this->view('project/project_list', $data);
  }

  public function DisplayProject()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }

    if (isset($_GET['projectKey'])) {
      $key = $_GET['projectKey'];
      $project = $this->model('Project_model')->getTeamByProjectKey($key);
      
      $activeUser = $this->model('Student_model')->getStudentByNpm($_COOKIE['npm']);

      if ($project) {
        $lecturer = $this->model('Lecturer_model')->getLecturerByNidn($project['lecturer_id']);
        $subject = $this->model('Subject_model')->getSubjectById($project['subject_id']);
        $team = $this->model('Team_model')->getTeamByProject($project['id']);

        $data['team_group'] = [];
        foreach ($team as $t) {
          if ($activeUser['npm'] == $t['student_id'] || $activeUser['npm'] == $t['manager_id']) {
            Alert::setAlertPopup(
              'Sorry', 
              'You already joined this team', 
              'error', 
              'document.location.href = "'. BASEURL .'/Project"'
            );          
            echo Alert::AlertPopup();
          }
          array_push($data['team_group'], $t['groups']);
        }

        $data['team_group_name'] = [];
        $data['team_group_student'] = [];
        $data['team_group_manager'] = [];
        if (isset($_GET['group'])) {
          $teamGroup = $this->model('Team_model')->getTeamByProjectGroup($_GET['group'], $project['id']);
          foreach ($teamGroup as $group) {
            array_push($data['team_group_name'], $group['name']);
            if (!$group['manager_id']) {
              $groupStudent = $this->model('Student_model')->getStudentByNpm($group['student_id']);
              array_push($data['team_group_student'], $groupStudent['name']);
            }
            $groupManager = $this->model('Student_model')->getStudentByNpm($group['manager_id']);
            if ($groupManager) {
              array_push($data['team_group_manager'], $groupManager['name']);
            }
          }
        }

        $data['project_key'] = $key;
        $data['active_user_id'] = $activeUser['npm'];
        $data['active_user'] = $activeUser['name'];
        $data['project_team'] = $team;
        $data['project_name'] = $project['name'];
        $data['project_id'] = $project['id'];
        $data['project_description'] = $project['description'];
        $data['project_start_date'] = $project['start_date'];
        $data['project_end_date'] = $project['end_date'];
        $data['project_lecturer'] = $lecturer['name'];
        $data['project_subject'] = $subject['name'];

        $this->view('project/displayProject', $data);
        $this->view('templates/home/footer', $data);
      } else {
        Alert::setAlertPopup(
          'Not Found', 
          'Project not exist', 
          'error', 
          'document.location.href = "'. BASEURL .'/Project"'
        );          
        echo Alert::AlertPopup();        
      }
    }
  }

  public function JoinProject()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }

    if (isset($_POST['submitMember']) or isset($_POST['submitManager'])) {
      if ($this->model('Team_model')->addTeam($_POST) > 0) {
        Alert::setAlertPopup(
          'Successfully Joined', 
          'You joined a nice team',
          'success', 
          'document.location.href = "'. BASEURL .'/Project"'
        );
        echo Alert::AlertPopup();          
      } else {
        Alert::setAlertPopup(
          'Failed',
          'Unable to join the project, Please try again later', 
          'error',
          'document.location.href = "'. BASEURL .'/Project'
        );          
        echo Alert::AlertPopup();          
      }
    }
  }

  public function LeaveProject()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }

    if (isset($_GET['project_id']) && isset($_GET['group']) && isset($_GET['npm'])) {
      if ($this->model('Team_model')->leaveTeam($_GET['project_id'], $_GET['group'], $_GET['npm']) > 0) {
        Alert::setAlertPopup(
          'Good Bye', 
          'Successfully leaved the team', 
          'success',
          'document.location.href = "'. BASEURL .'/Project"'
        );          
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Sorry', 
          'Failed to leave the team, You got some on progress project', 
          'error',
          'document.location.href = "'. BASEURL .'/Project"'
        );          
        echo Alert::AlertPopup();
      }
    }
  }

  public function Details()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }

    if (isset($_SESSION['S_Login'])) {
      if (isset($_POST['create_task'])) {
        // $task = $this->model('Task_model')->addTask($_POST);
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->addTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Success', 
            'Task successfully created', 
            'success',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );          
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to create a task, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }      
      }
      
      if (isset($_POST['get_task'])) {
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->WorkOnTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Successfully assigned', 
            'Do your best on the task', 
            'success',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );          
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to get a task right now, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }        
      }
  
      if (isset($_POST['drop_task'])) {
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->dropTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Task Dropped',
            'Thanks for your participation, \n please note that your student social score will be deducted', 
            'success',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to drop a task right now, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }        
      }
      
      if (isset($_POST['complete_task'])) {
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->completeTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Task Submited',
            'Thanks for your hardwork, Please wait for leader confirmation', 
            'success',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to submit a task right now, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }        
      }    
  
      if (isset($_POST['approve_task'])) {
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->approveTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Task Approved',
            'Task successfully approved, please do praise your member',
            'success',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to approve a task right now, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }           
      }
  
      if (isset($_POST['reject_task'])) {
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->rejectTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Task Rejected',
            'Please do mention your member to revise the task',
            'success',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to reject a task right now, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Details?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }           
      }    
  
      if (isset($_GET['id']) && isset($_GET['group'])) {
        // $project = $this->model('Project_model')->getProjectWithTask($_GET['id']);
        $team = $this->model('Team_model')->getTeamByProjectGroup($_GET['group'], $_GET['id']);
        $project = $this->model('Project_model')->getProjectById($team[0]['project_id']);
        $task = $this->model('Task_model')->getTaskByProjectGroupLimited($project['id'], $team[0]['groups'], 5);
        $student = $this->model('Student_model')->getStudentByNpm($_COOKIE['npm']);
        $subject = $this->model('Subject_model')->getSubjectById($project['subject_id']);
        $lecturer = $this->model('Lecturer_model')->getLecturerByNidn($project['lecturer_id']);
  
        $data['project_name'] = $project['name'];
        $data['project_description'] = $project['description'];
        $data['project_start_date'] = $project['start_date'];
        $data['project_end_date'] = $project['end_date'];
        $data['project_subject_name'] = $subject['name'];
        $data['project_lecturer_name'] = $lecturer['name'];
        
        // Check if current active npm equal to project team manager so i should get the team first
        if ($student['npm'] == $team[0]['manager_id']) {
          $data['manager_privilege'] = true;
        }
        
        $data['student'] = $student;
        $data['task'] = $task;
        $data['task_id'] = [];
        $data['task_description'] = [];
        $data['task_title'] = [];
        $data['task_start_date'] = [];
        $data['task_end_date'] = [];
        $data['task_taken_date'] = [];
        $data['task_completed_date'] = [];
        $data['task_level'] = [];
        $data['task_submission_link'] = [];
        $data['task_available_status'] = [];
        $data['task_progress_status'] = [];
        $data['task_approval_status'] = [];
        $data['task_responsible'] = [];
  
        if (isset($task)) {
          foreach ($task as $t) {
            array_push($data['task_id'], $t['id']);
            array_push($data['task_description'], $t['description']);
            array_push($data['task_title'], $t['title']);
            array_push($data['task_start_date'], $t['start_date']);
            array_push($data['task_end_date'], $t['end_date']);
            array_push($data['task_taken_date'], $t['taken_date']);
            array_push($data['task_completed_date'], $t['completed_date']);
            array_push($data['task_level'], $t['level']);
            array_push($data['task_submission_link'], $t['submission_link']);
            array_push($data['task_available_status'], $t['available_status']);
            array_push($data['task_progress_status'], $t['task_status']);
            array_push($data['task_approval_status'], $t['approval_status']);
            array_push($data['task_responsible'], $t['student_id']);
          }
        }

        $team_manager = $this->model('Student_model')->getStudentByNpm($team[0]['manager_id']);
        if ($team_manager) {
          $data['team_manager'] = $team_manager['name'];
        }
        $data['team_member'] = [];
        $data['team_member_npm'] = [];
        if (isset($team)) {
          foreach ($team as $t) {
            if (!$t['manager_id']) {
              $team_member = $this->model('Student_model')->getStudentByNpm($t['student_id']);
              array_push($data['team_member'], $team_member['name']);
              array_push($data['team_member_npm'], $team_member['npm']);
            }
          }
        }

        // GET FRIEND REQUEST
        $requests = $this->model('Friends_model')->getFriendRequest($_COOKIE['npm']);
        $data['requester_name'] = [];
        foreach ($requests as $request) {
          $student = $this->model('Student_model')->getStudentByNpm($request['relating_student']);
          array_push($data['requester_name'], $student['name']);
        } 

        $data['image'] = $student['profile_image'];
        $data['name'] = $student['name'];
        $data['student_id'] = $student['npm'];
        $data['active_state'] = "Project";
      }    
    }

    if (isset($_SESSION['L_Login'])) {
      if (isset($_GET['id'])) {
        // var_dump($_GET['id']);
        $lecturer = $this->model('Lecturer_model')->getLecturerByNidn($_COOKIE['nidn']);
        $project = $this->model('Project_model')->getProjectById($_GET['id']);
        $team = $this->model('Team_model')->getTeamByProject($project['id']);
        // var_dump($project);die;
        $subject = $this->model('Subject_model')->getSubjectById($project['subject_id']);
        
        // echo "<pre>";
        // var_dump($team);die;
        // echo "</pre>";
        $data['lecturer'] = $lecturer;
        $data['project_id'] = $project['id'];
        $data['project_name'] = $project['name'];
        $data['project_description'] = $project['description'];
        $data['project_start_date'] = $project['start_date'];
        $data['project_end_date'] = $project['end_date'];
        $data['project_subject_name'] = $subject['name'];
        $data['project_lecturer_name'] = $lecturer['name'];
        
        $data['team'] = $team;
        $data['team_group'] = [];
        foreach ($team as $t) {
          array_push($data['team_group'], $t['groups']);
        }

        if (isset($_GET['group'])) {
          $team_group = $this->model('Team_model')->getTeamByProjectGroup($_GET['group'], $_GET['id']);
          $task = $this->model('Task_model')->getTaskByProjectGroupLimited($project['id'], $team_group[0]['groups'], 5);
          $data['task'] = $task;
          $data['task_id'] = [];
          $data['task_description'] = [];
          $data['task_title'] = [];
          $data['task_start_date'] = [];
          $data['task_end_date'] = [];
          $data['task_taken_date'] = [];
          $data['task_completed_date'] = [];
          $data['task_level'] = [];
          $data['task_submission_link'] = [];
          $data['task_available_status'] = [];
          $data['task_progress_status'] = [];
          $data['task_approval_status'] = [];
          $data['task_responsible'] = [];
    
          if (isset($task)) {
            foreach ($task as $t) {
              array_push($data['task_id'], $t['id']);
              array_push($data['task_description'], $t['description']);
              array_push($data['task_title'], $t['title']);
              array_push($data['task_start_date'], $t['start_date']);
              array_push($data['task_end_date'], $t['end_date']);
              array_push($data['task_taken_date'], $t['taken_date']);
              array_push($data['task_completed_date'], $t['completed_date']);
              array_push($data['task_level'], $t['level']);
              array_push($data['task_submission_link'], $t['submission_link']);
              array_push($data['task_available_status'], $t['available_status']);
              array_push($data['task_progress_status'], $t['task_status']);
              array_push($data['task_approval_status'], $t['approval_status']);
              array_push($data['task_responsible'], $t['student_id']);
            }
          }

          $team_manager = $this->model('Student_model')->getStudentByNpm($team_group[0]['manager_id']);
          if ($team_manager) {
            $data['team_manager'] = $team_manager['name'];
          }
          $data['team_member'] = [];
          if (isset($team_group)) {
            foreach ($team_group as $team) {
              if (!$team['manager_id']) {
                $team_member = $this->model('Student_model')->getStudentByNpm($team['student_id']);
                array_push($data['team_member'], $team_member['name']);
              }
            }
          }          
        }
  
        $data['image'] = $lecturer['profile_image'];
        $data['name'] = $lecturer['name'];
        $data['lecturer_id'] = $lecturer['nidn'];
        $data['active_state'] = "Project";        
      }
    }

    $this->view('templates/project/header', $data);
    $this->view('project/projectDetails', $data);
    $this->view('templates/home/footer', $data);
  }

  public function Task()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }

    if (isset($_SESSION['S_Login'])) {
      if (isset($_POST['create_task'])) {
        // $task = $this->model('Task_model')->addTask($_POST);
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->addTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Success', 
            'Task successfully created', 
            'success',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );          
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to create a task, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }      
      }
      
      if (isset($_POST['get_task'])) {
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->WorkOnTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Successfully assigned', 
            'Do your best on the task', 
            'success',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );          
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to get a task right now, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }        
      }
  
      if (isset($_POST['drop_task'])) {
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->dropTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Task Dropped',
            'Thanks for your participation, \n please note that your student social score will be deducted', 
            'success',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to drop a task right now, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }        
      }
      
      if (isset($_POST['complete_task'])) {
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->completeTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Task Submited',
            'Thanks for your hardwork, Please wait for leader confirmation', 
            'success',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to submit a task right now, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }        
      }        
  
      if (isset($_POST['approve_task'])) {
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->approveTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Task Approved',
            'Task successfully approved, please do praise your member',
            'success',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to approve a task right now, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }           
      }
  
      if (isset($_POST['reject_task'])) {
        $id = $_GET['id'];
        $group = $_GET['group'];
        if ($this->model('Task_model')->rejectTask($_POST) > 0) {
          Alert::setAlertPopup(
            'Task Rejected',
            'Please do mention your member to revise the task',
            'success',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed', 
            'Unable to reject a task right now, please try again later', 
            'error',
            'document.location.href = "'. BASEURL .'/Project/Task?id='.$id.'&group='.$group.'"'
          );
          echo Alert::AlertPopup();
        }           
      }     
  
      if (isset($_GET['id']) && isset($_GET['group'])) {
        // $project = $this->model('Project_model')->getProjectWithTask($_GET['id']);
        $team = $this->model('Team_model')->getTeamByProjectGroup($_GET['group'], $_GET['id']);
        $project = $this->model('Project_model')->getProjectById($team[0]['project_id']);
        $task = $this->model('Task_model')->getTaskByProjectGroup($project['id'], $team[0]['groups']);
        $student = $this->model('Student_model')->getStudentByNpm($_COOKIE['npm']);
        
        // Check if current active npm equal to project team manager so i should get the team first
        if ($student['npm'] == $team[0]['manager_id']) {
          $data['manager_privilege'] = true;
        }
        
        $data['student'] = $student;
        $data['task'] = $task;
        $data['task_id'] = [];
        $data['task_description'] = [];
        $data['task_title'] = [];
        $data['task_start_date'] = [];
        $data['task_end_date'] = [];
        $data['task_taken_date'] = [];
        $data['task_completed_date'] = [];
        $data['task_level'] = [];
        $data['task_submission_link'] = [];
        $data['task_available_status'] = [];
        $data['task_progress_status'] = [];
        $data['task_approval_status'] = [];
        $data['task_responsible'] = [];
  
        if (isset($task)) {
          foreach ($task as $t) {
            array_push($data['task_id'], $t['id']);
            array_push($data['task_description'], $t['description']);
            array_push($data['task_title'], $t['title']);
            array_push($data['task_start_date'], $t['start_date']);
            array_push($data['task_end_date'], $t['end_date']);
            array_push($data['task_taken_date'], $t['taken_date']);
            array_push($data['task_completed_date'], $t['completed_date']);
            array_push($data['task_level'], $t['level']);
            array_push($data['task_submission_link'], $t['submission_link']);
            array_push($data['task_available_status'], $t['available_status']);
            array_push($data['task_progress_status'], $t['task_status']);
            array_push($data['task_approval_status'], $t['approval_status']);
            array_push($data['task_responsible'], $t['student_id']);
          }
        }

        // GET FRIEND REQUEST
        $requests = $this->model('Friends_model')->getFriendRequest($_COOKIE['npm']);
        $data['requester_name'] = [];
        foreach ($requests as $request) {
          $student = $this->model('Student_model')->getStudentByNpm($request['relating_student']);
          array_push($data['requester_name'], $student['name']);
        } 
  
        $data['image'] = $student['profile_image'];
        $data['name'] = $student['name'];
        $data['student_id'] = $student['npm'];
        $data['active_state'] = "Project";
      }     
    }

    if (isset($_SESSION['L_Login'])) {
      if (isset($_GET['id']) && isset($_GET['group'])) {
        $team = $this->model('Team_model')->getTeamByProjectGroup($_GET['group'], $_GET['id']);
        $project = $this->model('Project_model')->getProjectById($team[0]['project_id']);
        $task = $this->model('Task_model')->getTaskByProjectGroup($project['id'], $team[0]['groups']);
        $lecturer = $this->model('Lecturer_model')->getLecturerByNidn($_COOKIE['nidn']);
        
        $data['task'] = $task;
        $data['task_id'] = [];
        $data['task_description'] = [];
        $data['task_title'] = [];
        $data['task_start_date'] = [];
        $data['task_end_date'] = [];
        $data['task_taken_date'] = [];
        $data['task_completed_date'] = [];
        $data['task_level'] = [];
        $data['task_submission_link'] = [];
        $data['task_available_status'] = [];
        $data['task_progress_status'] = [];
        $data['task_approval_status'] = [];
        $data['task_responsible'] = [];
  
        if (isset($task)) {
          foreach ($task as $t) {
            array_push($data['task_id'], $t['id']);
            array_push($data['task_description'], $t['description']);
            array_push($data['task_title'], $t['title']);
            array_push($data['task_start_date'], $t['start_date']);
            array_push($data['task_end_date'], $t['end_date']);
            array_push($data['task_taken_date'], $t['taken_date']);
            array_push($data['task_completed_date'], $t['completed_date']);
            array_push($data['task_level'], $t['level']);
            array_push($data['task_submission_link'], $t['submission_link']);
            array_push($data['task_available_status'], $t['available_status']);
            array_push($data['task_progress_status'], $t['task_status']);
            array_push($data['task_approval_status'], $t['approval_status']);
            array_push($data['task_responsible'], $t['student_id']);
          }
        }
  
        $data['image'] = $lecturer['profile_image'];
        $data['name'] = $lecturer['name'];
        $data['lecturer_id'] = $lecturer['nidn'];
        $data['active_state'] = "Project";
      }           
    }

    $this->view('templates/project/header', $data);
    $this->view('project/projectTask', $data);
    $this->view('templates/home/footer', $data);
  }
}
