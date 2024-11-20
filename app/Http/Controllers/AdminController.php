<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Form;
use App\Models\User;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalFilms = Film::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalFavourites = User::where('role', 'user')->withCount('favourites')->get()->sum('favourites_count');
        $totalForms = Form::count();

        // Film yang paling banyak difavoritkan
        $topFilms = Film::withCount('favourites')
            ->orderBy('favourites_count', 'desc')
            ->take(5)
            ->get();

        // Jumlah favorit dalam 7 hari terakhir
        $favouritesLast7Days = Favourite::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('admin.dashboard')
            ->with('totalFilms', $totalFilms)
            ->with('totalUsers', $totalUsers)
            ->with('totalFavourites', $totalFavourites)
            ->with('totalForms', $totalForms)
            ->with('topFilms', $topFilms)
            ->with('favouritesLast7Days', $favouritesLast7Days);
    }

    public function index()
    {
        $admins = User::where('role', 'admin')->paginate(10);

        return view('admin.dashboard-admin', compact('admins'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|max:255',
            'cpassword' => 'required|min:8|max:255',
        ]);

        if (User::where('email', $request->email)->exists() || User::where('username', $request->username)->exists()) {
            return redirect()->back()
                ->with('error', 'Email or Username already exists.')
                ->withInput();
        }

        if ($request->password != $request->cpassword) {
            return redirect()->back()
                ->with('error', 'Password confirmation does not match.')
                ->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please check your input again.')
                ->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin',
        ]);

        return redirect(route('admin.dashboard.admin'))->with('success', 'Admin created successfully.');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect(route('admin.dashboard.admin'))->with('success', 'Admin deleted successfully.');
    }
}
