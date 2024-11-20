<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $query = Film::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('genre', 'like', '%' . $search . '%');
        }
    
        $films = $query->paginate(5);

        return view('admin.dashboard-film', compact('films'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'age_rating' => 'required|integer',
            'duration' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:webp,jpeg,png,jpg,gif,svg|max:10240',
            'image_bg' => 'required|image|mimes:webp,jpeg,png,jpg,gif,svg|max:10240',
            'video' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'title' => $request->title,
            'release_year' => $request->year,
            'age_rate' => $request->age_rating,
            'duration' => $request->duration,
            'genre' => $request->genre,
            'description' => $request->description,
            'video' => $request->video,
        ];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('image_bg')) {
            $imageBgName = 'bg_' . time() . '.' . $request->image_bg->extension();
            $request->image_bg->move(public_path('images'), $imageBgName);
            $data['image_bg'] = $imageBgName;
        }

        Film::create($data);

        return redirect()->route('admin.dashboard.film')->with('success', 'Film created successfully.');
    }

    public function show($slug)
    {
        $film = Film::where('slug', $slug)->first();
        $isFavourite = Auth::user() ? Favourite::where('user_id', Auth::user()->id)->where('film_id', $film->id)->exists() : false;
        $countFavourite = Favourite::where('film_id', $film->id)->count();
        return view('film', compact('film', 'isFavourite', 'countFavourite'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'age_rating' => 'required|integer',
            'duration' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif,svg|max:10240',
            'image_bg' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif,svg|max:10240',
            'video' => 'required|string|max:255',
        ]);

        $updateData = [
            'title' => $request->title,
            'year' => $request->year,
            'age_rating' => $request->age_rating,
            'duration' => $request->duration,
            'genre' => $request->genre,
            'description' => $request->description,
            'video' => $request->video,
        ];

        if ($request->hasFile('image')) {
            // Hapus image lama jika ada
            if ($film->image) {
                $oldImagePath = public_path('images/' . $film->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $updateData['image'] = $imageName;
        }

        if ($request->hasFile('image_bg')) {
            // Hapus image_bg lama jika ada
            if ($film->image_bg) {
                $oldImageBgPath = public_path('images/' . $film->image_bg);
                if (file_exists($oldImageBgPath)) {
                    unlink($oldImageBgPath);
                }
            }
            $imageBgName = 'bg_' . time() . '.' . $request->image_bg->extension();
            $request->image_bg->move(public_path('images'), $imageBgName);
            $updateData['image_bg'] = $imageBgName;
        }

        $film->update($updateData);

        return redirect()->route('admin.dashboard.film')->with('success', 'Film updated successfully.');
    }

    public function destroy(Film $film)
    {
        $film->delete();
        
        return redirect()->route('admin.dashboard.film')->with('success', 'Film deleted successfully.');
    }

    public function toggleFavourite(Film $film)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must login to add film to favorites.');
        }

        if (Favourite::where('user_id', $user->id)->where('film_id', $film->id)->exists()) {
            Favourite::where('user_id', $user->id)->where('film_id', $film->id)->delete();
            return redirect()->back()->with('success', 'Film removed from favorites.');
        } else {
            Favourite::create([
                'user_id' => $user->id,
                'film_id' => $film->id,
            ]);
            return redirect()->back()->with('success', 'Film added to favorites.');
        }
    }
}
