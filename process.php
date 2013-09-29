<?php 
require('connection.php');

	$data = array();

	$query = "SELECT * FROM leads
	WHERE (first_name LIKE '{$_POST['name']}%' OR last_name LIKE '{$_POST['name']}%')
	AND (registered_datetime >= STR_TO_DATE('{$_POST['from']}','%m/%d/%Y') 
	AND registered_datetime <= STR_TO_DATE('{$_POST['to_date']}','%m/%d/%Y'))";
	
	

	

	//var_dump($_POST['test_form']);
	$html = "";

	if(!empty($_POST['pagination'])) 
	{

		$page = "SELECT * FROM leads
		WHERE (first_name LIKE '{$_POST['name']}%' OR last_name LIKE '{$_POST['name']}%')
		AND (registered_datetime >= STR_TO_DATE('{$_POST['from']}','%m/%d/%Y') 
		AND registered_datetime <= STR_TO_DATE('{$_POST['to_date']}','%m/%d/%Y'))
		LIMIT {$_POST['results']}";

		$pages = fetch_all($page);

		for ($i=0; $i < count($pages); $i++) 
		{ 
		$j= 10*$i;

		$html .= "
			<a href='$j' name='anotherpage' class='pagelink'>{$i}</a>
			";
	 	}
	}

	

	$users = fetch_all($query);
	$html .= "
		<table>
			<thead>
				<tr>
					<th>leads_id</th>
					<th>first_name</th>
					<th>last_name</th>
					<th>registered_datetime</th>
					<th>email</th>
				</tr>
			</thead>
			<tbody>
		";
	foreach ($users as $user) 
	{
		$html .= "
			<tr>
				<td>{$user['leads_id']}</td>
				<td>{$user['first_name']}</td>
				<td>{$user['last_name']}</td>
				<td>{$user['registered_datetime']}</td>
				<td>{$user['email']}</td>
			</tr>
		";
	}

	$html .= "
		</tbody>
	</table>
	";
	$data['html'] = $html;
	echo json_encode($data);

 ?>
