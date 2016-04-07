<?php 
include('helper.php');

//debug_to_console( 'datatables.php');
//queries

$teilnehmer = "SELECT * FROM Teilnehmer;";

$results = runSQLquery($teilnehmer, 'select');
//echo results
//echo '<h1><pre>'; print_r(var_dump($results)); echo '</pre></h1>';
?>

<table id="datatable" class="table table-striped table-bordered" width="100%" cellspacing="0">    
    <thead>
        <tr>
         <th>ID</th>
         <th>Vorname</th>
         <th>Nachname</th>
         <th>Mailadresse</th>
         <th>firma</th>
         <th>betrieb</th>
        </tr>
    </thead>
    <tfoot>
         <th>ID</th>
         <th>Vorname</th>
         <th>Nachname</th>
         <th>Mailadresse</th>
         <th>firma</th>
         <th>betrieb</th>
    </tfoot>
    <tbody>
    <?php foreach ($results as $row) {?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['vorname']; ?></td>
            <td><?php echo $row['nachname']; ?></td>
            <td><?php echo $row['mailadresse']; ?></td>
            <td><?php echo $row['firma']; ?></td>
            <td><?php echo $row['betrieb']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
