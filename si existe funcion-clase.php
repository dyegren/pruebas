*/saber si existe un aclase*/
if (class_exists('ZipArchive')) {
		$zip = new ZipArchive();
		$zip->open($zipname, ZipArchive::CREATE);
	}else{
		sc_echo('No existe la librería ZipArchive en este servidor');
	}
*/saber si exite una funcion*/
if (! function_exists('pcntl_fork')) die('PCNTL functions not available on this PHP installation');
