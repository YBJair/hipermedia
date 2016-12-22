<?php
$mysql_host = 'localhost'; //host
$mysql_username = 'root'; //username
$mysql_password = ''; //password
$mysql_database = 'pibd'; //db

function uuid($prefix){
	$chars = md5(uniqid(mt_rand(), true));
	$uuid  = substr($chars,0,8)."-";
	$uuid .= substr($chars,8,4)."-";
	$uuid .= substr($chars,12,4)."-";
	$uuid .= substr($chars,16,4)."-";
	$uuid .= substr($chars,20,12);
	return $prefix.$uuid;
}

header('Content-Type: text/xml; charset=utf-8', true); //set document header content type to be XML
$xml = new DOMDocument("1.0", "UTF-8"); // Create new DOM document.

//create "feed" element
$feed = $xml->createElement("feed"); 
$feed_node = $xml->appendChild($feed); //add atom element to XML node

//set attributes
$feed_node->setAttribute("xmlns:dc","http://purl.org/dc/elements/1.1/"); //xmlns:dc (info http://j.mp/1mHIl8e )
$feed_node->setAttribute("xmlns:content","http://purl.org/rss/1.0/modules/content/"); //xmlns:content (info http://j.mp/1og3n2W)
$feed_node->setAttribute("xmlns","http://www.w3.org/2005/Atom");//xmlns:atom (http://j.mp/1tErCYX )

//Create RFC822 Date format to comply with RFC822
$date_f = date("D, d M Y H:i:s T", time());
$build_date = gmdate(DATE_RFC3339, strtotime($date_f));

//create "channel" element under "RSS" element
//$channel = $xml->createElement("channel");  
//$channel_node = $rss_node->appendChild($channel);
 
//a feed should contain an atom:link element (info http://j.mp/1nuzqeC)
/*$channel_atom_link = $xml->createElement("atom:link");  
$channel_atom_link->setAttribute("href","http://localhost/hipermedia/feed.php?type=atom"); //url of the feed
$channel_atom_link->setAttribute("rel","self");
$channel_atom_link->setAttribute("type","application/rss+xml");
$channel_node->appendChild($channel_atom_link); */

//add general elements under "channel" node
$feed_node->appendChild($xml->createElement("title", "Pictures and Images")); //title
$feed_node->appendChild($xml->createElement("subtitle", "Tus fotos donde quieras, cuando quieras"));  //description
$channel_atom_link = $xml->createElement("link");
$channel_atom_link->setAttribute("href", "http://localhost/hipermedia/feed.php?type=rss"); //website link 
$channel_atom_link->setAttribute("rel", "self");
$feed_node->appendChild($channel_atom_link);
$channel_atom_link = $xml->createElement("link");
$channel_atom_link->setAttribute("href", "http://localhost/hipermedia"); //website link 
$feed_node->appendChild($channel_atom_link);
$feed_node->appendChild($xml->createElement("id", uuid("urn:uuid:")));  //language
$feed_node->appendChild($xml->createElement("updated", $build_date));  //last build date


//Fetch records from the database
//connect to MySQL - mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
$mysqli = new mysqli('localhost','root','','pibd');

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

//MySQL query, we pull records from site_contents table
$results = $mysqli->query("SELECT f.*, u.Email as email, u.NomUsuario as nombre
                                FROM fotos f, usuarios u, albumes a
                                WHERE u.idUsuario = a.Usuario and a.idAlbum = f.Album
                                ORDER BY f.FRegistro  DESC
                                LIMIT 5");
//SELECT id, title, content, published FROM site_contents
//SELECT idFoto, Titulo,Descrpcion,Fecha, Album, Fichero, FRegistro FROM fotos f, usuarios u order by FRegistro LIMIT 5
if($results){ //we have records 
    while($row = $results->fetch_assoc()) //loop through each row
    {
        $id = $row["idFoto"];
        $title = $row["Titulo"];
        $descr = $row["Descrpcion"];
        $pdate = $row["FRegistro"];
        $nombre = $row["nombre"];
        $email = $row["email"];
        

      $item_link =  $xml->createElement("entry");
      $item_node = $feed_node->appendChild($item_link);
   
      $title_node = $item_node->appendChild($xml->createElement("title", $title)); //Add Title under "item"
      $link_link = $xml->createElement("link");
      $link_link->setAttribute("href", "http://localhost/hipermedia/imagen.php?id=$id");
      $item_node->appendChild($link_link);
      
      
      //Unique identifier for the item (GUID)
      $guid_link = $xml->createElement("id", uuid("urn:uuid:"));  
      $guid_node = $item_node->appendChild($guid_link); 
     
      $updated_link = $xml->createElement("updated",$build_date);
      $updated_node = $item_node->appendChild($updated_link);
      //create "description" node under "item"
      $description_node = $item_node->appendChild($xml->createElement("summary"));  
      
      //fill description node with CDATA content
      $description_contents = $xml->createCDATASection(htmlentities($descr));  
      $description_node->appendChild($description_contents); 
    
      //author info
      $author_node = $item_node->appendChild($xml->createElement("author"));
	  $name_node = $author_node->appendChild($xml->createElement("name", $nombre));
	  $email_node = $author_node->appendChild($xml->createElement("email", $email));


    }
}
echo $xml->saveXML();
?>