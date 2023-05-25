<?php

function convertSize($bytes, $precision = 2) {
  $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB', 'HB'];
  $index = 0;
  $value = $bytes;

  while ($value >= 1024) {
    if ($index >= count($units) - 1) {
      break;
    }

    $value /= 1024;
    $index++;
  }

  return round($value, $precision) . ' ' . $units[$index];
}

/* Les unités sont constantes donc on peut les rajouter en haut elle ne changerons jamais.

Ensuite une boucle où nous vérifions d'abord si la condition de sortie est satisfaite ($index >= count($units) - 1). 
Si tel est le cas, nous utilisons break pour sortir de la boucle. 
Sinon, nous continuons à diviser $value par 1024 et à incrémenter $index.

On retourne l'arrondi grace à la fn php round() avec l'unité trouvé dans la boucle en concaténation.
*/
