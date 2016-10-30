<?php
$log_directory = 'cps621groupproject';

$results_array = array();

if (is_dir($log_directory))
{
        if ($handle = opendir($log_directory))
        {
                //Notice the parentheses I added:
                while(($file = readdir($handle)) !== FALSE)
                {
                        $results_array[] = $file;
                }
                closedir($handle);
        }
}

//Output findings
echo "<h1>CPS 621 Group Project Files</h1>";
echo "<h2>Member Names:</h2>";
echo "<ul><li>Robert Mok</li><li>Zhe Zeng</li><li>Qingbo Jiang</li><li>Michael Kwan</li></ul>";
foreach($results_array as $value)
{
echo "<a href='http://www.babbletxt.com/cps621groupproject/" . $value . "'>" . $value . "</a><br>";
}
?>