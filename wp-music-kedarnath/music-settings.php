<?php
    
    //Music Settings page to get input for currency and No. of albums to be displayed
    add_action('admin_menu', 'music_settings');
    
    function music_settings(){
        add_menu_page( 'Music Settings', 'Music Settings', 'manage_options', 'music_settings', 'music_settings_init' );
    }

    function music_settings_init(){ ?>
        <div class="custom-form">
            <h3 class="wp-menu-name">Add Options</h3>
            <form method="post">

                <div class="form-group">
                    <label for="album">Enter Number of Albums to be displayed</label>
                    <input type="text" class="form-control" name="album" id="album" placeholder="Ex: 5" required>
                </div>

                <div class="form-group">
                    <label for="currency" required>Select Your Currency</label>
                    <?php
                        global $wpdb;
                        $city_query = "SELECT * FROM cities ";
		                $city_query_result = $wpdb->get_results($city_query);
                        echo '<select name="currency" id="currency">
                            <option value="0">Please Select Currency</option>
                            <option value="Indian Rupee (INR)">Indian Rupee (INR)</option>
                            <option value="U.S. Dollar (USD)">U.S. Dollar (USD)</option>
                            <option value="European Euro (EUR)">European Euro (EUR)</option>
                            <option value="British Pound (GBP)">British Pound (GBP)</option>
                        </select>';
                    ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="button button-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>

        <style>
            .custom-form {
                margin-top: 40px;
                position: absolute;
                left: 0;
                right: 0;
                top: 0;
                bottom: 0;
            }
            .custom-form label {
                padding: 20px 10px 20px 0;
                line-height: 1.3;
                font-weight: 600;
                color: #1d2327;
                font-size: 14px;
                width: 140px;
            }
            .custom-form input {
                box-shadow: 0 0 0 transparent;
                border-radius: 4px;
                border: 1px solid #8c8f94;
                background-color: #fff;
                color: #2c3338;
                width: 25em;
            }
            .custom-form .form-group {
                display: flex;
                align-items: center;
            }
        </style>

        <?php
            global $wpdb;
            $album = $_POST['album'];
            $currency = $_POST['currency'];

            if(isset($_POST['submit'])) {
                $select_query = "SELECT * FROM music ";
                if(empty($select_query)) {
                    $query = "INSERT INTO music (music_page_count, currency) VALUES ($album, '$currency')";
                    $result = $wpdb->query($query);
                } else {
                    $update_query = "UPDATE music SET music_page_count = $album, currency = '$currency' WHERE music_id = 1";
                    $result = $wpdb->query($update_query);
                }
                
            }
    }
 
?>