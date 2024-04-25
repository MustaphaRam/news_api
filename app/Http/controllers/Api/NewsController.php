<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Resources\NewsResource;
use App\Models\Categorie;
use Exception;
use Illuminate\Support\Arr;

class NewsController extends Controller
{
    public function index()
    {
        try{
            // Récupérés tous les news (ne pas afficher les news expirées)
            return response()->json([
                'status_message' => "Les News ont été Récupérés",
                'data' => News::where('date_expiration', '>', now())->latest()->get(),
            ],200);

        } catch(Exception $e) {
            return response()->json([
                "message_error" => "Internal Server Error",
                "error" => $e->getMessage(),
            ],500);
        }
    }

    // function ajoute news
    public function store(NewsRequest $request)
    {
        try {
            // Logique pour créer une nouvelle news
            
            $news = new News();
            $news->titre = $request->titre;
            $news->contenu = $request->contenu;
            $news->categorie_id = Categorie::firstWhere('name', $request->categorie)->id;
            $news->date_debut = now();
            $news->date_expiration = now()->addDays(5); // Exemple: Définir la date d'expiration 5 jours à compter de la création;

            $news->save();

            return response()->json([
                'status_message' => 'News a été ajouté',
                "data" => $news,
            ],201);

        } catch(Exception $e) {
            return response()->json([
                "message_error" => "Internal Server Error",
                "error" => $e->getMessage()
            ],500);
        }
    }

    // function afficher la News par id
    public function show($id)
    {
        try {
            // Logique pour récupérer une news par son ID
            $news = News::find($id);

            if(!$news){
                return response()->json([
                    "error" => true,
                    "status_message" => "Pas trouvé!",
                ],404);
            }

            return response()->json([
                'data' => $news
            ],200);

        } catch(Exception $e) {
            return response()->json([
                "message_error" => "Internal Server Error",
                "error" => $e->getMessage(),
            ],500);
        }
    }

    // function update une news par id
    public function update(NewsRequest $request, $id)
    {
        try {
            // Logique pour mettre à jour une news

            // recherche la news par id
            $news = News::find($id);

            if(!$news){
                return response()->json([
                    "error" => true,
                    "status_message" => "Pas trouvé!",
                ],404);
            }

            // Logique pour update une news
            $news->titre = $request->titre ;
            $news->contenu = $request->contenu;
            $news->categorie_id = Categorie::firstWhere('name', $request->categorie)->id;
            $news->update();

            return response()->json([
                'status_message' => 'La News a été mise à jour',
                "data" => $news,
            ],202);

        } catch(Exception $e) {
            return response()->json([
                "message_error" => "Internal Server Error",
                "error" => $e->getMessage()
            ],500);
        }
    }

    // function supprimer une news par id 
    public function destroy($id)
    {
        try {
            // Logique pour récupérer une news par son ID
            $news = News::find($id);

            if(!$news){
                return response()->json([
                    "error" => true,
                    "status_message" => "Pas trouvé",
                ],404);
            }

            // Logique pour supprimer une news
            //News::findOrFail($id)->delete();
            $news->delete();
            return response()->json([
                'success'=> true,
                'status_message' => "La news a été supprimée",
            ],204);

        } catch(Exception $e) {
            return response()->json([
                "message_error" => "Internal Server Error",
                "error" => $e->getMessage(),
            ],500);
        }
    }


    // function recherche les News par la Catégorie
    public function search($categorie)
    {
        try{
            // Récupérés tous les news by categorie
            $cat = Categorie::where('name', $categorie)->first();
            
            if(!$cat) {
                return response()->json([
                    'status_message' => "Cette catégorie n'existe pas!",
                ],404);
            }

            //$news = News::where('categorie_id', '=', $cat->id)->where('date_expiration', '>', now())->latest()->get();
            
            // Récupérés récursivement des News associés à la catégorie et à ses sous-catégories
            $news = $this->getNewsForCategory($cat);
           
            if(!$news) {
                return response()->json([
                    'status_message' => "Pas trouvé!",
                    'news' => []
                ],200);
            }
            
            return response()->json([
                'status_message' => count($news)." news ont été récupérées",
                'data' => Arr::collapse($news),
            ],200);

        } catch(Exception $e) {
            return response()->json([
                "message_error" => "Internal Server Error",
                "error" => $e->getMessage(),
            ],500);
        }
    }

    // function Récupérer des news associés à la catégorie
    protected function getNewsForCategory($categorie)
    {
        $catIdList = [];

        // Récupérer des news associés à la catégorie actuelle
        // la function getAllchildren trouvé dans un modèle categorie
        foreach ($categorie->getAllchildren([]) as $cat) {
            $catIdList[] = $cat->id;
        }

        // Récupérer récursivement des news pour chaque sous-catégorie
        foreach ($categorie->children() as $child) {
            $catIdList = array_merge($catIdList, $this->getNewsForCategory($child));
        }

        $newsList = [];

        // S'il n'y a pas d'enfants de la categorie
        if(!count($catIdList)) {
            $news = News::where('categorie_id', '=', $categorie->id)
                        ->where('date_expiration', '>', now())
                        ->latest()
                        ->get();
            
            if($news->isNotEmpty()) {
                $newsList[] = $news;
            }
        } else {
            foreach ($catIdList as $item) {
                $news = News::where('categorie_id', '=', $item)
                            ->where('date_expiration', '>', now())
                            ->latest()
                            ->get();
                
                if($news->isNotEmpty()) {
                    $newsList[] = $news;
                }  
            }
        }

        return $newsList;
    }
}
