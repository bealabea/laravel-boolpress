<?php
namespace App\Traits;

use App\Post;
use Illuminate\Support\Str;

trait SlugGenerator {
    protected function generateUniqueSlug($postTitle) {
        // Genero lo slug partendo dal titolo
        // Str::slug è un metodo che trasforma la stringa passata tra le parentesi
        // in una copia della stessa in minuscolo, di solito tra parentesi
        // si aggiunge anche il separator ('-') che sostituisce gli spazi, se non si indica di default sarà -
        $slug = Str::slug($postTitle);
    
        // prima controllo a db se esiste già un elemento con lo stesso slug
        // "slug" è la colonna della mia tabella, $slug è la variabile
        // dove salvo lo slug (Str::slug) copiato dalla stringa passata tra parentesi
        $exists = Post::where("slug", $slug)->first();
        // creo una variabile per il conteggio degli slug
        $counter = 1;
    
        // Se $exists ha un valore diverso da null o false,
        // eseguo il while
        while ($exists) {
          // Genero un nuovo slug, prendendo da quello precedente e concatenando un numero incrementale
          $newSlug = $slug . "-" . $counter;
          $counter++;
    
          // controllo a db se esiste già un elemento con i nuovo slug appena generato
          $exists = Post::where("slug", $newSlug)->first();
    
          // Se non esiste, salvo il nuovo slug nella variabile $slug che verrà poi usata
          // per assegnare il valore all'interno del nuovo post.
          if (!$exists) {
            $slug = $newSlug;
          }
        }
        // se exists ha valore null o false posso ritornare direttamente $slug (senza aggiungere il conteggio)
        return $slug;
      }

}

?>