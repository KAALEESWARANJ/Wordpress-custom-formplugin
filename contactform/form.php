<?php
/**
* Plugin Name: Sample Contact Form Page Template
* Description: Ajax Based Conetact Form with Shortcode System to DisplayAnywhere.

 */

add_shortcode( 'shows_fields', 'pontoon_table_shortcode' );

function pontoon_table_shortcode( $args ) {
    global $wpdb;

    $content .= '<table>';
    $content .= '<thead></tr><th>S.no</th><th>Name</th><th>Email</th><th>MobileNumber</th><th>Subjects</th></tr></thead><tbody>';
    $results = $wpdb->get_results( 'SELECT * FROM wp_testform' );
    foreach ( $results AS $row ) {
        $content .= '<tr>';
        $content .= '<td>'.$row->id.'</td>';
        $content .= '<td>'.$row->name.'</td>';
        $content .= '<td>'.$row->email.'</td>';
        $content .= '<td>'.$row->number.'</td>';
        $content .= '<td>'.$row->your_comments.'</td>';
        $content .= '</tr>';
    }
    $content .= '</tbody></table>';

    return $content;
}
?><?php

add_shortcode( 'add_fields', 'input_fields' );   
function input_fields( $atts ) 
{
   //require_once('/wp-config.php');
    global $wpdb;

    if(isset($_POST['submit'])){
       $id= $wpdb->insert( 'wp_testform', array( 'name' =>
        $_POST['cname'], 'email' => $_POST['cemail'], 'number' =>
        $_POST['cnumber'], 'your_comments' => $_POST['cyour_comments'] ),
        array( '%s', '%s', '%d', '%s' ) );
        if($id)
        {
          //global $wpdb;    
          //$result = $wpdb->get_results( "SELECT * FROM wp_testform WHERE  id = '1'");
          //print_r($result);
          if (!empty($_POST)) {
            header("Location: $_SERVER[PHP_SELF]"); 
          }
        }
    }
?>


<?php global $pc_theme_object; /* Reference theme framework class */ ?>
<?php get_header(); ?>

<form action="" id="postjob" method="post">
    <table>
        <tr>
            <td><label for="cname">Name:</label></td>
            <td><input type="text" name="cname" id="name" value="" required=""></td>
        </tr>
        <tr>
            <td><label for="cemail">Email:</label></td>
            <td><input type="text" name="cemail" id="email" value=""  required=""></td>
        </tr>
        <tr>
            <td><label for="cnumber">Mobile Number:</label></td>
            <td><input type="text" name="cnumber" id="number" required=""></td>
        </tr>
        <tr>
            <td><label for="cyour_comments">Subject:</label></td>
            <td><input type="text" name="cyour_comments" id="your_comments"  required=""></td>
        </tr>
        <tr>
            <td><button type="submit" name="submit">Submit</button></td>
        </tr>
    </table>
</form>
<?php get_footer(); }?>

