<?PHP
 
CLASS DB_Class {
 
     VAR $db;
     ///////////////////////////
     FUNCTION DB_Class($dbname, $username, $password) {
          $this->db = MYSQL_CONNECT ('localhost', $username, $password)
           or DIE ("Unable to connect to Database Server");
 
          MYSQL_SELECT_DB ($dbname, $this->db) or DIE ("Could not select database");
     }
 
     FUNCTION query($sql) {
          $result = MYSQL_QUERY ($sql, $this->db) or DIE ("Invalid query: " . MYSQL_ERROR());
          RETURN $result;
     }
     ///////////////////////////
     FUNCTION fetch($sql) {
          $data = ARRAY();
          $result = $this->query($sql);
 
          WHILE($row = MYSQL_FETCH_ASSOC($result)) {
               $data[] = $row;
          }
               RETURN $data;
     }
     ///////////////////////////
     FUNCTION getone($sql) {
     $result = $this->query($sql);
 
     IF(MYSQL_NUM_ROWS($result) == 0)
          $value = FALSE;
     ELSE
          $value = MYSQL_RESULT($result, 0);
          RETURN $value;
     }
     ///////////////////////////
}
?>
 
// usage example....
 
<?PHP
 
$dbconnect = NEW DB_Class('table', 'user', 'password');
$query = "SELECT user_id FROM user_table WHERE $match = $search ORDER BY user_id DESC";
$result = $dbconnect->fetch($query);
