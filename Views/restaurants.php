<?php
?>
<html>
    <body>
        <table>
            <caption>ristorante:</caption>
            <?php foreach ($view_model->restaurant as $field => $value) { ?>
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
            <?php foreach ($view_model->restaurants as $restaurant) { ?>
                <tr>
                    <td><?php echo $restaurant->name; ?></td>
                    <td><?php echo $restaurant->email; ?></td>
                    <td><?php echo $restaurant->telefono; ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
