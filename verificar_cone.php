<?php 


      // $db_server = 'localhost';
      // $db_user= 'root';
      // $db_pass= '';
      // $db_database = 'ipdialbox2';
include 'config.php';


	$mysqli = new mysqli($db_server, $db_user, $db_pass, $db_database);

	if ($mysqli->connect_errno) {
    	printf("Conexión fallida: %s\n", $mysqli->connect_error);
    	exit();
	}

		$insert_user = "INSERT INTO omnibox_conf_channel (id_distri,channel,user,path2,path3,path4,technology,port) VALUES ('11','holllll','33','44','55','66','77','88')";

$mysqli->query($insert_user);
	/* comprobar si el servidor sigue vivo */
	// if ($mysqli->ping()) {
	//     printf ("¡La conexión está bien!\n");
	// } else {
	//     printf ("Error: %s\n", $mysqli->error);
	// }

/* cerrar la conexión */
$mysqli->close();

 ?>