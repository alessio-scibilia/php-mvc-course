<?php
    $restaurant = (array)$view_model->restaurant;
?>
<html>
    <head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <link rel="stylesheet" type="text/css" href="/css/override.css">
        <link rel="stylesheet" type="text/css" href="/css/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="/css/owl.theme.default.css">
    </head>
    <body>
        <div>getenv(): <?php echo getenv('POENV'); ?></div>
        <div>apache_getenv(): <?php echo apache_getenv('ENV'); ?></div>
        <table>
            <caption>ristorante:</caption>
            <?php foreach ($restaurant as $field => $value) { ?>
            <tr>
                <td><?php echo $field; ?></td>
                <td>
                    <input type="text" name="restaurant[<?php echo $field; ?>]" value="<?php echo $value; ?>" />
                </td>
            </tr>
            <?php } ?>
        </table>

        <table>
            <caption>suggeriti:</caption>
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <?php foreach ($view_model->restaurants as &$restaurant) { ?>
                <tr>
                    <td><?php echo $restaurant->nome; ?></td>
                    <td><?php echo $restaurant->email; ?></td>
                    <td><?php echo $restaurant->telefono; ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
