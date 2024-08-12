<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\BonLivraisonController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\DetailsCommandeController;
use App\Http\Controllers\CheckAdminlogin;
use App\Http\Controllers\Detail_blController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\SecuritieController;
use App\Models\Historique;
use Illuminate\Http\Request;

// Public routes
Route::get('/', function () {
    return view('index');
})->name('loginform');

// Admin routes
Route::middleware(['check.user.type:admin'])->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('voyages', VoyageController::class);
    Route::resource('chauffeurs', ChauffeurController::class);
    Route::resource('camions', CamionController::class);
    Route::resource('securities', SecuritieController::class);
    Route::resource('commandes', CommandeController::class);
    Route::resource('bon_livraisons', BonLivraisonController::class);
    Route::resource('produits', ProduitController::class);
    Route::resource('details_bl', Detail_blController::class);

    Route::delete('/details_bl/{id}', [Detail_blController::class, 'destroy'])->name('details_bl.destroy');
    Route::get('/commandes/search', [CommandeController::class, 'search'])->name('commandes.search');

    Route::resource('details_commandes', DetailsCommandeController::class);
    Route::post('/admins/{id}/regenerate-password', [AdminController::class, 'regeneratePassword'])->name('admins.regeneratePassword');
    Route::get('/produits/search', [ProduitController::class, 'search'])->name('produits.search');

    Route::get('/home', function (Request $request) {
        $query = Historique::query();

        // Apply filters
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }
        if ($request->filled('voyage_mat')) {
            $query->where('voyage_mat', 'like', '%' . $request->voyage_mat . '%');
        }
        if ($request->filled('security_badge')) {
            $query->where('security_badge', 'like', '%' . $request->security_badge . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Paginate results
        $historiques = $query->paginate(10);

        return view('home', compact('historiques'));
    })->name('dash');
});
Route::middleware(['check.user.type:securitie'])->group(function () {
    // web.php

    Route::get('/scan/qr', function (Request $request) {
        $status = $request->query('status');
        return view('scan', compact('status'));
    })->name('scan.qr');

    Route::post('/scanner/{badge}/{status}', [ScanController::class, 'scan'])->name('scanner');

    Route::get('/securitie_dashboard', function () {
        return view('securitie_dashboard');
    })->name('securitie_dashboard');
    Route::post('securitie/logout', [ScanController::class, 'logout'])->name('securitie.logout');
});
Route::post('admin/login', [CheckAdminlogin::class, 'login'])->name('admin.login');

Route::post('admin/logout', [CheckAdminlogin::class, 'logout'])->name('admin.logout');
Route::fallback(function () {
    return view('index');
});

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');
