<?php
// some data to be used in the csv files
$headers = array('id', 'name', 'age', 'species');
$records = array(
    array('1', 'gise', '4', 'cat'),
    array('2', 'hek2mgl', '36', 'human'),
    array('3', 'gise', '4', 'cat'),
    array('4', 'gise', '4', 'cat'),
    array('5', 'gise', '4', 'cat'),
    array('6', 'gise', '4', 'cat'),
    array('7', 'gise', '4', 'cat'),
    array('8', 'gise', '4', 'cat'),
    array('9', 'gise', '4', 'cat'),
    array('10', 'gise', '4', 'cat')
);

// create your zip file
$zipname = 'file.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);

// loop to create 3 csv files
for ($i = 0; $i < 5; $i++) {
    //for ($records = 0; $records < 2; $records++) {
        // create a temporary file
        $fd = fopen('php://temp/maxmemory:1048576', 'w');
        if (false === $fd) {
            die('Failed to create temporary file');
        }

        // write the data to csv
        fputcsv($fd, $headers);
        //for ($records = 0; $records < 2; $records++) {
        $cont = 0;
        foreach ($records as $record) {

            if($cont < 2) {

                fputcsv($fd, $record);
            }else{
                break;
            }
            $cont++;

        }

        // return to the start of the stream
        rewind($fd);

        // add the in-memory file to the archive, giving a name
        $zip->addFromString('file-' . $i . '.csv', stream_get_contents($fd));
        //close the file
        fclose($fd);
    //}
}
// close the archive
$zip->close();


header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);

// remove the zip archive
// you could also use the temp file method above for this.
unlink($zipname);
