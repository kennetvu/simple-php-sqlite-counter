<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('test.db');
      }
   }

function createDatabase($db){
   $sql =<<<EOF
      CREATE TABLE VISITORS
      (ID INT PRIMARY KEY     NOT NULL,
      VISITORS INT);
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
   $db->close();
}

function updateDatabase($db, $value){
   $sql ="UPDATE VISITORS set VISITORS =".$value." where ID=1";
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
     // echo $db->changes(), " Record updated successfully\n";
   }
}
//Open db connection
$db = new MyDB();
if(!$db){
   echo $db->lastErrorMsg();
} else {
   echo "Opened database successfully<br />";
}

// Read value from sqlite file. Update it with new value
   $sql ="SELECT * from VISITORS";
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      //echo "ID = ". $row['ID'] . "\n";
      $visitors = intval($row['VISITORS']);
      echo "Current visitors = ". $visitors ."\n";
   }
//   echo "Operation done successfully\n";
   echo "NEW visitors".++$visitors."\n";
   updateDatabase($db,$visitors);
   $db->close();

?>