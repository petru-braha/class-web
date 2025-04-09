<?php
/* Program PHP 5+ care preia o imagine trimisa de client prin upload
   si genereaza un fisier text (CSV) continand meta-datele EXIF incluse in aceasta
   (exemplu bazat initial pe fragmente de cod oferite de manualul PHP oficial).
   Se ilustreaza si maniera de generare de exceptii proprii.
   
   Autor: Sabin-Corneliu Buraga - https://profs.info.uaic.ro/~busaco/
   2014, 2015, 2017, 2020

   Ultima actualizare: 25 februarie 2020
*/

// numele directorului cu imagini furnizat in mod portabil
// (e.g., './imagini/' pentru Linux si macOS sau '.\imagini\' pentru Windows)
define('IMGDIR', '.' . DIRECTORY_SEPARATOR . 'imagini' . DIRECTORY_SEPARATOR);

try {
	// cream mai intai directorul de stocare a imaginilor, daca nu exista
	// (atentie: trebuie stabilite permisiuni de scriere pentru utilizatorul
	// sub care se executa serverul Web!)
	if (!is_dir(IMGDIR)) {
		if (FALSE === @mkdir(IMGDIR, 0700)) {
			throw new RuntimeException('Upload: directorul n-a putut fi creat.');
		};
	}
	
	// prevenim incercari de transferuri malitioase
	if (FALSE === isset($_FILES['img']['error']) ||
		is_array($_FILES['img']['error'])) {
        throw new RuntimeException('Upload: parametri eronati.');
    }
    
    switch ($_FILES['img']['error']) {	// transferul e in regula?
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('Upload: fisier netrimis.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Upload: fisier prea mare.');
        default:
            throw new RuntimeException('Upload: eroare necunoscuta.');
    }

    // nu acceptam decat fisiere de maxim 10 MB
    // vezi si directiva 'upload_max_filesize' 
    // din fisierul de configurare 'php.ini' a mediului PHP
	if ($_FILES['img']['size'] > (10 * 1024 * 1024)) {
        throw new RuntimeException('Upload: fisier prea mare.');
    }

    // verificam daca a fost trimisa intr-adevar o imagine
    // pe baza tipurilor MIME (Media Types)
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (FALSE === $ext = array_search($finfo->file($_FILES['img']['tmp_name']),
        [ 'jpg' => 'image/jpeg',
          'png' => 'image/png',
          'gif' => 'image/gif',
          'webp'=> 'image/webp',
          'svg' => 'image/svg+xml' ], true)) {
        throw new RuntimeException('Upload: format incorect (se accepta doar GIF, JPG, PNG, SVG, WebP).');
    }

    // mutam fisierul transferat in directorul cu imagini
    // (generam un nume unic pentru fiecare imagine via algoritmul SHA1')
    // detalii la https://php.net/manual/en/function.hash.php
    $numeImg = sprintf('%s.%s', 
                    sha1_file($_FILES['img']['tmp_name']), $ext);
    if (FALSE === @move_uploaded_file ($_FILES['img']['tmp_name'], 
    	IMGDIR . $numeImg)) {
        throw new RuntimeException('Upload: eroare la salvare.');
    }

    // preluam datele EXIF
	$exif = @exif_read_data(IMGDIR . $numeImg, 0, TRUE);	
	if (FALSE === $exif) {				// nu exista date EXIF?
		throw new RuntimeException('EXIF: Nu exista date EXIF.'); 
	}

    // generam continut ca text obisnuit, nu HTML 
    // aici, in format CSV (Comma Separated Values))
    header('Content-Type: text/plain');
    // ...si precizam ca va fi trimis ca resursa atasata 
    // ce poate fi salvata pe calculatorul pe care rezida clientul Web
    header('Content-Disposition: attachment; filename="info-exif.CSV"');

    echo "Sectiune,Info,Valoare\n"; // antetul documentului CSV 
	// iteram prin toate sectiunile de meta-date asociate imaginii
	foreach ($exif as $info => $sectiune) {
		foreach ($sectiune as $nume => $val) {
			// daca $val e tablou, concatenam valorile elementelor sale
			if (TRUE === is_array($val)) { 
				echo "$info,$nume,'" . implode(':', $val) . "'\n";
			}
			// altfel, presupunem ca $val e de tip scalar
			else {
				echo "$info,$nume,'$val'\n";  
			}
		}
	}
} catch (Exception $e) {         // a survenit o exceptie :(
    echo $e->getMessage();
}
