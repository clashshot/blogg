<?php


class ReportModel
{

    public static function reports($page = 0, $filter = 'prio', $report_per_page = 10)
    {
        //TODO Kolla rättigheter här?
        $database = DatabaseFactory::getFactory()->getConnection();
        $reports = $database->prepare('SELECT Report.*, COUNT(user_id) as times FROM Report GROUP BY type, reported_id ORDER BY priority DESC, times DESC LIMIT ' . ($page * $report_per_page) . ', ' . $report_per_page);
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
        //TODO Kolla om man har rättighet att ta bort den
        $database = DatabaseFactory::getFactory()->getConnection();
        $report = $database->prepare("DELETE FROM Report WHERE id = :id");
        return $report->execute(array('id' => $id));
    }

    public static function report($user, $type, $reported_id, $reason, $prio = 5){
        //TODO Ska man hämta user_id eller ska den skickas med
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
            'prio' => $prio
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