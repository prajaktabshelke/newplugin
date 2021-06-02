<?php
/*
    Plugin name: newplugin
    Plugin URI: https://www.google.com/
    Description: A simple wordpress customize plugin.
    Author: Prajakta Shelke
    Author URI: http://www.google.com
    Version: 1.0

    */

function my_menu_pages()
{
    add_menu_page(
        'My Page Title',
        'My Menu',
        'manage_options',
        'my-menu',
        'plugin_submenu_callback_fun'
    );

    add_submenu_page(
        'my-menu',
        'Submenu Page Title1',
        'submenu page 1',
        'manage_options',
        'my-menu',
        'plugin_submenu_callback_fun'
    );

    add_submenu_page(
        'my-menu',
        'Submenu Page Title2',
        'submenu page 2',
        'manage_options',
        'my-menu2',
        'plugin_submenu_callback_funn'
    );
}


add_action('admin_menu', 'my_menu_pages');

function plugin_submenu_callback_fun()
{
?>
    <form action="#" method="POST">
        <h2>Login Form</h2>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>

        <label for="submit">Submit:</label><br>
        <input type="submit" name="submit" onclick="submit">

    </form>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "wordpress";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['submit'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "INSERT INTO myplugin (username,password)
      VALUES ('$username', '$password')";

        if (mysqli_query($conn, $sql)) {

            echo "New record created successfully";
        }
    }
}



function plugin_submenu_callback_funn()
{
    $conn = mysqli_connect("localhost", "root", "root", "wordpress");
    ?>

    <h2>Records</h2>

    <?Php
    $sql = "SELECT * FROM myplugin";

    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table border=1 cellpadding=20>";
            echo "<tr>";
            echo "<th>userid</th>";
            echo "<th>username</th>";
            echo "<th>password</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['userid'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            mysqli_free_result($result);
        }
    }
}



function nelio_add_settings_page()
{
    add_options_page(
        'Nelio Plugin Settings',
        'submenu setting',
        'manage_options',
        'nelio-example-plugin',
        'nelio_render_settings_page'
    );
}
add_action('admin_menu', 'nelio_add_settings_page');


function nelio_render_settings_page()
{
    ?>
    <h2> Plugin Settings</h2>
    <form action="options.php" method="post">
        <?php
        settings_fields('nelio_example_plugin_settings');
        do_settings_sections('nelio_example_plugin');
        ?>
        <input type="submit" name="submit" class="button button-primary" value="<?php esc_attr_e('Save'); ?>" />
    </form>
<?php
}

?>