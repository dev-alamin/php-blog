<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2> Dashbord</h2>
        <div class="block">

            Welcome admin panel
            <p>
                <?php

                $curl = curl_init('https://httpbin.org/post');
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, array('field1' => 'some data', 'field2' => 'some more data'));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                curl_close($curl);
                echo '<pre>';
                print_r($response);
                echo '</pre>';

                ?>
            </p>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>