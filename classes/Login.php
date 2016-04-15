<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session, absolutely necessary
        session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // check login form contents
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff
                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);

                // database query, getting all the info of the selected user (allows login via email address in the
                // username field)
                $sql = "SELECT user_name, user_id, user_email, user_password_hash, user_role, first_name, last_name, Archive, login
                        FROM users
                        WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_name . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists

                if ($result_of_login_check->num_rows == 1) {

                    // get result row (as an object)
                    $result_row = $result_of_login_check->fetch_object();

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['user_password'], $result_row->user_password_hash)) {

                        // write user data into PHP SESSION (a file on your server)

                        $_SESSION['user_name'] = $result_row->user_name;
$_SESSION['user_id'] = $result_row->user_id;
                        $_SESSION['user_email'] = $result_row->user_email;
                        $_SESSION['user_role'] = $result_row->user_role;
$_SESSION['first_name'] = $result_row->first_name;
$_SESSION['last_name'] = $result_row->last_name;
$_SESSION['archive'] = $result_row->Archive;
$_SESSION['login'] = $result_row->login;
$role = $_SESSION['user_role'];
$login = $_SESSION['login'];
$name = $_SESSION['user_name'];

            $sql = "UPDATE users set login = NOW() WHERE user_name = '" . $name. "';";
 $query_user_login = $this->db_connection->query($sql);


$sql = "SELECT CreateTemplate, CreateReport, DeleteReport, EditReport, OpenReport, CloseReport,user_management, delete_template, update_template, AddAttatchment, DeleteAttatchment
                        FROM roles
                        WHERE user_role = '" . $role . "' OR user_role = '" . $role . "';";
                $result_of_role_check = $this->db_connection->query($sql);

if($result_of_role_check->num_rows == 1){

$result_row = $result_of_role_check->fetch_object();
$_SESSION['CreateTemplate'] = $result_row->CreateTemplate;
$_SESSION['CreateReport'] = $result_row->CreateReport;
$_SESSION['DeleteReport'] = $result_row->DeleteReport;
$_SESSION['EditReport'] = $result_row->EditReport;
$_SESSION['CloseReport'] = $result_row->CloseReport;
$_SESSION['OpenReport'] = $result_row->OpenReport;
$_SESSION['DeleteTemplate'] = $result_row->delete_template;
$_SESSION['UpdateTemplate'] = $result_row->update_template;
$_SESSION['ChangeReport'] = $result_row->ChangeReport;
$_SESSION['AddAttatchment'] = $result_row->AddAttatchment;
$_SESSION['DeleteAttatchment'] = $result_row->DeleteAttatchment;
$_SESSION['password'] = $result_row->user_password_hash;
$_SESSION['user_management'] = $result_row->user_management;
}


if($_SESSION['archive'] == 0) {
                        $_SESSION['user_login_status'] = 1;
} else { $this->errors[] = "User Archived."; }
                    } else {
                        $this->errors[] = "Wrong password. Try again.";
                    }
                } 
                else {
                    $this->errors[] = "This user does not exist.";
                }
            } else {
                $this->errors[] = "Database connection problem.";
            }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "You have been logged out.";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}
