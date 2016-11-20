<?php
include 'DB.php';
$db = new DB();
$tblName = 'users';
$conditions = array();
if(!empty($_POST['type']) && !empty($_POST['val'])){
    if($_POST['type'] == 'search'){
        $conditions['search'] = array('name'=>$_POST['val'],'email'=>$_POST['val']);
        $conditions['order_by'] = 'id DESC';
    }elseif($_POST['type'] == 'sort'){
        $sortVal = $_POST['val'];
        $sortArr = array(
            'new' => array(
                'order_by' => 'created DESC'
            ),
            'asc'=>array(
                'order_by'=>'name ASC'
            ),
            'desc'=>array(
                'order_by'=>'name DESC'
            ),
            'active'=>array(
                'where'=>array('status'=>'1')
            ),
            'inactive'=>array(
                'where'=>array('status'=>'0')
            )
        );
        $sortKey = key($sortArr[$sortVal]);
        $conditions[$sortKey] = $sortArr[$sortVal][$sortKey];
    }
}else{
    $conditions['order_by'] = 'id DESC';
}
$users = $db->getRows($tblName,$conditions);
if(!empty($users)){
    $count = 0;
    foreach($users as $user): $count++;
        echo '<tr>';
        echo '<td>'.$user['name'].'</td>';
        echo '<td>'.$user['email'].'</td>';
        echo '<td>'.$user['phone'].'</td>';
        echo '<td>'.$user['created'].'</td>';
        $status = ($user['status'] == 1)?'Active':'Inactive';
        echo '<td>'.$status.'</td>';
        echo '</tr>';
    endforeach;
}else{
    echo '<tr><td colspan="5">No user(s) found...</td></tr>';
}
exit;