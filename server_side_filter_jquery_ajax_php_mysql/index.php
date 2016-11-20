<!DOCTYPE html>
<html>
<head>
<title>Server Side Filtering</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<style type="text/css">
.form-control{float: left;width: 70%;}
.btn{float: left;margin-left: 5px;}
/* For Loading Overlay by CodexWorld */
.container{position: relative;}
.loading-overlay{
	position: absolute;
	left: 0; 
	top: 0; 
	right: 0; 
	bottom: 0;
	z-index: 2;
	background: rgba(255,255,255,0.7);
}
.overlay-content {
	position: absolute;
	transform: translateY(-50%);
	 -webkit-transform: translateY(-50%);
	 -ms-transform: translateY(-50%);
	top: 50%;
	left: 0;
	right: 0;
	text-align: center;
	color: #555;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
function getUsers(type,val){
    $.ajax({
        type: 'POST',
        url: 'getData.php',
        data: 'type='+type+'&val='+val,
		beforeSend:function(html){
			$('.loading-overlay').show();
		},
        success:function(html){
			$('.loading-overlay').hide();
            $('#userData').html(html);
        }
    });
}
</script>
</head>
<body>
<div class="container">
    <h2>Users Search & Filter by CodexWorld</h2>
    <div class="form-group pull-left">
        <input type="text" class="search form-control" id="searchInput" placeholder="By Name or Email">
        <input type="button" class="btn btn-primary" value="Search" onclick="getUsers('search',$('#searchInput').val())"/>
    </div>
    <div class="form-group pull-right">
        <select class="form-control" onchange="getUsers('sort',this.value)">
          <option value="">Sort By</option>
          <option value="new">Newest</option>
          <option value="asc">Ascending</option>
          <option value="desc">Descending</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
    </div>
    <div class="loading-overlay" style="display: none;"><div class="overlay-content">Loading.....</div></div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="userData">
            <?php
                include 'DB.php';
                $db = new DB();
                $users = $db->getRows('users',array('order_by'=>'id DESC'));
                if(!empty($users)){ $count = 0;
                    foreach($users as $user){ $count++;
            ?>
            <tr>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['phone']; ?></td>
                <td><?php echo $user['created']; ?></td>
                <td><?php echo ($user['status'] == 1)?'Active':'Inactive'; ?></td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="5">No user(s) found...</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>