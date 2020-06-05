<?php 
$page = '';
if (isset($_GET['page'])) {
  switch ($_GET['page']) {
    case 'hotel':
      $page = 'hotel';
      break;

      case 'main':
      $page = 'main';
      break;
    
    default:
      $page = '404';
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: " . "404.htm");
      break;
  }  
} else {
  $page = 'main';
}

function get_content($page)
{
  $page = 'content/' . $page . '.php';
  if (file_exists($page)) {
    include_once $page;
  } else {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . "404.htm");
  }
  
}
?>

<?php 
  include_once 'header.php';
  get_content($page);
  include_once 'footer.php';
?>
      
      