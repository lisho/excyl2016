

<table>
    <?php $i=1; ?>
    <thead>
        <tr>
            <h2>Candidatos perceptores de RGC según nómina de León de Abril de 2016 </h2>
        </tr>
        <tr>
            <th></th>
            <th>DNI</th>
            <th>NOMBRE</th>
        </tr>
        
    </thead>

    <tbody>
        <?php foreach ($listado_en_nomina as $dni => $nombre): ?>
            <tr>
                <td><?= $i;?></td>
                <td><?= $dni;?></td>
                <td><?= $nombre;?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach ?>
    </tbody>

</table>Abril

<br>

<table>
    <?php $i=1; ?>
    <thead>
        <tr>
            <h2>Candidatos NO perceptores de RGC según nómina de León de Abril de 2016 </h2>
        </tr>
        <tr>
            <th></th>
            <th>DNI</th>
            <th>NOMBRE</th>
        </tr>
        
    </thead>

    <tbody>
        <?php foreach ($listado_no_nomina as $dni => $nombre): ?>
            <tr>
                <td><?= $i;?></td>
                <td><?= $dni;?></td>
                <td><?= $nombre;?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach ?>
    </tbody>

</table>