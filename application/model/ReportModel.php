<?php


class ReportModel
{

    public static function reports($page = 0, $filter = 'prio', $report_per_page = 10)
    {
        if(Auth::checkAdminAuthentication()){
            return false;
        }
        $database = DatabaseFactory::getFactory()->getConnection();
        $reports = $database->prepare('SELECT *FROM Report LEFT JOIN users ON Report.user_id = users.user_id WHERE Report.status != 1 ORDER BY priority DESC LIMIT ' . ($page * $report_per_page) . ', ' . $report_per_page);
        $reports->execute();
        if ($reports->rowCount() > 0) {
            $reportList = array();
            while ($report = $reports->fetchObject()){
                $reportList[] = $report;
            }
            return $reportList;
        } else {
            return false;
        }
    }

    public static function reportlog($page = 0, $filter = 'prio', $report_per_page = 10){
        if(Auth::checkAdminAuthentication()){
            return false;
        }
        $database = DatabaseFactory::getFactory()->getConnection();
        $reports = $database->prepare('SELECT Report.*, user.user_id as user_id, user.user_name as user_name, admin.user_id as admin_id, admin.user_name as admin_name FROM Report LEFT JOIN users as user ON Report.user_id = user.user_id LEFT JOIN users as admin ON Report.admin_id = admin.user_id WHERE Report.status = 1 ORDER BY priority DESC LIMIT ' . ($page * $report_per_page) . ', ' . $report_per_page);
        $reports->execute();
        if ($reports->rowCount() > 0) {
            $reportList = array();
            while ($report = $reports->fetchObject()){
                $reportList[] = $report;
            }
            return $reportList;
        } else {
            return false;
        }
    }

    public static function completed($id){
        if(Auth::checkAdminAuthentication()){
            return false;
        }
        $database = DatabaseFactory::getFactory()->getConnection();
        $report = $database->prepare("UPDATE Report SET admin_id = :user, status = 1 WHERE id = :id");
        return $report->execute(array(':id' => $id, ':user' => Session::get('user_id')));
    }

    public static function statuschange($id, $status){
        if(Auth::checkAdminAuthentication()){
            return false;
        }
        $database = DatabaseFactory::getFactory()->getConnection();
        $report = $database->prepare("UPDATE Report SET admin_id = :user, status = :status WHERE id = :id");
        return $report->execute(array(':id' => $id, ':status' => $status, ':user' => Session::get('user_id')));
    }

    public static function report(){
        $user = Session::get('user_id');
        $type = Request::post('type');
        $reported_id = Request::post('reported_id');
        $reason = Request::post('reason');
        $priority = 1;
        if(isset($_POST['prio'])){
            $priority = Request::post('prio');
        }
        if(reportexists($user, $type, $reported_id)){
            return false;
        }
        $database = DatabaseFactory::getFactory()->getConnection();
        $report = $database->prepare("INSERT INTO Report(`user_id`, `type`, `reported_id`, `reason`, `priority`) VALUES(:user, :type, :reported, :reason, :prio)");
        return $report->execute(array(
            'user' => $user,
            'type' => $type,
            'reported' => $reported_id,
            'reason' => $reason,
            'prio' => $priority
        ));
    }

    public static function reportexists($user, $type, $reported_id){
        $database = DatabaseFactory::getFactory()->getConnection();
        $report = $database->prepare("SELECT *FROM Report WHERE user_id = :user AND type = :type AND reported_id = :report");
        $report->execute(array('user' => $user, 'type' => $type, 'report' => $reported_id));
        if ($report->rowCount() > 0){
            return true;
        }
        return false;
    }
}