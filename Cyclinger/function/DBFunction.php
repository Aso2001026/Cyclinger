<?php
function preInsert($urltoken,$pre_name,$pre_mail,$pre_pass,$pre_age,$pre_sexflag,$pdo){
    try{
        $pre_pass = password_hash($pre_pass, PASSWORD_BCRYPT);
        //例外処理を投げる（スロー）ようにする
        $sql = "INSERT INTO m_pre_users (pre_user_token,pre_user_name, pre_user_mail,pre_user_pass,pre_age,pre_sex_flag, reg_date, flag) VALUES (:pre_user_token,:pre_user_name, :pre_user_mail,:pre_user_pass, :pre_age,:pre_sex_flag ,now(), '0')";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':pre_user_token', htmlspecialchars($urltoken), PDO::PARAM_STR);
        $stm->bindValue(':pre_user_name', htmlspecialchars($pre_name), PDO::PARAM_STR);
        $stm->bindValue(':pre_user_mail', htmlspecialchars($pre_mail), PDO::PARAM_STR);
        $stm->bindValue(':pre_user_pass', htmlspecialchars($pre_pass), PDO::PARAM_STR);
        $stm->bindValue(':pre_age', htmlspecialchars($pre_age), PDO::PARAM_STR);
        $stm->bindValue(':pre_sex_flag', htmlspecialchars($pre_sexflag), PDO::PARAM_STR);
        $stm->execute();
        $pdo = null;
    }catch (PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }
}

function userInsert($urltoken,$pdo){
    $error['insert'] = true;
    try{

        $sql = "SELECT * FROM m_pre_users WHERE pre_user_token=(:pre_user_token) AND flag =0 AND reg_date > now() - interval 24 hour";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':pre_user_token', htmlspecialchars($urltoken), PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);



//例外処理を投げる（スロー）ようにする
            $sql = "INSERT INTO m_users (user_name,user_mail,user_pass,age,sex_flag, reg_date) VALUES (:user_name, :user_mail,:user_pass, :age,:sex_flag ,now())";
            $insert = $pdo->prepare($sql);
            $insert->bindValue(':user_name', htmlspecialchars($result['pre_user_name']), PDO::PARAM_STR);
            $insert->bindValue(':user_mail', htmlspecialchars($result['pre_user_mail']), PDO::PARAM_STR);
            $insert->bindValue(':user_pass', htmlspecialchars($result['pre_user_pass']), PDO::PARAM_STR);
            $insert->bindValue(':age', htmlspecialchars($result['pre_age']), PDO::PARAM_STR);
            $insert->bindValue(':sex_flag', htmlspecialchars($result['pre_sex_flag']), PDO::PARAM_STR);
            $insert->execute();

    }catch (PDOException $e){
        print('Error:'.$e->getMessage());
        die();
        $error['insert'] = false;
    }
    return $error;

}

function login($mail,$pdo){
    $flag = false;
    $statement = $pdo->prepare("select * from m_users where user_mail=?");
    $statement->execute(array(
        htmlspecialchars($mail)
    ));
    foreach ($statement as $row) {
        $_SESSION['user']=[
            'id'=>$row['user_id'],
            'name'=>$row['user_name'],
            'image_id'=>$row['user_image_id'],
            'mail' => $row['user_mail'],
            'age'=>$row['age'],
            'sex'=>$row['sex_Flag']
        ];
        $flag = true;
    }
    return $flag;

}

function sumDistance($userId,$pdo){
    $statement = $pdo->prepare("select sum(distance) as sumDistance from t_CourseHistory where user_id=(:user_id)");
    $statement->bindValue(':user_id', htmlspecialchars($userId), PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function userChange($name,$mail,$pass,$age,$pdo){
    $flag = false;
    try{
        $pass = password_hash($pass, PASSWORD_BCRYPT);
        //例外処理を投げる（スロー）ようにする
        $sql = "UPDATE m_users SET user_name=(:user_name),user_pass=(:user_pass),age=(:age),reg_date=now() where user_mail = (:user_mail) ";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':user_name', htmlspecialchars($name), PDO::PARAM_STR);
        $stm->bindValue(':user_pass', htmlspecialchars($pass), PDO::PARAM_STR);
        $stm->bindValue(':age', htmlspecialchars($age), PDO::PARAM_STR);
        $stm->bindValue(':user_mail', htmlspecialchars($mail), PDO::PARAM_STR);
        $stm->execute();
        login($mail,$pdo);
        $flag = true;
        $pdo = null;
    }catch (PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }
    return $flag;
}

function myFavoriteSelect($user_id,$pdo){

    $statement = $pdo->prepare(
        "select t_myCourse.mycourse_id , t_myCourse.user_id, m_course.course_name, m_course.reg_date,m_course.course_distance from t_myCourse  inner join m_course on t_myCourse.course_id = m_course.course_id 
         where t_myCourse.user_id = (:user_id) order by t_myCourse.mycourse_id"
    );
    $statement->bindValue(':user_id', htmlspecialchars($user_id), PDO::PARAM_STR);
    $result =  $statement->execute();
    if($result) {
        return $statement;
    }else{
        return $result;
    }
}

function createRouteSelect($user_id,$pdo){

    $statement = $pdo->prepare(
        "select * from m_course  
         where user_id = (:user_id) order by course_id"
    );
    $statement->bindValue(':user_id', htmlspecialchars($user_id), PDO::PARAM_STR);
    $result =  $statement->execute();
    if($result) {
        return $statement;
    }else{
        return $result;
    }
}

function historyCourseSelect($user_id,$pdo){

    $statement = $pdo->prepare(
        "SELECT DATE_FORMAT(t_CourseHistory.end_time, '%Y-%m-%d') AS time, SUM(t_CourseHistory.distance) AS sum 
         FROM t_CourseHistory  inner join m_course on t_CourseHistory.course_id = m_course.course_id  
         WHERE t_CourseHistory.end_time BETWEEN DATE_SUB(curdate(), interval 6 day) AND now()
         AND t_CourseHistory.user_id = (:user_id)
         GROUP BY DATE_FORMAT(t_CourseHistory.reg_date, '%Y%m%d')
         ORDER BY time"
    );
    $statement->bindValue(':user_id', htmlspecialchars($user_id), PDO::PARAM_STR);
    $result =  $statement->execute();
    if($result) {
        return $statement;
    }else{
        return $result;
    }
}







?>
