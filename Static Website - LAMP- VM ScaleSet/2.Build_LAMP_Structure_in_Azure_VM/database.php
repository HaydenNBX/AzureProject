<!DOCTYPE html>
<html>
<head>
    <meta char-set="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>
<style>
    body {
	color: white;
	background-color: rgb(64, 64, 64);
    }


    hr {
	margin-top: 1rem;
	margin-bottom: 1rem;
	border: 0;
	border-top: 1px solid rgb(108, 117, 125);
    }
</style>

<body>
    <nav class="navbar navbar-light navbar-expand-lg" style="background-color: rgb(237, 125, 49)">
	<a class="navbar-brand">
		<p class="lead" style="margin-bottom: 0rem">Logo</p>
	</a>
    </nav>
    <div id="component" class="jumbotron jumbotron-fluid" style="padding-top: 1rem; background-color: rgb(64, 64, 64);">
	<div class="container">
	    <h2 class="display-4" style="padding-bottom: 1rem;">Scale Set Lab</h2>
	    <p class="lead"></p>
	    <hr class="my-4">
	    <h5 class="">Product Information</h5>
	    <table class="table table-dark">
	  	  <thead>
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">Category</th>
		      <th scope="col">Product</th>
		    </tr>
		  </thead>
		  <tbody>	
		  	<?php
			if ( isset($_POST['server']) && !empty($_POST['server'])){
				$serverName = $_POST['server'];
				$connectionOptions = array(
					"Database" => $_POST['database'],
					"Uid" => $_POST['user'],
					"PWD" => $_POST['password']
				);
			//Establishes the connection
			$conn = sqlsrv_connect($serverName, $connectionOptions);
			$tsql= "SELECT TOP 30 pc.Name as CategoryName, p.name as ProductName
				FROM [SalesLT].[ProductCategory] pc
				JOIN [SalesLT].[Product] p
				ON pc.productcategoryid = p.productcategoryid";
			$getResults= sqlsrv_query($conn, $tsql);
			if ($getResults == FALSE)
				echo (sqlsrv_errors());
			$counter = 1;
			while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {?>
		    <tr>
			<th scope="row"><?php echo ($counter);?></th>	
			<td><?php echo ($row['CategoryName'] . " " . PHP_EOL);?></td>	
			<td><?php echo ($row['ProductName'] . PHP_EOL);?></td>
			<?php $counter++; } sqlsrv_free_stmt($getResults);}?>
		    </tr>
		  </tbody>
		</table>
	</div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

		<script>
		var Item = new Vue({
		el: '#component',
			data: {
			user: {
			server: null,
				database: null,
				name: null,
				password: null
	},
		isShow: false
	},
		created: function () {
		},
		methods: {
		}
	})
		</script>

</html>



