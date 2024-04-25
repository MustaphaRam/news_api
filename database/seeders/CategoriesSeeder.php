<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Root Categories
        $actualites = Categorie::create(['name' => 'Actualités']);
        $divertissement = Categorie::create(['name' => 'Divertissement']);
        $technologie = Categorie::create(['name' => 'Technologie']);
        $sante = Categorie::create(['name' => 'Santé']);

        // Sous-catégories sous Actualités
        $politique = $actualites->children()->create(['name' => 'Politique']);
        $economie = $actualites->children()->create(['name' => 'Économie']);
        $sport = $actualites->children()->create(['name' => 'Sport']);

        // Sous-catégories sous Divertissement
        $cinema = $divertissement->children()->create(['name' => 'Cinéma']);
        $musique = $divertissement->children()->create(['name' => 'Musique']);
        $sorties = $divertissement->children()->create(['name' => 'Sorties']);

        // Sous-catégories sous Technologie
        $informatique = $technologie->children()->create(['name' => 'Informatique']);
        $ordinateurs = $informatique->children()->create(['name' => 'Ordinateurs de bureau']);
        $portable = $informatique->children()->create(['name' => 'PC portable']);
        $connexion = $informatique->children()->create(['name' => 'Connexion internet']);
        $gadgets = $technologie->children()->create(['name' => 'Gadgets']);
        $smartphones = $gadgets->children()->create(['name' => 'Smartphones']);
        $tablettes = $gadgets->children()->create(['name' => 'Tablettes']);
        $jeuxVideo = $gadgets->children()->create(['name' => 'Jeux vidéo']);

        // Sous-catégories sous Santé
        $medecine = $sante->children()->create(['name' => 'Médecine']);
        $bienEtre = $sante->children()->create(['name' => 'Bien-être']);
    }
}
