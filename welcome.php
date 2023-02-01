<html>
    <div align="center">
        <h1>Welcome!</h1>
    
        <?php
        $words = explode(" ", $_GET["myText"]);
        $rowsperpage = 10;
        $totalpages = ceil(count($words)/$rowsperpage);
        
        
        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
                // cast var as int
                $currentpage = (int) $_GET['currentpage'];
            } else {
                // default page num
                $currentpage = 1;
            }
            // if current page is greater than total pages...
            if ($currentpage > $totalpages) {
                // set current page to last page
                $currentpage = $totalpages;
            } // end if
            if ($currentpage < 1) {
                // set current page to first page
                $currentpage = 1;
            } // end if
            

         if($currentpage = 1){  
            $words = explode(" ", $_GET["myText"]);
         }
            if(isset($words)){
                 $i = count($words);
                 while($i > 0){
                     $i = $i - 1;
                    echo '<a href="#">'. $words[$i] .'</a>';
                     echo " ";
                    
                 }
            
        
            

            // the offset of the list, based on current page 
            $offset = ($currentpage - 1) * $rowsperpage;
            if ($currentpage > 1) {
                // show << link to go back to page 1
                echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
                // get previous page num
                $prevpage = $currentpage - 1;
                // show < link to go back to 1 page
                echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
            } // end if
            // loop to show links to range of pages around current page
            $range = $totalpages - 1;
            for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
                // if it's a valid page number...
                if (($x > 0) && ($x <= $totalpages)) {
                    // if we're on current page...
                    if ($x == $currentpage) {
                        // 'highlight' it but don't make a link
                        echo " [<b>$x</b>] ";
                        // if not current page...
                    } else {
                        // make it a link
                        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
                    } // end else
                } // end if 
            } // end for

            // if not on last page, show forward and last page links        
            if ($currentpage != $totalpages) {
                // get next page
                $nextpage = $currentpage + 1;
                // echo forward link for next page 
                echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
                // echo forward link for lastpage
                echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
            } // end if
         
             }
                else{
                    echo "No text received";
                }
        
            
        ?>
    </div>
</html>
 
